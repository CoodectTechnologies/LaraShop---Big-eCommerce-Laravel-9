<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Roles
        $administrador = Role::create(['name' => 'Administrador']);
        $copywriter = Role::create(['name' => 'Copywriter']);
        $ecommerceManager = Role::create(['name' => 'Ecommerce manager']);
        $webManager = Role::create(['name' => 'Web manager']);
        $client = Role::create(['name' => 'Cliente']);

        //Assing permissions
        $administrador->givePermissionTo(
            Permission::all()->pluck('name')->toArray()
        );
        $copywriter->givePermissionTo([
            'blog',
            'blog categorías',
            'blog etiquetas'
        ]);
        $ecommerceManager->givePermissionTo([
            'ordenes',
            'productos',
            'producto categorías',
            'producto marcas',
            'producto géneros',
            'mayoreo',
            'promociones',
            'cupones',
            'comentarios',
            'países',
            'estados',
            'zonas de envío',
            'clases de envío',
        ]);
        $webManager->givePermissionTo([
            'banners',
            'galería',
            'nosotros',
            'team',
            'videos',
            'servicios',
            'portafolio',
            'socios',
            'blog',
            'blog categorías',
            'blog etiquetas',
            'correos',
            'testimonios',
            'paquetes',
            'paquetes características',
            'preguntas y respuestas',
            'subscriptores',
            'contacto'
        ]);
    }
}
