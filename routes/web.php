<?php

Route::any('{all}', function () {
    return view('vue-main');
})->where(['all' => '.*']);