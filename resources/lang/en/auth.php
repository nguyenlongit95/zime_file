<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'failed' => 'These credentials do not match our records.',
    'password' => 'The provided password is incorrect.',
    'throttle' => 'Too many login attempts. Please try again in :seconds seconds.',
    'signup_success' => 'Sign up success',
    'signup_failed' => 'Sign up failed',
    'login_failed' => 'Your account does not exit',
    'admin' => [
        'empty' => 'Data not found',
        'create' => [
            'success' => 'Create package success',
            'failed' => 'Create package failed',
        ],
        'update' => [
            'success' => 'Package updated',
            'failed' => 'Failed to update',
        ],
        'delete' => [
            'success' => 'Package deleted',
            'existed' => 'Package is using',
            'failed' => 'Failed to deleted',
        ]
    ]
];
