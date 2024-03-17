<?php

namespace App\Exports\Admin\Dashboard\Order;

use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Collection;
use App\Models\Currency;
use App\Models\Order;

class OrdersInfoExport implements FromCollection, WithHeadings, WithMapping, WithCustomStartCell, WithDrawings
{
    public $dateStart;
    public $dateEnd;
    public $productType;

    public function __construct($dateStart, $dateEnd, $productType){
        $this->dateStart = $dateStart;
        $this->dateEnd = $dateEnd;
        $this->productType = $productType;
    }
    public function collection(){
        $orders = Order::query()
        ->whereDate('created_at', '>=', $this->dateStart)
        ->whereDate('created_at', '<=', $this->dateEnd);
        if($this->productType):
            $orders = $orders->whereHas('products', function($query){
                $query->where('order_product.type', $this->productType);
            });
        endif;
        $orders = $orders->get();
        $date = $this->dateStart.' - '.$this->dateEnd;
        $productSalesQuantity = 0;
        $salesQuantity = 0;
        $avgSalesNeto = 0;
        $totalCoupon = 0;
        $totalShippings = 0;
        $totalSalesBrute = 0;
        $totalSalesNeto = 0;
        $totalRefund = 0;
        $currencyDefault = Currency::getDefault();
        $totalSalesPaymentStatusApproved = $orders->where('payment_status', Order::PAYMENT_STATUS_APPROVED)->count();
        foreach($orders as $order):
            $orderTotal = Order::getConvertCurrencyDefault($order, 'total');
            $orderCouponPriceDiscount = Order::getConvertCurrencyDefault($order, 'coupon_price_discount');
            $orderShippingPrice = Order::getConvertCurrencyDefault($order, 'shipping_price');
            if($order->payment_status == Order::PAYMENT_STATUS_APPROVED):
                foreach($order->products as $product):
                    $productSalesQuantity += $product->pivot->quantity;
                endforeach;
                $salesQuantity++;
                $totalCoupon += $orderCouponPriceDiscount;
                $totalShippings += $orderShippingPrice;
                $totalSalesBrute += $orderTotal;
                $totalSalesNeto += ($orderTotal - $orderCouponPriceDiscount - $orderShippingPrice);
            elseif($order->payment_status == Order::STATUS_REFUND):
                $totalRefund += $orderTotal;
            endif;
        endforeach;
        $avgSalesNeto = ($totalSalesNeto > 0 && $totalSalesNeto > 0) ? number_format($totalSalesNeto / $totalSalesPaymentStatusApproved, 2) : 0;
        $data = new Collection([
            (object) [
                'date' => $date,
                'productSalesQuantity' => $productSalesQuantity,
                'salesQuantity' => $salesQuantity,
                'avgSalesNeto' => $avgSalesNeto,
                'totalCoupon' => $totalCoupon,
                'totalShippings' => $totalShippings,
                'totalSalesBrute' => $totalSalesBrute,
                'totalSalesNeto' => $totalSalesNeto,
                'totalRefund' => $totalRefund,
                'currencyDefaultCode' => $currencyDefault->code
            ]
        ]);
        return $data;
    }
    public function headings(): array{
        return [
            'Fecha',
            'Número de artículos vendidos',
            'Cantidad de pedidos',
            'Importe neto promedio de ventas',
            'Importe del cupón',
            'Cantidad de envíos',
            'Cantidad de ventas bruto',
            'Cantidad de ventas netas',
            'Cantidad rembolsada',
            'Moneda'
        ];
    }
    public function map($registration) : array{
        return [
            $registration->date,
            $registration->productSalesQuantity,
            $registration->salesQuantity,
            $registration->avgSalesNeto,
            $registration->totalCoupon,
            $registration->totalShippings,
            $registration->totalSalesBrute,
            $registration->totalSalesNeto,
            $registration->totalRefund,
            $registration->currencyDefaultCode,
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
