<?php

namespace Database\Seeders;

use App\Models\BillingAddress;
use Illuminate\Database\Seeder;

class BillingAddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $billingAddresses = [
            [
                'user_id' => 1,
                'state_id' => '2441', //Jalisco,
                'municipality' => 'Zapopan factory 1',
                'colony' => 'Jardines del valle factory 1',
                'zip_code' => '45120',
                'street' => 'Calzada federalistas',
                'street_number_int' => '1721',
                'street_number_ext' => '320',
                'name' => 'Rigoberto Villa factory',
                'company' => 'Coodect',
                'vat' => 'VIRR102345632',
                'phone' => '3231153678',
                'email' => 'coodect.manager@gmail.com',
                'default' => true
            ],
            [
                'user_id' => 1,
                'state_id' => '2441', //Jalisco,
                'municipality' => 'Zapopan factory 2',
                'colony' => 'Jardines del valle factory 2',
                'zip_code' => '45120',
                'street' => 'Calzada federalistas',
                'street_number_int' => '1721',
                'street_number_ext' => '320',
                'name' => 'Rigoberto Villa factory',
                'company' => 'Coodect',
                'vat' => 'VIRR102345632',
                'phone' => '3231153678',
                'email' => 'rigoberto.brandbean@gmail.com',
                'default' => false
            ]
        ];
        BillingAddress::insert($billingAddresses);
    }
}
