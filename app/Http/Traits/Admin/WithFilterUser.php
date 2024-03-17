<?php
namespace App\Http\Traits\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

trait WithFilterUser {

    // Para relaciones belongTo
    private function filterUser($model, $user = null){
        $userPresent = User::find(Auth::id());
        if($user):
            //Obtener todos los datos relacionados al ID del usuario que se le haya pasado como argumento al componente
            $model = $model->where('user_id', $user->id);
        elseif(!$userPresent->hasAnyRole(['Administrador'])):
            //Si no es administrador, se va a limitar a ver sus propios datos y los datos de los usuarios que esten bajo su cargo
            $model = $model->where(function($query){
                $query->whereHas('user', function($query){
                    $query->where('user_id', Auth::id());
                });
            });
        endif;
        return $model;
    }
}
