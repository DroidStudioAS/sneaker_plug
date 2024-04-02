<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExchangeRates extends Model
{
    protected $table="exchange_rates";

    protected $fillable = ["currency", "value"];

    public static function getTodaysCurrency($currency){
        $dbRate = ExchangeRates::where(["currency"=>$currency])
            ->whereDate("created_at", Carbon::now())
            ->get();

        return $dbRate;
    }
}
