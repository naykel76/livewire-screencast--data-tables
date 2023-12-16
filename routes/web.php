<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Order\Index\Page;

Route::get('/store/{store}/orders', Page::class)
    ->middleware('can:view,store');
