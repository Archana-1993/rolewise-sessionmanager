<?php

use Spatie\Permission\Models\Role;

return [
    'session_lifetime' => function () {
        if (auth()->check()) {
            $role = auth()->user()->roles->first(); // Assuming user has only one role

            if ($role && isset($role->session_lifetime)) {
                return $role->session_lifetime;
            }
        }

        return config('session.lifetime'); // Default Laravel session lifetime
    },
];
