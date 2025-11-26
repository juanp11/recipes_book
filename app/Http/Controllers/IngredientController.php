<?php

namespace App\Http\Controllers;

use App\Http\Requests\IngredientRequest;
use App\Models\Ingredient;
use Illuminate\Http\Request;
use Laravel\Prompts\Note;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::all();
        return view('Ingredients.index', compact('ingredients'));
    }

    public function addIngredient(){
        return view('Ingredients.add');
    }

    public function saveIngredient(IngredientRequest $request){
        $name = $request->input('name');
        $costFloat = floatval($request->input('cost'));

        $ingredient = new Ingredient();
        $ingredient->name = $name;
        $ingredient->cost = $costFloat;
        $ingredient->save();

        return redirect()->route('ingredients.index');
    }

    public function editIngredient($id){
        $ingredient = Ingredient::find($id);
        return view('Ingredients.edit',compact('ingredient'));
    }

    public function updateIngredient(IngredientRequest $request,$id){

        $ingredient = Ingredient::find($id);
        $ingredient->update($request->all());

        if($ingredient->wasChanged()){
            $changes = $ingredient->getChanges();
            $changedFields = implode(', ', array_keys($changes));
            // return redirect()->route('ingredients.index')->with('success',"Ingredient {$ingredient->name} updated successfully. Changed fields: {$changedFields}");
        }
        return redirect()->route('ingredients.index')->with('success',"Ingredient {$ingredient->name} updated successfully");
    }

    public function deleteIngredient($id){
        $ingredient = Ingredient::find($id);
        $ingredient->delete();
        return redirect()->route('ingredients.index')->with('success',"Ingredient {$ingredient->name} deleted successfully");
    }
}
