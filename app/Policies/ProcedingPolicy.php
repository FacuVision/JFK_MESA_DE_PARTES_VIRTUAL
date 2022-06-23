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
