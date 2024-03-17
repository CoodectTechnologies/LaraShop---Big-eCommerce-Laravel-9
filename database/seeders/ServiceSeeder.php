<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $service = Service::create([
            'name' => [config('translatable.fallback') => 'Desarrollo web'],
            'fragment' => [config('translatable.fallback') => 'Transforma tu visión en realidad con nuestro servicio de desarrollo web de vanguardia. Desde sitios web elegantes hasta potentes aplicaciones, nuestro equipo de expertos está listo para llevar tu presencia en línea al siguiente nivel. ¿Listo para destacar en la era digital?'],
            'body' => [config('translatable.fallback') => ''],
            'order' => 1,
            'meta_title' => [config('translatable.fallback') => 'Desarrollo web'],
            'meta_description' => [config('translatable.fallback') => 'Transforma tu visión en realidad con nuestro servicio de desarrollo web de vanguardia.'],
            'meta_keywords' => [config('translatable.fallback') => 'Desarrollo web, Diseño de sitios web, Mantenimiento del sitio, E-commerce, Tiendas en linea'],
        ]);
        $service->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/service/desarrollo-web.webp', 'public/service/desarrollo-web.webp')]);

        $service = Service::create([
            'name' => [config('translatable.fallback') => 'Marketing Digital'],
            'fragment' => [config('translatable.fallback') => 'Creamos campañas digitales efectivas a través de marketing digital'],
            'body' => [config('translatable.fallback') => ''],
            'order' => 2,
            'meta_title' => [config('translatable.fallback') => 'Marketing Digital'],
            'meta_description' => [config('translatable.fallback') => 'Creamos campañas digitales efectivas a través de marketing digital'],
            'meta_keywords' => [config('translatable.fallback') => 'Marketing digital, SEM, Campañas digitales, Facebook ads, Google Ads'],
        ]);
        $service->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/service/marketing-digital.webp', 'public/service/marketing-digital.webp')]);

        $service = Service::create([
            'name' => [config('translatable.fallback') => 'Diseño gráfico'],
            'fragment' => [config('translatable.fallback') => 'Desarrollamos el diseño gráfico desde cero o le damos un toque fresco y moderno a la identidad de tu marca.'],
            'body' => [config('translatable.fallback') => ''],
            'order' => 3,
            'meta_title' => [config('translatable.fallback') => 'Diseño gráfico'],
            'meta_description' => [config('translatable.fallback') => 'Desarrollamos el diseño gráfico desde cero o le damos un toque fresco y moderno a la identidad de tu marca.'],
            'meta_keywords' => [config('translatable.fallback') => 'Diseño de logotipos, Diseño de tarjetas de presentación, Diseño de folletos y volantes, Diseño de gráficos para la web'],
        ]);
        $service->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/service/diseño-grafico.webp', 'public/service/diseño-grafico.webp')]);

        $service = Service::create([
            'name' => [config('translatable.fallback') => 'Auditorias SEO'],
            'fragment' => [config('translatable.fallback') => 'Realizamos el proceso de mejora de un sitio web para mejorar su posicionamiento orgánico'],
            'body' => [config('translatable.fallback') => ''],
            'order' => 4,
            'meta_title' => [config('translatable.fallback') => 'Auditorias SEO'],
            'meta_description' => [config('translatable.fallback') => 'Realizamos el proceso de mejora de un sitio web para mejorar su posicionamiento orgánico'],
            'meta_keywords' => [config('translatable.fallback') => 'Optimización de contenido, Investigación de palabras clave, Enlaces de retroceso (backlinks), Análisis de la competencia'],
        ]);
        $service->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/service/auditoria-seo.webp', 'public/service/auditoria-seo.webp')]);
    }
}
