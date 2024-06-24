<?php

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

require __DIR__."/site/routes.php";
require __DIR__."/admin/admin.php";
require __DIR__."/login/login.php";
require __DIR__."/SuperAdmin/routes.php";

Route::get("/data/senha", function(){
    return Hash::make("123");
});