<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // Redirect to the first store's orders page
    $store = \App\Models\Store::first();
    if ($store) {
        return redirect()->route('store.orders', $store);
    }
    return response('No stores found', 404);
});

Route::get('/store/{store}/orders', \App\Livewire\Order\Index\Page::class)
    ->middleware('can:view,store')
    ->name('store.orders');
