<?php

namespace Database\Seeders;

use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            [
                'name' => 'Peso méxicano',
                'code' => 'MXN',
                'value' => 1,
                'symbol' => '$',
                'default' => true,
                'active' => true
            ],
            [
                'name' => 'Dólar estadounidense',
                'code' => 'USD',
                'value' => 16.86,
                'symbol' => '$',
                'default' => false,
                'active' => true
            ],
        ];
        Currency::insert($currencies);
        Cache::forget('currencies');
        $currencies = Currency::where('active', true)->orderBy('id')->get();
        Cache::put('currencies', $currencies);
    }
}
