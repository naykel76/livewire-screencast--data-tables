<?php

use Illuminate\Support\Facades\Route;

// ...

Route::get('/store/{store}/orders', App\Livewire\Order\Page::class);
