<?php

return [
    'home'           => [
        'action'     => [HomeController::class, 'home']
    ],
    'register'       => [
        'action'     => [UserController::class, 'add']
    ],
    'logout'         => [
        'action'     => [UserController::class, 'connect']
    ],
    'login'          => [
        'action'     => [UserController::class, 'connect']
    ],
    'profil'         => [
        'action'     => [UserController::class, 'update']
    ],
    'items'          => [
        'action'     => [ItemController::class, 'items']
    ],
    'contact'        => [
        'action'     => [ContactController::class, 'add']
    ],
    'item'           => [
        'action'     => [ItemController::class, 'item']
    ],
    'admin'          => [
        'action'     => [AdminController::class, 'admin']
    ],
    'admin_items'    => [
        'action'     => [AdminController::class, 'items']
    ],
    'admin_items_add'=> [
        'action'     => [AdminController::class, 'add']
    ],
    'itemsBySearch'  => [
        'action'     => [ItemController::class, 'itemsBySearch']
    ],
    'admin_update'   => [
        'action'     => [AdminController::class, 'update']
    ],
    'recipse_message'=> [
        'action'     => [MessageController::class, 'message']
    ],
    'message'        => [
        'action'     => [MessageController::class, 'messageById']
    ],
    'deleteMessageById'  => [
        'action'     => [MessageController::class, 'deleteMessageById']      
    ],
    'addToCart'      => [
        'action'     => [BasketController::class, 'addToCart']
    ],
    'cart'           => [
        'action'     => [BasketController::class, 'readToCart']
    ],
    'deleteAllCart'  => [
        'action'     => [BasketController::class, 'deleteAllCart']
    ]
    
    
];

?>