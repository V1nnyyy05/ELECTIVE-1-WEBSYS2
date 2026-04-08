<?php

use Illuminate\Support\Facades\Route;

Route::get('eval/{name}/{prelim}/{midterm}/{final}', function ($name, $prelim, $midterm, $final) {

    return view('welcome', [
        'name' => $name,
        'prelim' => $prelim,
        'midterm' => $midterm,
        'final' => $final,
    ]);
}); 