<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banner = Banner::create([
            'order' => 1,
            'module_web_id' => 10,
        ]);
        $banner->image()->create([
            'url' => mediaManagerSeeder('assets/ecommerce/images/home/banner.webp', 'public/banner/banner1-ecommerce.webp'),
            'main' => 1,
        ]);
    }

}
