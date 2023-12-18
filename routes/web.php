<?php

use Illuminate\Support\Facades\Route;

Route::get('/store/{store}/orders', \App\Livewire\Order\Index\Page::class)
    ->middleware('can:view,store');
