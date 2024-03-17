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
            'module_web_id' => 1,
            'subtitle' => [config('translatable.fallback') => 'Ofrecemos soluciones a la medida para todo tipo de empresas o negocios, con servicios de diseño web, desarrollo web, y marketing digital.'],
            'title' => [config('translatable.fallback') => 'DIGITALIZATE'],
            'type' => 'Video',
            'video' => mediaManagerSeeder('assets/web/video/banner.mp4', 'public/banner/banner.mp4')
        ]);
        $banner = Banner::create([
            'order' => 2,
            'module_web_id' => 1,
            'subtitle' => [config('translatable.fallback') => 'Desarrollamos el diseño gráfico desde cero o le damos un toque fresco y moderno a la identidad de tu marca.'],
            'title' => [config('translatable.fallback') => 'DISEÑO GRÁFICO'],
            'type' => 'Video',
            'video' => mediaManagerSeeder('assets/web/video/banner2.mp4', 'public/banner/banner2.mp4')
        ]);
        $banner = Banner::create([
            'order' => 2,
            'module_web_id' => 1,
            'subtitle' => [config('translatable.fallback') => 'Hacemos campañas digitales efectivas a través de marketing digital'],
            'title' => [config('translatable.fallback') => 'REDES SOCIALES'],
            'type' => 'Video',
            'video' => mediaManagerSeeder('assets/web/video/banner3.mp4', 'public/banner/banner3.mp4')
        ]);

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
