<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GetEuro extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:euro {currency}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $baseCurrency = strtoupper($this->argument("currency"));
        if($baseCurrency!=="EUR" && $baseCurrency!=="USD"){
            //failure
            return 1;
        }
        //if base currency is EURO, set to USD, else set to USD
        $currencyToParse = $baseCurrency==="EUR" ? "USD":"EUR";

        $response = Http::withOptions([
            "verify"=>false
        ])->get(env("CURRENCY_API_URL"),[
            "base"=>$baseCurrency
        ]);

        $decodedResponse = json_decode($response,true);

        $conversionRate = $decodedResponse["rates"][$currencyToParse];

        $this->getOutput()->writeln($baseCurrency. " " . $conversionRate);
        //success
        return 0;

    }
}
