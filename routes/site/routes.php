<?php

use App\Http\Controllers\Site\SiteController;
use Illuminate\Support\Facades\Route;

Route::controller(SiteController::class)->group(function(){
    Route::get("/{company}", "index")->name("site.index");
});