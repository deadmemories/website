<?php

Route::post('/register', 'Auth\AuthApi@register');
Route::post('/login', 'Auth\AuthApi@login');

// Image
Route::post('/image/save', 'Image\ImageApi@save');