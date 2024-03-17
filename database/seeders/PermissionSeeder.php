<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //SYSTEM
        Permission::create(['name' => 'usuarios']);
        Permission::create(['name' => 'roles']);
        Permission::create(['name' => 'permisos']);
        Permission::create(['name' => 'logs']);
        Permission::create(['name' => 'backups']);
        Permission::create(['name' => 'módulos web']);
        Permission::create(['name' => 'comentarios']);
        Permission::create(['name' => 'generales']);

        //WEB
        Permission::create(['name' => 'banners']);
        Permission::create(['name' => 'galería']);
        Permission::create(['name' => 'nosotros']);
        Permission::create(['name' => 'team']);
        Permission::create(['name' => 'videos']);
        Permission::create(['name' => 'servicios']);
        Permission::create(['name' => 'portafolio']);
        Permission::create(['name' => 'socios']);
        Permission::create(['name' => 'blog']);
        Permission::create(['name' => 'blog categorías']);
        Permission::create(['name' => 'blog etiquetas']);
        Permission::create(['name' => 'correos']);
        Permission::create(['name' => 'testimonios']);
        Permission::create(['name' => 'paquetes']);
        Permission::create(['name' => 'paquetes características']);
        Permission::create(['name' => 'preguntas y respuestas']);
        Permission::create(['name' => 'subscriptores']);
        Permission::create(['name' => 'contacto']);
        Permission::create(['name' => 'etiquetas analíticas']);
        Permission::create(['name' => 'accesos mailchimp']);
        Permission::create(['name' => 'accesos google']);

        //ECOMMERCE
        Permission::create(['name' => 'analytic search']);
        Permission::create(['name' => 'ordenes']);
        Permission::create(['name' => 'productos']);
        Permission::create(['name' => 'producto categorías']);
        Permission::create(['name' => 'producto marcas']);
        Permission::create(['name' => 'producto géneros']);
        Permission::create(['name' => 'mayoreo']);
        Permission::create(['name' => 'promociones']);
        Permission::create(['name' => 'cupones']);
        Permission::create(['name' => 'países']);
        Permission::create(['name' => 'estados']);
        Permission::create(['name' => 'zonas de envío']);
        Permission::create(['name' => 'clases de envío']);
        Permission::create(['name' => 'monedas']);
        Permission::create(['name' => 'pasarelas de pago']);
        Permission::create(['name' => 'popup']);
        Permission::create(['name' => 'configurador']);
        Permission::create(['name' => 'configurador pasos']);
        Permission::create(['name' => 'configurador compatibilidades']);
        Permission::create(['name' => 'configurador rendimiento']);
        Permission::create(['name' => 'configurador juegos']);
        Permission::create(['name' => 'configurador rangos']);
        Permission::create(['name' => 'configurador fps']);
    }
}
