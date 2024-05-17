<?php

use App\Http\Controllers\SuperAdmin\DocumentationController;
use App\Http\Controllers\SuperAdmin\PacoteController;
use App\Http\Controllers\SuperAdmin\RegisterCompanyController;
use App\Http\Controllers\SuperAdmin\SuperAdminController;
use App\Http\Controllers\SuperAdmin\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->group(function(){
    Route::controller(SuperAdminController::class)->prefix("/super/admin")->group(function(){
        Route::get("/inicial", "index")->name("super.admin.index");
    });
    
    Route::controller(RegisterCompanyController::class)->prefix("/super/admin")->group(function(){
        Route::get("/contas", "accountView")->name("super.admin.account.view");
        Route::post("/registrar/empresa", "companyRegister")->name("super.admin.register.company");
        Route::post("/actualizar/company/{id}", "updateCompany")->name("super.admin.update.company");
        Route::get("/eliminar/company/{id}", "deleteCompany")->name("super.admin.delete.company");
    });
    
    Route::controller(UserController::class)->prefix("/super/admin")->group(function(){
        Route::get("/utilizadores/lista", "userView")->name("super.admin.user.view");
        Route::get("/eliminar/user/{id}", "deleteUser")->name("super.admin.delete.user");
    });
    
    Route::controller(PacoteController::class)->prefix("/super/admin")->group(function(){
        Route::get("/pacote/premium", "mainView")->name("super.admin.pacote.view");
        Route::post("/pacote/store", "store")->name("super.admin.pacote.store");
        Route::post("/pacote/actualizar/{id}", "updatePacote")->name("super.admin.pacote.update");
    });
    
    Route::controller(DocumentationController::class)->prefix("/super/admin")->group(function(){
        Route::get("/documentação/incial", "index")->name("super.admin.documentation.index");
        Route::post("/documentação/criar", "store")->name("super.admin.documentation.store");
    });
});