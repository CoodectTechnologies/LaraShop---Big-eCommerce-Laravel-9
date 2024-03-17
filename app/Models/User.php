<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use CyrildeWit\EloquentViewable\Contracts\Viewable;
use CyrildeWit\EloquentViewable\InteractsWithViews;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Viewable
{
    use HasApiTokens, HasRoles, HasFactory, Notifiable, Sluggable, LogsActivity, InteractsWithViews, CausesActivity;

    protected $guarded = [];
    protected $removeViewsOnDelete = true;
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getActivitylogOptions(): LogOptions {
        return LogOptions::defaults()
        ->useLogName('Usuario')
        ->setDescriptionForEvent(fn(string $eventName) => "Un usuario ha sido {$eventName}")
        ->dontSubmitEmptyLogs()
        ->logOnlyDirty()
        ->logAll();
    }
    public function getRouteKeyName(){
        return 'slug';
    }
    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function profile(){
        return $this->hasOne(Profile::class);
    }
    public function sessions(){
        return $this->hasMany(Session::class);
    }
    public function session(){
        return $this->hasOne(Session::class)->latestOfMany();
    }
    public function image(){
        return $this->morphOne(Image::class, 'imageable');
    }
    public function comments(){
        return $this->morphMany(Comment::class, 'commentable');
    }
    public function reviews(){
        return $this->morphMany(Review::class, 'reviewable');
    }
    public function reactions(){
        return $this->morphMany(Reaction::class, 'reactionable');
    }
    public function blogPosts(){
        return $this->hasMany(BlogPost::class);
    }
    public function orders(){
        return $this->hasMany(Order::class);
    }
    public function shippingAddresses(){
        return $this->hasMany(ShippingAddress::class);
    }
    public function billingAddresses(){
        return $this->hasMany(BillingAddress::class);
    }
    public function ordersCount(){
        return count($this->orders);
    }
    public function ordersIncome(){
        return $this->orders()->sum('total');
    }
    public function shippingAddressDefect(){
        return $this->shippingAddresses()->where('default', true)->first();
    }
    public function billingAddressDefect(){
        return $this->billingAddresses()->where('default', true)->first();
    }
    //Gets
    public function accessToPanel(){
        $access = false;
        if(empty(array_intersect(['Cliente'], $this->roles->pluck('name')->toArray()))):
            $access = true;
        endif;
        return $access;
    }
    public function isOnline(){
        $online = false;
        if($this->session && !$this->session->isExpired()):
            $online = true;
        endif;
        return $online;
    }
    public function imagePreview(){
        $image = asset('assets/admin/media/avatars/blank.png');
        if($this->image):
            if(Storage::exists($this->image->url)):
                $image = Storage::url($this->image->url);
            else:
                $image = $this->image->url;
            endif;
        endif;
        return $image;
    }
    public function getDigitalProducts(){
        $productsDigitals = collect();
        $orders = $this->orders->where('payment_status', 'Aprobado')->whereNotIn('status', ['Cancelado', 'Devolución']);
        foreach($orders as $order):
            foreach($order->products as $product):
                if($product->pivot->type == Product::TYPE_DIGITAL):
                    $productsDigitals->push($product);
                endif;
            endforeach;
        endforeach;
        return $productsDigitals;
    }
    public function dateToString(){
        return Carbon::parse($this->created_at)->toFormattedDateString();
    }
    public function viewUniques(){
        return views($this)->unique()->count();
    }
}
