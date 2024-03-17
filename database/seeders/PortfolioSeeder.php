<?php

namespace Database\Seeders;

use App\Models\Portfolio;
use Illuminate\Database\Seeder;

class PortfolioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $portfolio = Portfolio::create([
            'service_id' => 1,
            'name' => [config('translatable.fallback') => 'terramarequipofundador.com'],
            'client' => 'Terramar Equipo Fundador',
            'fragment' => [config('translatable.fallback') => 'Desarrollo e implementación de un sistema de comercio electrónico (e-commerce) diseñado específicamente para Terramar Equipo Fundador. Este proyecto representa un hito significativo en la modernización y expansión de las operaciones comerciales de la empresa, brindando una plataforma robusta y eficiente para mejorar la experiencia del usuario y aumentar las oportunidades de ventas en línea.'],
            'body' => [config('translatable.fallback') => ''],
            'link' => 'https://terramarequipofundador.com/',
            'date' => '2021-02-10',
        ]);
        $portfolio->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/portfolio/terramar.webp', 'public/portfolio/terramar.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/terramar2.webp', 'public/portfolio/terramar2.webp')]);

        $portfolio = Portfolio::create([
            'service_id' => 1,
            'name' => [config('translatable.fallback') => 'goguvet.com'],
            'client' => 'Goguvet',
            'fragment' => [config('translatable.fallback') => 'Goguvet es una empresa farmacéutica proveedora de una gran variedad de medicamentos veterinarios, teniendo un incremento en sus clientes gracias al desarrollo web junto con el SEO de este mismo desarrollo, logrando este resultado.'],
            'body' => [config('translatable.fallback') => ''],
            'link' => 'https://goguvet.com',
            'date' => '2021-04-28',
        ]);
        $portfolio->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/portfolio/goguvet.webp', 'public/portfolio/goguvet.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/goguvet2.webp', 'public/portfolio/goguvet2.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/goguvet3.webp', 'public/portfolio/goguvet3.webp')]);

        $portfolio = Portfolio::create([
            'service_id' => 1,
            'name' => [config('translatable.fallback') => 'globalpest.com.mx'],
            'client' => 'Globalpest',
            'fragment' => [config('translatable.fallback') => 'Global Pest es una empresa de Control de Plagas, fumigación y comercialización de equipos para el mismo fin, fundada en la ciudad de Guadalajara.'],
            'body' => [config('translatable.fallback') => ''],
            'link' => 'https://globalpest.com.mx',
            'date' => '2021-06-14',
        ]);
        $portfolio->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/portfolio/globalpest.webp', 'public/portfolio/globalpest.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/globalpest2.webp', 'public/portfolio/globalpest2.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/globalpest3.webp', 'public/portfolio/globalpest3.webp')]);

        $portfolio = Portfolio::create([
            'service_id' => 1,
            'name' => [config('translatable.fallback') => 'sfericas.com'],
            'client' => 'Sfericas',
            'fragment' => [config('translatable.fallback') => 'SFERICAS es un corporativo, principalmente de la rama inmobiliaria, en el cual por dentro es un CRM, que automatiza y digitaliza el corporativo. Teniendo la gestión de las propiedades, desarrollos, Marketplace, datos estadísticos, Clientes, Prospectos, Pagos, Etc. '],
            'body' => [config('translatable.fallback') => ''],
            'link' => 'https://sfericas.com',
            'date' => '2021-06-14',
        ]);
        $portfolio->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/portfolio/sfericas.webp', 'public/portfolio/sfericas.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/sfericas2.webp', 'public/portfolio/sfericas2.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/sfericas3.webp', 'public/portfolio/sfericas3.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/sfericas4.webp', 'public/portfolio/sfericas4.webp')]);

        $portfolio = Portfolio::create([
            'service_id' => 1,
            'name' => [config('translatable.fallback') => 'geasesores.com'],
            'client' => 'GEA ASESORES',
            'fragment' => [config('translatable.fallback') => 'GEA ASESORES es una empresa de consultoría en materia ambiental y de seguridad industrial. '],
            'body' => [config('translatable.fallback') => ''],
            'link' => 'https://geasesores.com',
            'date' => '2022-02-18',
        ]);
        $portfolio->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/portfolio/geasesores.webp', 'public/portfolio/geasesores.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/geasesores2.webp', 'public/portfolio/geasesores2.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/geasesores3.webp', 'public/portfolio/geasesores3.webp')]);

        $portfolio = Portfolio::create([
            'service_id' => 1,
            'name' => [config('translatable.fallback') => 'cmseguridadyambiente'],
            'client' => 'CONSULTORIA AMBIENTAL SEGURIDAD Y PREVENCIÓN',
            'fragment' => [config('translatable.fallback') => 'CM es una empresa que presta servicios de consultoria ambiental y de seguridad laboral, contruye a la sostenibilidad de los proyectos de sus clientes, siempre fomentando la seguridad laboral, la conservación y el cuidado del medio ambiente.'],
            'body' => [config('translatable.fallback') => ''],
            'link' => 'https://cmseguridadyambiente.com',
            'date' => '2022-04-2',
        ]);
        $portfolio->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/portfolio/cmseguridadyambiente.webp', 'public/portfolio/cmseguridadyambiente.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/cmseguridadyambiente2.webp', 'public/portfolio/cmseguridadyambiente2.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/cmseguridadyambiente3.webp', 'public/portfolio/cmseguridadyambiente3.webp')]);

        $portfolio = Portfolio::create([
            'service_id' => 1,
            'name' => [config('translatable.fallback') => 'losarcoshotelyspa'],
            'client' => 'LOS ARCOS HOTEL & SPA',
            'fragment' => [config('translatable.fallback') => 'El hotel, "los Arcos Hotel y Spa" su prioridad es el cliente. se les desarrollo la página web administrable con la cual puede gestionar las habitacion, servicios y amenidades.'],
            'body' => [config('translatable.fallback') => ''],
            'link' => 'https://losarcoshotelyspa.com.mx',
            'date' => '2022-06-20',
        ]);
        $portfolio->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/portfolio/los-arcos-hotel-spa.webp', 'public/portfolio/los-arcos-hotel-spa.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/los-arcos-hotel-spa2.webp', 'public/portfolio/los-arcos-hotel-spa2.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/los-arcos-hotel-spa3.webp', 'public/portfolio/los-arcos-hotel-spa3.webp')]);

        $portfolio = Portfolio::create([
            'service_id' => 1,
            'name' => [config('translatable.fallback') => 'guitarrafacil'],
            'client' => 'GUITARRA FACIL',
            'fragment' => [config('translatable.fallback') => 'Desarrollo e implementación de un sistema de comercio electrónico (e-commerce) diseñado específicamente para Guitarra Facil. Este proyecto representa un hito significativo en la modernización y expansión de las operaciones comerciales de la empresa, brindando una plataforma robusta y eficiente para mejorar la experiencia del usuario y aumentar las oportunidades de ventas en línea.'],
            'body' => [config('translatable.fallback') => ''],
            'link' => 'https://guitarrafacil.com.mx',
            'date' => '2023-06-15',
        ]);
        $portfolio->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/portfolio/guitarrafacil.webp', 'public/portfolio/guitarrafacil.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/guitarrafacil2.webp', 'public/portfolio/guitarrafacil2.webp')]);

        $portfolio = Portfolio::create([
            'service_id' => 1,
            'name' => [config('translatable.fallback') => 'inglespersonalizado'],
            'client' => 'INGLES PERSONALIZADO',
            'fragment' => [config('translatable.fallback') => 'Ingles personalizado crear y promueve herramientas y estrategias de aprendizaje del idioma inglés, más eficientes, rápidas y de calidad, desarrollandoles la web que ayuda a expandirse gracias a la digitalización de la escuela.'],
            'body' => [config('translatable.fallback') => ''],
            'link' => 'https://inglespersonalizado.net',
            'date' => '2023-11-21',
        ]);
        $portfolio->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/portfolio/inglespersonalizado.webp', 'public/portfolio/inglespersonalizado.webp')]);
        $portfolio->images()->create(['url' => mediaManagerSeeder('assets/web/img/portfolio/inglespersonalizado2.webp', 'public/portfolio/guitarrafacil2.webp')]);
    }
}
