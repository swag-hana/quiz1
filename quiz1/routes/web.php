<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InventoryController;

Route::resource('/inventory', InventoryController::class);