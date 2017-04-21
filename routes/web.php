<?php

Route::get('/', function () {
    dd(app()->make(\Bundle\Model\Image\DatabaseImage::class));
//    dd(app('MakeSingle', ['qweokqwejiqwej']));
    return view('vue-main');
});
