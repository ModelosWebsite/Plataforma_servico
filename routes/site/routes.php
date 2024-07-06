<?php

use App\Http\Controllers\Site\SiteController;
use App\Livewire\Shopping\StatusDelivery;
use Illuminate\Support\Facades\Route;

Route::controller(SiteController::class)->group(function(){
    Route::get("/{company}", "index")->name("site.index");
    Route::get("/{company}/loja/online/", "shopping")->name("platafom.service.product.list");
    Route::get("/loja/adicionar/{company}/{id}", "addCart")->name("platafom.service.loja.add.cart");
    Route::get("/loja/Carrinho/{company}", "getCart")->name("plataform.service.get.cart");
    Route::get("/estado/encomenda", "deliveryStatus")->name("plataform.service.get.status");
});

Route::get("/encomenda/loja/{id}", StatusDelivery::class)->name("plataform.service.delivery.status");