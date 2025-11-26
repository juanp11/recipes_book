<?php

use App\Http\Controllers\IngredientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::controller(IngredientController::class)->group(function () {
    Route::get('/ingredients', 'index')->name('ingredients.index');
    Route::get('/ingredients/add', 'addIngredient')->name('ingredients.add');
    Route::post('/ingredients/save', 'saveIngredient')->name('ingredients.save');
    Route::get('/ingredients/edit/{id}', 'editIngredient')->name('ingredients.edit');
    Route::put('/ingredients/update/{id}', 'updateIngredient')->name('ingredients.update');
    Route::delete('/ingredients/delete/{id}', 'deleteIngredient')->name('ingredients.delete');
});
