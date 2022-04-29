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
            'success1' => 'User deleted',
            'existed' => 'Package is using',
            'failed' => 'Failed to deleted',
        ]
    ],
    'file' => [
        'empty' => 'File not found',
        'failed' => [
            'error' => "Your file name isn't correct",
            'full' => 'Your package is full',
            'size' => 'Your file is oversize',
        ],
        'success' => "Upload file success",
    ],
    'dashboard' => [
        'label' => [
            '1' => 'Users',
            '2' => 'Files',
            '3' => 'Package',
        ],
        'packages' => [
            '1' => 'Basic',
            '2' => 'Normal',
            '3' => 'Vip',
            '4' => 'Expert',
        ]
    ]
];
