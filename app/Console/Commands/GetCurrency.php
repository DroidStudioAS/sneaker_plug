<?php

namespace App\Console\Commands;

use App\Models\ExchangeRates;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetCurrency extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:rate {currency} {base_currency?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command returns the exchange rate of the sent currency, compared to
    euros. For a list of supported currencies, visit: https://api.vatcomply.com/currencies
    If you want to change the base currency, send it as the 2nd param to the command
    You must send the currency code, not the name as the parameter';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //base currency is euro, so all values in exchange rate table
        //are compared to euro
        $baseCurrency = "EUR";
        $currency = strtoupper($this->argument("currency"));

        //check if we already have a record before procceding
        $dbRate = ExchangeRates::where(["currency"=>$currency])
            ->whereDate("created_at", Carbon::now())
            ->get();
        if(!$dbRate->isEmpty()){
            $this->getOutput()->writeln("Record for $currency already exists for this date");
            return 1;
        }
        //if user sent base currency, reset the variable to the sent value
        if($this->argument("base_currency")!==null){
            $baseCurrency=strtoupper($this->argument("base_currency"));
        }

        $response = Http::withOptions([
            "verify"=>false
        ])->get(env("CURRENCY_API_URL"),[
            "base"=>$baseCurrency
        ]);
        $decodedResponse = json_decode($response,true);
        $conversionRate = $decodedResponse["rates"][$currency];
        //create the rate
        ExchangeRates::create([
            "currency"=>$this->argument("currency"),
            "value"=>$conversionRate
        ]);

        $this->getOutput()->writeln($currency. " " . $conversionRate);
        //success
        return 0;

    }
}
