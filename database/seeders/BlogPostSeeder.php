<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Image;
use Illuminate\Database\Seeder;

class BlogPostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $posts = BlogPost::factory(10)->create();
        // foreach($posts as $post):
        //     Image::factory(1)->create([
        //         'imageable_id' => $post->id,
        //         'imageable_type' => BlogPost::class,
        //     ]);
        // endforeach;

        $blog = BlogPost::create([
            'user_id' => null,
            'name' => [config('translatable.fallback') => '¡Conoce­ las­ clases­ de­ logotipos!'],
            'fragment' => [config('translatable.fallback') => '¿Ya conoces la importancia que tiene un logotipo en una marca? Es la forma visual en que se da a conocer, no lo olvides, es la cara de tu marca.'],
            'body' => [config('translatable.fallback') => ''],
            'status' => 'Publicado',
            'meta_title' => [config('translatable.fallback') => '¡Conoce­ las­ clases­ de­ logotipos!'],
            'meta_description' => [config('translatable.fallback') => '¿Ya conoces la importancia que tiene un logotipo en una marca?'],
            'meta_keywords' => [config('translatable.fallback') => 'Logotipos, Clases de logotipos, Importancia del logotipo'],
        ]);
        $blog->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/blog/clases-de-logotipos.webp', 'public/blog/post/clases-de-logotipos.webp')]);

        $blog = BlogPost::create([
            'user_id' => null,
            'name' => [config('translatable.fallback') => 'Tipos de sitio web para tu negocio'],
            'fragment' => [config('translatable.fallback') => '¿Sabes cómo utilizar los diferentes sitios web que existen? ¿No? ¡Quédate a descubrirlo y aprenderás a aprovechar sus beneficios!'],
            'body' => [config('translatable.fallback') => ''],
            'status' => 'Publicado',
            'meta_title' => [config('translatable.fallback') => 'Tipos de sitio web para tu negocio'],
            'meta_description' => [config('translatable.fallback') => '¿Sabes cómo utilizar los diferentes sitios web que existen? ¿No? ¡Quédate a descubrirlo y aprenderás a aprovechar sus beneficios!'],
            'meta_keywords' => [config('translatable.fallback') => 'Sitios web, Tipos de sitio web, Beneficios de sitios web'],
        ]);
        $blog->image()->create(['main' => 1, 'url' => mediaManagerSeeder('assets/web/img/blog/tipos-de-sitio-web-para-tu-negocio.webp', 'public/blog/post/tipos-de-sitio-web-para-tu-negocio.webp')]);
    }
}
