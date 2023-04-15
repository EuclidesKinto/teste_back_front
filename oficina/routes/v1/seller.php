<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\SellerController;

Route::prefix('v1/')->group(function (){
    Route::apiResource('sellers', SellerController::class);
});
