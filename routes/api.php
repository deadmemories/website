<?php

Route::post('/register', 'Auth\AuthApi@register');
Route::post('/login', 'Auth\AuthApi@login');

// Image
Route::post('/image/save', 'Image\ImageApi@save');

// Anime
Route::get('/anime/get', 'Anime\AnimeApi@getAnime');

// User
Route::get('/user/get', 'User\UserApi@getUsers');
Route::get('/user/{id}', 'User\UserApi@getUser');