<?php

use App\Http\Controllers\SuperAdmin\PacoteController;
use App\Http\Controllers\SuperAdmin\RegisterCompanyController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\SuperAdmin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->controller(SuperAdminController::class)->prefix("/super/admin")->group(function(){
    Route::get("/inicial", "index")->name("super.admin.index");
    Route::get("/contas", "accountView")->name("super.admin.account.view");
});

Route::middleware("auth")->controller(RegisterCompanyController::class)->prefix("/super/admin")->group(function(){
    Route::post("/registrar/empresa", "companyRegister")->name("super.admin.register.company");
});

Route::middleware("auth")->controller(UserController::class)->prefix("/super/admin")->group(function(){
    Route::get("/utilizadores/lista", "userView")->name("super.admin.user.view");
});

Route::middleware("auth")->controller(PacoteController::class)->prefix("/super/admin")->group(function(){
    Route::get("/pacote/premium", "mainView")->name("super.admin.pacote.view");
    Route::post("/pacote/store", "store")->name("super.admin.pacote.store");
    Route::post("/pacote/actualizar/{id}", "updatePacote")->name("super.admin.pacote.update");
});
