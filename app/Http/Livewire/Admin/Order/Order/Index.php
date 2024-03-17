<?php

namespace App\Http\Livewire\Admin\Order\Order;

use App\Models\Order;
use App\Models\User;
use Exception;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $perPage = 50;
    public $search;
    protected $queryString = ['search' => ['except' => '']];
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['render'];
    public $user;
    public $status;
    public $paymentStatus;

    public function mount($user = null){
        if($user) $this->user = User::find($user->id);
    }
    public function updatingSearch(){
        $this->resetPage();
    }
    public function render(){
        if($this->user):
            $orders = $this->user->orders()->with('user')->orderBy('id', 'desc');
        else:
            $orders = Order::query()->with('user')->orderBy('id', 'desc');
        endif;
        if($this->search):
            $orders = $orders->where('number', 'LIKE', "%{$this->search}%")
            ->orWhereRelation('shippingAddress', 'email', 'LIKE', "%{$this->search}%")
            ->orWhereRelation('shippingAddress', 'name', 'LIKE', "%{$this->search}%");
        endif;
        if($this->status):
            $orders = $orders->where('status', $this->status);
        endif;
        if($this->paymentStatus):
            $orders = $orders->where('payment_status', $this->paymentStatus);
        endif;
        $orders = $orders->paginate($this->perPage);
        return view('livewire.admin.order.order.index', compact('orders'));
    }
    public function destroy(Order $order){
        try{
            $order->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
