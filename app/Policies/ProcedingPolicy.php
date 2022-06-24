<?php

namespace App\Policies;

use App\Models\Proceding;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProcedingPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function metodo_autorizador_procedings_secretario(User $user, Proceding $proceding)
    {
        if ($user->secretary->office->id == $proceding->office->id) {
            return true;
        } else {

            //Solo identificara al rol admin, no se añade un else para el rol secretario ya que por ahora el admin puede ser secretario y admin a la vez
            foreach ($user->roles as $role) {
                if ($role->name == 'admin') {
                    return true;
                }
            }
            return false;
        }
    }

    public function metodo_autorizador_procedings_aplicant(User $user, Proceding $proceding)
    {
        if ($user->id == $proceding->user_id) {
            return true;
        } else {
            return false;
        }
    }
}
