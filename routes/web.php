<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('go', function () {
    // Artisan::call('migrate:fresh');
    // Artisan::call('db:seed');
});

Route::get('/', function () {
    return redirect()->route('filament.user.auth.login');
    // return view('welcome');
});

Route::get('sl/{user_id}', function ($user_id) {
    Auth::loginUsingId($user_id);

    return 'logged in';
});
