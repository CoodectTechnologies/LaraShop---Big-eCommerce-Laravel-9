<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Order extends Model
{
    use HasFactory, LogsActivity;

    const STATUS_CONFIRMED = 'Confirmado';
    const STATUS_PROCESSING = 'Procesando';
    const STATUS_SENT = 'Enviado';
    const STATUS_COMPLETED = 'Completado';
    const STATUS_CANCELED = 'Cancelado';
    const STATUS_REFUND = 'Devolución';

    const PAYMENT_STATUS_APPROVED = 'Aprobado';
    const PAYMENT_STATUS_PENDING = 'Pendiente';
    const PAYMENT_STATUS_REJECTED = 'Rechazado';

    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Orden')
        ->setDescriptionForEvent(fn(string $eventName) => "Una orden ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function getRouteKeyName(){
        return 'number';
    }
    public function currency(){
        return $this->belongsTo(Currency::class);
    }
    public function products(){
        return $this->belongsToMany(Product::class)->withTimestamps()->withPivot(['product_size_id', 'product_color_id', 'color', 'size', 'type', 'quantity', 'price', 'subtotal', 'created_at']);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function shippingAddress(){
        return $this->belongsTo(ShippingAddress::class);
    }
    public function billingAddress(){
        return $this->belongsTo(BillingAddress::class);
    }
    public function coupon(){
        return $this->belongsTo(Coupon::class);
    }
    public function orderTrackings(){
        return $this->hasMany(OrderTracking::class);
    }
    public function totalToString(){
        return '$'.number_format($this->total, 2).' '.$this->currency;
    }
    public function subtotalToString(){
        return '$'.number_format($this->subtotal, 2).' '.$this->currency;
    }
    public function shippingPriceToString(){
        return '$'.number_format($this->shipping_price, 2).' '.$this->currency;
    }
    public function statusToString(){
        $status = '';
        switch($this->status){
            case 'Confirmado':
                $status = '<div class="badge badge-success">'.$this->status.'</div>';
                break;
            case 'Procesando':
                $status = '<div class="badge badge-success">'.$this->status.'</div>';
                break;
            case 'Enviado':
                $status = '<div class="badge badge-primary">'.$this->status.'</div>';
                break;
            case 'Completado':
                $status = '<div class="badge badge-primary">'.$this->status.'</div>';
                break;
            case 'Devolución':
                $status = '<div class="badge badge-info">'.$this->status.'</div>';
                break;
            case 'Cancelado':
                $status = '<div class="badge badge-danger">'.$this->status.'</div>';
                break;
            default:
                $status = '<div class="badge badge-warning">Status no encontrado</div>';
                break;
        }
        return $status;
    }
    public function paymentStatusToString(){
        $paymentStatus = '';
        switch($this->payment_status){
            case 'Aprobado':
                $paymentStatus = '<div class="badge badge-success">'.$this->payment_status.'</div>';
                break;
            case 'Pendiente':
                $paymentStatus = '<div class="badge badge-warning">'.$this->payment_status.'</div>';
                break;
            case 'Rechazado':
                $paymentStatus = '<div class="badge badge-danger">'.$this->payment_status.'</div>';
                break;
            default:
                $paymentStatus = '<div class="badge badge-warning">Status no encontrado</div>';
                break;
        }
        return $paymentStatus;
    }
    public static function getConvertCurrencyDefaults($orders, $attribute){
        $convert = 0;
        foreach($orders as $order):
            $convert += self::getConvertCurrencyDefault($order, $attribute);
        endforeach;
        return $convert;
    }
    public static function getConvertCurrencyDefault($order, $attribute){
        $convert = 0;
        $currencyDefault = Currency::getDefault();
        if($order->currency == $currencyDefault->code):
            $convert = floatval($order->$attribute / $currencyDefault->value);
        else:
            $currency = Currency::getCurrencyByCode($order->currency);
            $currencyValue = $order->currency_value;
            if($currency->value != $order->currency_value):
                $currencyValue = $currency->value;
            endif;
            $convert = floatval($order->$attribute * $currencyValue);
        endif;
        return $convert;
    }
    public function getImageByPayment(){
        $paymentMethod = strtolower($this->payment_method);
        switch (true):
            case (strpos($paymentMethod, 'mercadopago') !== false):
                $paymentImage = asset('assets/admin/media/method_payment/mercadopago.png.png');
                break;
            case (strpos($paymentMethod, 'paypal') !== false):
                $paymentImage = asset('assets/admin/media/method_payment/paypal.png');
                break;
            case (strpos($paymentMethod, 'stripe') !== false):
                $paymentImage = asset('assets/admin/media/method_payment/stripe.png');
                break;
            case (strpos($paymentMethod, 'transfer') !== false):
                $paymentImage = asset('assets/admin/media/method_payment/transfer.png');
                break;
            default:
                // Si no coincide con ninguno de los métodos de pago conocidos, aquí puedes asignar una imagen predeterminada.
                $paymentImage = asset('assets/admin/media/svg/files/blank-image.svg');
                break;
        endswitch;
        return $paymentImage;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
    //Scopes
    public function scopeValidateOrder($query){
        return $query->whereNotIn('status', [Order::STATUS_CANCELED, Order::STATUS_REFUND])
        ->where('payment_status', Order::PAYMENT_STATUS_APPROVED);
    }

}
