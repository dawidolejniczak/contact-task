<?php

Route::get('/', function () {
    return view('welcome');
});

Route::resource('messages', 'MessagesController')->only([
    'index', 'create', 'store'
]);
