<?php

use App\Models\User;

if (! function_exists('is_admin')) {
    function is_admin($boolean) {
        $user = auth()->user()->id;
        $roles = User::where('id', $user)->where('isAdmin', $boolean)->exists();
        if ($user && $roles) {
            return true;
        }
        return false;
    }
}
if (! function_exists('is_sub_admin')) {
    function is_sub_admin($boolean) {
        $user = auth()->user()->id;
        $roles = User::where('id', $user)->where('isSubAdmin', $boolean)->exists();
        if ($user && $roles) {
            return true;
        }
        return false;
    }
}
