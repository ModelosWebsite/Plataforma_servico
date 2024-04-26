<?php

use Illuminate\Support\Facades\Route;
//Routes do administrador do site para manipulação

use App\Http\Controllers\Admin\AdminController;
//Routes do administrador do site para manipulação
Route::middleware("auth")->controller(AdminController::class)->prefix("/admin/")->group(function(){
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