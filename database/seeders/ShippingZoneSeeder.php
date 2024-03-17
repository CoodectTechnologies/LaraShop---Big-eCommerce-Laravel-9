<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\ShippingZone;
use App\Models\State;
use Illuminate\Database\Seeder;

class ShippingZoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = Country::where('name', 'México')->first();
        if($country):
            $shippingZones = [
                [
                    'country_id' => $country->id,
                    'name' => 'ZMG - Zapopan.',
                    'alias' => 'Estafeta',
                    'zip_codes' => '45010...45245',
                    'price' => 80,
                    'shipping_days' => 4
                ],
                [
                    'country_id' => $country->id,
                    'name' => 'ZMG - Guadalajara.',
                    'alias' => 'Estafeta express',
                    'zip_codes' => '44100...44987',
                    'price' => 85,
                    'shipping_days' => 3
                ]
            ];
            foreach($shippingZones as $shippingZone):
                $state = State::where('name', 'Jalisco')->whereRelation('country', 'id', $country->id)->first();
                if($state):
                    $zone = ShippingZone::create($shippingZone);
                    $zone->states()->attach([
                        'state_id' => $state->id
                    ]);
                endif;
            endforeach;
            $todoMexico = ShippingZone::create([
                'country_id' => $country->id,
                'name' => 'Todo méxico.',
                'alias' => 'Estafeta standar',
                'zip_codes' => '',
                'price' => 99,
                'shipping_days' => 8
            ]);
            $stateIds = State::whereRelation('country', 'id', $country->id)->pluck('id');
            $todoMexico->states()->attach($stateIds);
        endif;
    }
}
