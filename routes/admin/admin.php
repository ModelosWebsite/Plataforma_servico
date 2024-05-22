<?php

use App\Http\Controllers\Admin\AccountController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\ConditionsController;
use App\Http\Controllers\Admin\ConfigSiteController;
use App\Http\Controllers\Admin\QuestionCOntroller;
use Illuminate\Support\Facades\Route;

Route::middleware("auth")->prefix("/admin/")->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get("index", "index")->name("admin.index");
        Route::get("hero/", "heroview")->name("admin.view.hero");
        Route::post("register/", "registerdatas")->name("admin.store.hero");
        Route::get("edit/data/{id}", "edit")->name("admin.edit.data");
        Route::post("update/{id}", "update")->name("admin.update");
        
        Route::get("detail", "detailview")->name("admin.detail");
        Route::post("detail/store", "storeDetail")->name("admin.store.detail");
        Route::post("detaol/{id}", "actualizarDetalhes")->name("admin.detalhes.update");

        //Contacto e Footer
        Route::get("footer", "footer")->name("admin.footer");
        Route::post("contacto", "contactStore")->name("admin.footer.store");
        Route::get("contact/{id}", "editContact")->name("admin.edit.conatct");
        Route::post("contact/update/{id}", "actualizarContact")->name("admin.contact.update");
        
        //Detalhes
        Route::get("admin/datalhes/{id}", "editDetalhes")->name("admin.edit.detalhes");

        //About
        Route::get("about", "about")->name("admin.about");
        Route::post("about/store", "storeAbout")->name("admin.store.about");
        Route::get("about/edit/{id}", "editAbout")->name("admin.edit.about");
        Route::post("about/actualizar/{id}", "actualizarAbout")->name("admin.about.update");
        
        Route::get("service", "viewservice")->name("admin.view.services");
        Route::post("service", "storeservice")->name("admin.store.service");
        Route::get("service/{id}", "editservice")->name("admin.view.edit.service");
        Route::post("actualizar/{id}", "actualizarservice")->name("admin.update.service");

        //Alteração de cores do website
        Route::get("cor", "colorview")->name("anuncio.management.view.color");
        Route::post("cor/save", "storecolor")->name("anuncio.management.store.color");
        Route::post("cor/actualizar", "selectColor")->name("anuncio.management.actualizar.color");
    });

    Route::controller(AccountController::class)->group(function(){
        Route::get("/minha/conta", "index")->name("admin.account.view");
        Route::post("/conta/dados/save/{id}", "updateProfile")->name("admin.account.store");
    });

    Route::controller(ConfigSiteController::class)->group(function(){
        Route::get("/config/site", "configView")->name("admin.config.view");
        Route::put("/config/status", "updateStatus")->name("admin.update.status.company");
    });

    Route::controller(ConditionsController::class)->group(function(){
        Route::get("termos/condições", "conditionsView")->name("admin.conditions.view");
        Route::post("termos/condições/save", "conditionsCreate")->name("admin.conditions.create");
        Route::put('/items/update-status', 'termoStatus')->name('items.updateStatus');
    });

    Route::controller(QuestionCOntroller::class)->group(function(){
        Route::get("/perguntas/frequentes", "index")->name("admin.panel.question");
    });
});