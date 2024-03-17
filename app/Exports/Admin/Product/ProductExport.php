<?php

namespace App\Exports\Admin\Product;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class ProductExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell, WithDrawings
{
    public function collection(){
        return Product::with(['user', 'image', 'images', 'comments', 'orders', 'productGender', 'productSizes', 'productColors', 'productCategories', 'shippingClass'])->get();
    }
    public function headings(): array{
        return [
            'ID',
            'Nombre',
            'Detalles',
            'Descripción',
            'SKU',
            'Cantidad',
            'Precio',
            'Destacado',
            'Status',
            'Youtube',
            'Creado por',
            'Imagen',
            'Galería',
            'Comentarios',
            'Ordenes',
            'Género',
            'Medidas',
            'Colores',
            'Categorías',
            'Clase de envío',
            'Creado'
        ];
    }
    public function map($registration) : array{
        return [
            $registration->id,
            $registration->name,
            $registration->detail,
            $registration->description,
            $registration->sku,
            $registration->quantity,
            $registration->priceToString(),
            $registration->featured ? 'SI' : 'NO',
            $registration->status,
            $registration->iframe_url,
            $registration->user ? $registration->user->name : '',
            config('app.url').$registration->imagePreview(),
            $registration->images->pluck('url'),
            count($registration->comments),
            count($registration->orders),
            $registration->productGender ? $registration->productGender->name : '',
            $registration->productSizes->pluck('name'),
            $registration->productColors->pluck('name'),
            $registration->productCategories->pluck('name'),
            $registration->shippingClass ? $registration->shippingClass->name : '',
            $registration->dateToString()
        ] ;
    }
    public function startCell(): string{
        return 'B6';
    }
    public function drawings(){
        $drawing = new Drawing();
        $drawing->setName(config('app.name'));
        $drawing->setDescription(config('app.name'));
        $drawing->setPath(public_path('assets/admin/media/logo/logo.png'));
        $drawing->setHeight(50);
        $drawing->setCoordinates('B2');
        return $drawing;
    }
}
