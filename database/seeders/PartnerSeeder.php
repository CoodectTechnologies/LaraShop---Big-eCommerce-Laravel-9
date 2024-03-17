<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $partner = Partner::create([
            'name' => 'Serendip',
        ]);
        $partner->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/partner/serendip.webp', 'public/partner/serendip.webp')]);

        $partner = Partner::create([
            'name' => 'Atolon',
        ]);
        $partner->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/partner/atolon.webp', 'public/partner/atolon.webp')]);

        $partner = Partner::create([
            'name' => 'Ideanox',
        ]);
        $partner->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/partner/ideanox.webp', 'public/partner/ideanox.webp')]);

        $partner = Partner::create([
            'name' => 'Goguvet',
        ]);
        $partner->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/partner/goguvet.webp', 'public/partner/goguvet.webp')]);

        $partner = Partner::create([
            'name' => 'GEA Asesores',
        ]);
        $partner->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/partner/gea.webp', 'public/partner/gea.webp')]);

        $partner = Partner::create([
            'name' => 'CM Consultoria, ambiental'
        ]);
        $partner->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/partner/cm.webp', 'public/partner/cm.webp')]);

        $partner = Partner::create([
            'name' => 'Guitarra facil',
        ]);
        $partner->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/partner/guitarra-facil.png', 'public/partner/guitarra-facil.png')]);

        $partner = Partner::create([
            'name' => 'Sfericas',
        ]);
        $partner->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/partner/sfericas.webp', 'public/partner/sfericas.webp')]);

    }
}
