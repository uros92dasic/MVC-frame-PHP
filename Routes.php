<?php
return[
    App\Core\Route::get('|^odeljenje/([0-9]+)/?$|', 'Odeljenje', 'show'),
    App\Core\Route::get('|^odeljenje/([0-9]+)/delete/?$|', 'Odeljenje', 'delete'),

    App\Core\Route::get('|^radnik/([0-9]+)/?$|', 'Radnik', 'show'),

    App\Core\Route::get('|^projekat/([0-9]+)/?$|', 'Projekat', 'show'),

    App\Core\Route::any('|^.*$|', 'Main', 'home')
];