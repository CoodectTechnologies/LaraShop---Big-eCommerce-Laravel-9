<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $folderCatalog = storage_path('app/public/catalog');
        if (File::exists($folderCatalog)):
            File::deleteDirectory($folderCatalog);
        endif;

        //CPUS
        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Intel Core i5-12400F 6-Core 2.5GHz'],
            'detail' => [config('translatable.fallback') => 'Potente procesador de 6 núcleos, 12 subprocesos para usuarios que buscan la mejor relación precio-rendimiento.'],
            'price' => 1200
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/sw_11400.png');
        $product->productCategories()->sync([1]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Intel Core i7-13700K 16-Core 3.4 GHz'],
            'detail' => [config('translatable.fallback') => 'Potente procesador de 6 núcleos, 12 subprocesos para usuarios que buscan la mejor relación precio-rendimiento.'],
            'price' => 1300
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/sw_11700k.png');
        $product->productCategories()->sync([1]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Intel Core i9-13900K 24-Core 3.0 GHz'],
            'detail' => [config('translatable.fallback') => 'Potente procesador de 8 núcleos, 12 subprocesos para usuarios que buscan la mejor relación precio-rendimiento.'],
            'price' => 1500
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/sw_13900.png');
        $product->productCategories()->sync([1]);

        //CPU COOLING
        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Disipador de calor Thermaltake UX100 ARGB Lighting, Compatible con intel y AMD/ Aura Sync, RGB Fusion, Ventilador de 120mm, CL-P064-AL12SW-A'],
            'detail' => [config('translatable.fallback') => 'Disipador de calor Thermaltake UX100 ARGB Lighting, Compatible con intel y AMD/ Aura Sync, RGB Fusion, Ventilador de 120mm, CL-P064-AL12SW-A'],
            'price' => 399
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_cold_wind_blanco.png');
        $product->productCategories()->sync([6]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Disipador para CPU DeepCool AK400, 120mm, 500-1850RPM, Negro, R-AK400-BKNNMN-G-1 /'],
            'detail' => [config('translatable.fallback') => 'Disipador para CPU DeepCool AK400, 120mm, 500-1850RPM, Negro, R-AK400-BKNNMN-G-1 /'],
            'price' => 399
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_a2.png');
        $product->productCategories()->sync([6]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Disipador CPU DeepCool AG400, 120mm, 500 - 2000RPM, Negro, R-AG400-BKNNMN-G-1'],
            'detail' => [config('translatable.fallback') => 'Disipador CPU DeepCool AG400, 120mm, 500 - 2000RPM, Negro, R-AG400-BKNNMN-G-1'],
            'price' => 499
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_ag400wh.png');
        $product->productCategories()->sync([6]);

        //MOTHER BOARD
        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Tarjeta Madre MSI PRO Z790-P DDR4, Socket LGA1700, ATX, SATA3 y USB3.2, M.2, Intel Core 12th y 13th Generación /'],
            'detail' => [config('translatable.fallback') => 'Tarjeta Madre MSI PRO Z790-P DDR4, Socket LGA1700, ATX, SATA3 y USB3.2, M.2, Intel Core 12th y 13th Generación'],
            'price' => 4899
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_tuf_gaming_x570_plus_wifi.png');
        $product->productCategories()->sync([2]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Tarjeta Madre MSI MAG Z790 TOMAHAWK WIFI DDR4, Socket LGA1700, ATX, DDR4, SATA3 y USB3.2, M.2, WiFi, Intel Core 12th y 13th Generación /'],
            'detail' => [config('translatable.fallback') => 'Tarjeta Madre MSI MAG Z790 TOMAHAWK WIFI DDR4, Socket LGA1700, ATX, DDR4, SATA3 y USB3.2, M.2, WiFi, Intel Core 12th y 13th Generación'],
            'price' => 5799
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_asus_prime_b760m_k_d4.png');
        $product->productCategories()->sync([2]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Tarjeta Madre Biostar B660GTA, Socket LGA1700 Intel B660 ATX, DDR4, Intel Core 12th Generación /'],
            'detail' => [config('translatable.fallback') => 'Tarjeta Madre Biostar B660GTA, Socket LGA1700 Intel B660 ATX, DDR4, Intel Core 12th Generación'],
            'price' => 4599
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_z790_ud_ax.png');
        $product->productCategories()->sync([2]);

        //RAM
        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Memoria RAM DDR4 Sodimm 8GB 2666MHz Kingston Fury Impact, KF426S15IB/8'],
            'detail' => [config('translatable.fallback') => 'Memoria RAM DDR4 Sodimm 8GB 2666MHz Kingston Fury Impact, KF426S15IB/8, Sustituye a HX426S15IB2/8'],
            'price' => 1379
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_kf560c32rw_32_1.png');
        $product->productCategories()->sync([3]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Memoria RAM Kingston 8GB 8GB DDR4 2666Mhz, Sodimm KCP426SS8/8'],
            'detail' => [config('translatable.fallback') => 'Memoria RAM Kingston 8GB 8GB DDR4 2666Mhz, Sodimm KCP426SS8/8'],
            'price' => 1399
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_cmh64gx5m2b5600z36.png');
        $product->productCategories()->sync([3]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Memoria RAM Sodimm DDR4 8GB 2666MHz TeamGroup ZEUS SODIMM, TTZD48G2666HC19-S01'],
            'detail' => [config('translatable.fallback') => 'Memoria RAM Sodimm DDR4 8GB 2666MHz TeamGroup ZEUS SODIMM, TTZD48G2666HC19-S01'],
            'price' => 549
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_kf556c40bba_16.png');
        $product->productCategories()->sync([3]);

        //SSD
        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Unidad de estado solido SSD Sata 120GB Adata SU650, ASU650SS-120GT-R'],
            'detail' => [config('translatable.fallback') => 'Unidad de estado solido SSD Sata 120GB Adata SU650, ASU650SS-120GT-R'],
            'price' => 199
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_9se00111_pbe960gs25ssdr.png');
        $product->productCategories()->sync([7]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Unidad de Estado Sólido Adata SU630, 240GB, SATA, 2.5", 7mm, ASU630SS-240GQ-R'],
            'detail' => [config('translatable.fallback') => 'Unidad de Estado Sólido Adata SU630, 240GB, SATA, 2.5", 7mm, ASU630SS-240GQ-R'],
            'price' => 249
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_480patriot.png');
        $product->productCategories()->sync([7]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Unidad de estado solido SSD 120GB 2.5" m.2 SATA3 Kingston A400, SA400S37/120G'],
            'detail' => [config('translatable.fallback') => 'Unidad de estado solido SSD 120GB 2.5" SATA3 Kingston A400, SA400S37/120G'],
            'price' => 299
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_patriot_p310.png');
        $product->productCategories()->sync([7]);

        //VGA
        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Tarjeta de Video Zotac NVIDIA GeForce RTX 4060 8GB Twin Edge OC, 8GB 128-bit GDDR6, PCI Express 4.0, ZT-D40600H-10M'],
            'detail' => [config('translatable.fallback') => 'Tarjeta de Video Zotac NVIDIA GeForce RTX 4060 8GB Twin Edge OC, 8GB 128-bit GDDR6, PCI Express 4.0, ZT-D40600H-10M'],
            'price' => 5899
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_tuf_rtx4070ti_o12g_gaming.png');
        $product->productCategories()->sync([4]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Tarjeta de Video RTX 4060 ASUS DUAL, 8GB GDDR6 OC, DUAL-RTX4060-O8G, GX23'],
            'detail' => [config('translatable.fallback') => 'Tarjeta de Video RTX 4060 ASUS DUAL, 8GB GDDR6 OC, DUAL-RTX4060-O8G'],
            'price' => 5999
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_rog_strix_rtx4070_12g_gaming.png');
        $product->productCategories()->sync([4]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Tarjeta de video Asrock AMD Radeon™ RX 6600 Challenger 8GB, Boost Clock: Up to 2491 MHz, 14 Gbps, 8GB GDDR6, DirectX 12 Ultimate, RX6600 CLD 8G'],
            'detail' => [config('translatable.fallback') => 'Tarjeta de video Asrock AMD Radeon™ RX 6600 Challenger 8GB, Boost Clock: Up to 2491 MHz, 14 Gbps, 8GB GDDR6, DirectX 12 Ultimate, RX6600 CLD 8G'],
            'price' => 3799
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_gv_n4070aero_oc_12gd.png');
        $product->productCategories()->sync([4]);

        //CASE
        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Gabinete Gamer Xzeal XZ110-1, 4 Ventiladores RGB Incluidos, ATX, USB 3.0, Ventana de Cristal templado, XZCGB12B, PROMOXZEAL'],
            'detail' => [config('translatable.fallback') => 'Gabinete Gamer Xzeal XZ110-1, 4 Ventiladores RGB Incluidos, ATX, USB 3.0, Ventana de Cristal templado, XZCGB12B, PROMOXZEAL'],
            'price' => 799
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_alpha_negro.png');
        $product->productCategories()->sync([8]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Gabinete Xzeal XZ135, LED RGB, Cristal Templado, ATX, 3 Ventiladores Frontales RGB Incluidos USB 3.0, XZCGB07B, PROMOXZEAL'],
            'detail' => [config('translatable.fallback') => 'Gabinete Xzeal XZ135, LED RGB, Cristal Templado, ATX, 3 Ventiladores Frontales RGB Incluidos USB 3.0, XZCGB07B, PROMOXZEAL'],
            'price' => 899
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_alpha_blanco.png');
        $product->productCategories()->sync([8]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Gabinete Gamer Xzeal XZ130 White, ATX, Incluye 3 Ventiladores RGB, USB 3.0, Ventana Lateral, Led RGB, XZCGB06W, PROMOXZEAL'],
            'detail' => [config('translatable.fallback') => 'Gabinete Gamer Xzeal XZ130 White, ATX, Incluye 3 Ventiladores RGB, USB 3.0, Ventana Lateral, Led RGB, XZCGB06W, PROMOXZEAL'],
            'price' => 999
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_csg800.png');
        $product->productCategories()->sync([8]);

        //PSU
        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Fuente de poder Asus Tuf Gaming 450W, 80 Plus Bronze, TUF-GAMING-450B'],
            'detail' => [config('translatable.fallback') => 'Fuente de poder Asus Tuf Gaming 450W, 80 Plus Bronze, TUF-GAMING-450B'],
            'price' => 1799
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_probe.png');
        $product->productCategories()->sync([5]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Fuente de poder Thermaltake TR-500CUS, 500W'],
            'detail' => [config('translatable.fallback') => 'Fuente de poder Thermaltake TR-500CUS, 500W'],
            'price' => 949
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_coreractorii.png');
        $product->productCategories()->sync([5]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Fuente de poder Asus Tuf Gaming 750W, 80 Plus Bronze, TUF-GAMING-750B'],
            'detail' => [config('translatable.fallback') => 'Fuente de poder Asus Tuf Gaming 750W, 80 Plus Bronze, TUF-GAMING-750B'],
            'price' => 1676
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_gp_ud850gm_pg5.png');
        $product->productCategories()->sync([5]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Monitor Samsung S32B304NWN / 32 / S30B Series / LED monitor / Full HD 1080p / S32B304NWN'],
            'detail' => [config('translatable.fallback') => 'Monitor Samsung S32B304NWN / 32 / S30B Series / LED monitor / Full HD 1080p / S32B304NWN'],
            'price' => 2899
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_m32qc.png');
        $product->productCategories()->sync([9]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Monitor FullHD BenQ 22" GW2283 / HDMI / VGA / 60Hz /'],
            'detail' => [config('translatable.fallback') => 'Monitor Samsung S32B304NWN / 32" / S30B Series / LED monitor / Full HD 1080p / S32B304NWN'],
            'price' => 2899
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_vy249he_w.png');
        $product->productCategories()->sync([9]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Kit Teclado Gamer Vorago KM-500 Retroiluminado Gamer Led Azul'],
            'detail' => [config('translatable.fallback') => 'Teclado Gamer Vorago KM-500 Retroiluminado'],
            'price' => 299
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_ttesports.png');
        $product->productCategories()->sync([10]);

        $product = Product::create([
            'name' => [config('translatable.fallback') => 'Teclado Gamer Vorago Start the Game KB-503 / Español / Led Multicolor'],
            'detail' => [config('translatable.fallback') => 'Teclado Gamer Vorago Start the Game KB-503 / Español / Led Multicolor'],
            'price' => 209
        ]);
        $this->saveImages($product, 'https://ignitestore.mx/assets/uploads/thumb_sw_elgato_1.png');
        $product->productCategories()->sync([10]);
    }

    private function saveImages($product, $images){
        if($product && $images):
            $imagesArray = explode(',', $images);
            foreach($imagesArray as $key => $image):
                $extension = explode('.', $image);
                $extension = end($extension);
                $location = 'public/catalog/product/';
                $date = str_replace(':', '-', date('h:i:s')).rand(1, 100);
                $name = filter_var($product->name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
                $name = str_replace(['\\', '/', ' ', '"', "'", ':', '.', ';', '#', '&', '?'], '-', $name).rand(1, 100);
                $url = $location.$date.$name.$extension;
                $contentImage = file_get_contents($image);
                Storage::put($url, $contentImage);
                if($key == 0):
                    imageManager($url, 600, $product);
                else:
                    imagesManager($url, 600, $product);
                endif;
            endforeach;
        endif;
    }
}
