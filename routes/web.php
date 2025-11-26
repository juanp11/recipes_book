<?php

use App\Http\Controllers\IngredientController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;


Route::controller(IngredientController::class)->group(function () {
    Route::get('/ingredients', 'index')->name('ingredients.index');
    Route::get('/ingredients/add', 'addIngredient')->name('ingredients.add');
    Route::post('/ingredients/save', 'saveIngredient')->name('ingredients.save');
    Route::get('/ingredients/edit/{id}', 'editIngredient')->name('ingredients.edit');
    Route::put('/ingredients/update/{id}', 'updateIngredient')->name('ingredients.update');
    Route::delete('/ingredients/delete/{id}', 'deleteIngredient')->name('ingredients.delete');
});


Route::controller(RecipeController::class)->group(function () {
    Route::get('/', 'index')->name('recipes.index');
    Route::get('/recipes/add', 'addRecipe')->name('recipes.add');
    Route::post('/recipes/save', 'saveRecipe')->name('recipes.save');
    Route::get('/recipes/show/{id}', 'showRecipe')->name('recipes.show');
});