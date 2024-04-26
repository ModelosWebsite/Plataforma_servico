<?php

use App\Http\Controllers\Login\LoginController;
use Illuminate\Support\Facades\Route;

Route::controller(LoginController::class)->group(function(){
    Route::get("/login/view", "loginview")->name("anuncio.login.view");
    Route::post("/login", "login")->name("anuncio.login");
    Route::get("/sair", "logout")->name("anuncio.logout");
});