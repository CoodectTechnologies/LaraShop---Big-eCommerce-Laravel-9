<?php

namespace App\Exports\Admin\Dashboard\Order;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

class OrdersExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell, WithDrawings
{

    public $dateStart;
    public $dateEnd;
    public $date;

    public function __construct($dateStart, $dateEnd){
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->date = $dateStart.' - '.$dateEnd;
    }
    public function collection(){
        return Order::query()
        ->whereDate('created_at', '>=', $this->dateStart)
        ->whereDate('created_at', '<=', $this->dateEnd)
        ->get();
    }
    public function headings(): array{
        return [
            'Fecha',
            'Orden',
            'Estatus',
            'Precio de envío',
            'Método de envio',
            'Días de envío',
            'Monto de cupon',
            'Subtotal',
            'Total',
            'Moneda',
            'Tipo de cambio',
            'Método de pago',
            'Estatus de pago',
        ];
    }
    public function map($registration) : array{
        return [
            $registration->created_at,
            $registration->number,
            $registration->status,
            $registration->shipping_price,
            $registration->shipping_method,
            $registration->shipping_days,
            $registration->coupon_price_discount,
            $registration->subtotal,
            $registration->total,
            $registration->currency,
            $registration->currency_value,
            $registration->payment_method,
            $registration->payment_status
        ];
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
