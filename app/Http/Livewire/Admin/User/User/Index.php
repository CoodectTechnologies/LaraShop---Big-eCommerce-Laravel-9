<?php

namespace App\Http\Livewire\Admin\User\User;

use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Storage;
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

    public function updatingSearch(){
        $this->resetPage();
    }
    public function render(){
        $users = User::query()->with(['roles', 'image', 'session'])->orderBy('id', 'desc');
        if($this->search):
            $users = $users->where('name', 'LIKE', "%{$this->search}%")->orWhere('email', 'LIKE', "%{$this->search}%");
        endif;
        $users = $users->paginate($this->perPage);
        return view('livewire.admin.user.user.index', compact('users'));
    }
    public function destroy(User $user){
        try{
            if($user->image):
                if(Storage::exists($user->image->url)){
                    Storage::delete($user->image->url);
                }
                $user->image()->delete();
            endif;
            $user->delete();
            $this->emit('alert', 'success', __('Successful elimination'));
        }catch(Exception $e){
            $this->emit('alert', 'error', $e->getMessage());
        }
    }
}
