<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecipeRequest;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Recipe_ingredient;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        $recipes = Recipe::all();
        $recipeCosts = [];
        foreach ($recipes as $key => $recipe) {
            list($ingredients, $totalReceipeCost) = $this->caculateRecipeCost($recipe->id);
            $recipe->total_cost = $totalReceipeCost;
            $recipeCosts[] = [
                'id' => $recipe->id,
                'title' => $recipe->title,
                'instructions' => $recipe->instructions,
                'preparation_time' => $recipe->preparation_time,
                'servings' => $recipe->servings,
                'total_ingredients' => count($ingredients),
                'total_cost' => $totalReceipeCost,
            ];
        }
        $recipes = collect($recipes);
        return view('Recipes.index', compact('recipes'));
    }

    public function addRecipe(){
        $ingredients = Ingredient::all();
        return view('Recipes.add', compact('ingredients'));
    }

    public function saveRecipe(RecipeRequest $request){
        
        $recipe = new Recipe();
        $recipe->title = $request->input('title');
        $recipe->instructions = $request->input('instructions');
        $recipe->preparation_time = $request->input('preparation_time');
        $recipe->servings = $request->input('servings');
        $recipe->save();

        $isRecipeSaved = $recipe->id ? true : false;
        $idRecipeSaved = $recipe->id;
        if ($isRecipeSaved) {
            $ingredientIds = $request->input('ingredients');
            $ingredientQuantities = $request->input('ingredient_quantities');
            $syncData = [];
            foreach ($ingredientIds as $index => $ingredientId) {
                $quantity = $ingredientQuantities[$index] ?? 1;
                $syncData[$ingredientId] = ['quantity' => $quantity];
            }

            foreach ($syncData as $key => $ingredient) {
                $IngredientRecipe = new Recipe_ingredient();
                $IngredientRecipe->recipe_id = $idRecipeSaved;
                $IngredientRecipe->ingredient_id = $key;
                $IngredientRecipe->quantity = $ingredient['quantity'];
                $IngredientRecipe->save();
            }

            return redirect()->route('recipes.index')->with('success', "Recipe {$recipe->title} created successfully.");
        }
    }

    public function showRecipe($id){
        $recipe = Recipe::find($id);
        list($ingredients, $totalReceipeCost) = $this->caculateRecipeCost($id);
        
        $ingredients = collect($ingredients);
        return view('Recipes.show', compact('recipe','ingredients','totalReceipeCost'));
    }


    public function caculateRecipeCost($id){
        $ingredientsRecipe = Recipe_ingredient::where('recipe_id', $id)->join('ingredients', 'recipe_ingredients.ingredient_id', '=', 'ingredients.id')->get();
        $ingredients = [];
        $totalReceipeCost = 0;
        foreach ($ingredientsRecipe as $key => $ingredient) {
            $quantity = intval($ingredient->quantity);
            $cost = floatval($ingredient->cost);
            $totalCost = $quantity * $cost;
            $totalReceipeCost += $totalCost;
            $ingredients[] = [
                'name' => $ingredient->name,
                'quantity' => $quantity,
                'unit' => $ingredient->unit,
                'unit_cost' => $cost,
                'total_cost' => $totalCost,
            ];
        }
        return [$ingredients, $totalReceipeCost];
    }   
}
