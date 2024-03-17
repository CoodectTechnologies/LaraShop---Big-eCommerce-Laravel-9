<?php

namespace App\Http\Livewire\Admin\User\User;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class Form extends Component
{
    use WithFileUploads;

    #User
    public $user;
    public $profile;
    public $method;
    public $imageTmp;
    public $password;
    public $password_confirmation;
    #Role
    public $userRolesArray = [];

    protected function rules(){
        return [
            'user.name' => 'required',
            'user.email' => 'required|email|unique:users,email,'.$this->user->id,
            'profile.title' => 'nullable',
            'profile.biography' => 'nullable',
            'profile.website' => 'nullable',
            'profile.facebook' => 'nullable',
            'profile.instagram' => 'nullable',
            'profile.linkedin' => 'nullable',
            'profile.twitter' => 'nullable',
            'profile.youtube' => 'nullable',
            'imageTmp' => 'nullable|image',
        ];
    }
    public function mount(User $user, $method){
        $this->user = $user;
        $this->profile = $user->profile ?? new Profile();
        $this->method = $method;
        $this->userRolesArray = $user->roles()->pluck('name')->toArray();
    }
    public function render(){
        $roles = Role::orderBy('id', 'desc')->get();
        return view('livewire.admin.user.user.form', compact('roles'));
    }
    public function store(){
        $this->validate();
        $this->savePassword();
        $this->user->save();
        $this->profile = $this->user->profile()->create($this->profile->toArray());
        $this->saveImage();
        $this->saveRoles();
        $this->user = new User();
        $this->reset('imageTmp');
        $this->emit('alert', 'success', 'Usuario agregado con éxito');
        $this->emit('render');
    }
    public function update(){
        $this->validate();
        $this->savePassword();
        $this->user->update();
        $this->profile->update();
        $this->saveImage();
        $this->saveRoles();
        $this->emit('alert', 'success', 'Actualización con éxito');
        $this->emit('render');
    }
    public function saveImage(){
        if($this->imageTmp){
            $url = $this->imageTmp->store('public/user');
            imageManager($url, 200, $this->user);
        }
    }
    public function removeImage(){
        if($this->user->image){
            if(Storage::exists($this->user->image->url)){
                Storage::delete($this->user->image->url);
            }
            $this->user->image()->delete();
            $this->user->image = null;
        }
        $this->reset('imageTmp');
        $this->emit('alert', 'success', __('Image successfully deleted'));
    }
    public function savePassword(){
        if($this->password && $this->password_confirmation){
            $this->validate([
                'password' => 'string|min:8|confirmed',
            ]);
            $this->user->password = Hash::make($this->password);
            $this->emit('alert', 'success', 'Contraseña guardada con éxito');
        }
    }
    public function saveRoles(){
        if($this->userRolesArray){
            $this->user->syncRoles($this->userRolesArray);
        }
    }
}
