<?php

$allowedPages = [
    'home', 'login', 'register',
    'create', 'manage', 'edit',
    'post', 'logout', 'profile',
    'forbidden', 'not_found'
];


$tokenPages = [
    'login', 'register', 'profile',
    'create', 'edit',
];

return [
    'token_pages' => $tokenPages,
    'allowed_pages' => $allowedPages,
];