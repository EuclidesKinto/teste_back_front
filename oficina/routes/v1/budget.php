<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\BudgetController;

Route::prefix('v1/')->group(function (){
    Route::get('budgets/search', [BudgetController::class, 'search']);
    Route::get('budgets/searchDate', [BudgetController::class, 'searchDate']);
    Route::apiResource('budgets', BudgetController::class);
});
