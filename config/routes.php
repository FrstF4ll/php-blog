<?php

return [
    'GET' => [
        'home' => ['PageController', 'home'],
        'post' => ['PageController', 'post'],
        'manage' => ['PageController', 'manage'],

        'login' => ['PageController', 'login'],
        'register' => ['PageController', 'register'],
        'profile' => ['PageController', 'profile'],
        'logout' => ['PageController', 'logout'],

        'create' => ['PageController', 'create'],

        'edit' => ['PageController', 'edit'],

        'forbidden' => ['PageController', 'forbidden'],
        'not_found' => ['PageController', 'not_found'],
    ],
    'POST' => [
        'login' => ['UserController', 'authenticateSession'],
        'register' => ['UserController', 'store'],
        'profile' => ['UserController', 'editUserProfile'],

        'create' => ['PostController', 'createPost'],
        'edit' => ['PostController', 'editPost'],
        'logout' => ['PageController', 'logout'],
    ],
];