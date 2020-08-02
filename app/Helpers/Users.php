<?php

use App\User;

function user($id = null)
{
    return is_null($id) ?  auth()->user() : User::find($id);
}

function has_role($role, $id = null)
{
    $user = is_null($id) ? auth()->user() : User::find($id);

    return $role == $user->role;
}

function has_roles($role, $id = null)
{
    $user = is_null($id) ? auth()->user() : User::find($id);

    return $role == $user->role;
}
