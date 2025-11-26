@extends('layouts.landing')

@section('title', 'Recipes Book')
@section('content')
    <div class="container text-center">
        <h1 class="mt-4">Add Recipe</h1>
    </div>
    <div class="container">
        <form method="POST" action="{{ route('recipes.save') }}">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Recipe Title</label>
                <input type="text" class="form-control" id="title" name="title">
                @error('title')
                    <div class="error">
                        <p style="color: red">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="instructions" class="form-label">Instructions</label>
                <textarea class="form-control" id="instructions" name="instructions"></textarea>
                @error('instructions')
                    <div class="error">
                        <p style="color: red">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="preparation_time" class="form-label">Preparation Time <small>(minutes)</small></label>
                <input type="text" class="form-control" id="preparation_time" name="preparation_time">
                @error('preparation_time')
                    <div class="error">
                        <p style="color: red">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="servings" class="form-label">Servings</label>
                <input type="number" class="form-control" id="servings" name="servings">
                @error('servings')
                    <div class="error">
                        <p style="color: red">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div class="mb-3" id="boxIngredients">
                <div class="alert alert-warning" role="alert">
                    For the given ingredient with its unit, only enter the quantity based on that unit.
                </div>
                <div class="d-flex align-items-center gap-2">
                    <label class="form-label mb-0">Ingredients</label>
                    <select class="form-select" id="ingredients" name="ingredients[]">
                        <option value="">Select ingredient</option>
                        @foreach ($ingredients as $ingredient)
                            <option value="{{ $ingredient->id }}">{{ $ingredient->name }} (Measurement
                                Unit:{{ $ingredient->unit }})</option>
                        @endforeach
                    </select>
                    <input type="text" class="form-control" id="ingredient_quantities" name="ingredient_quantities[]"
                        placeholder="Enter quantities">
                    <button type="button" class="btn btn-success" id="addIngredient">+</button>
                    <button type="button" class="btn btn-danger" id="removeIngredient">-</button>
                </div>
                @error('ingredients')
                    <div class="error mt-1">
                        <p style="color: red; margin: 0;">{{ $message }}</p>
                    </div>
                @enderror
                @error('ingredients.*')
                    <div class="error mt-1">
                        <p style="color: red; margin: 0;">{{ $message }}</p>
                    </div>
                @enderror
                @error('ingredient_quantities')
                    <div class="error mt-1">
                        <p style="color: red; margin: 0;">{{ $message }}</p>
                    </div>
                @enderror
                @error('ingredient_quantities.*')
                    <div class="error mt-1">
                        <p style="color: red; margin: 0;">{{ $message }}</p>
                    </div>
                @enderror
            </div>
            <div id="ingredientsContainer"></div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{ route('recipes.index') }}" class="btn btn-danger">Back</a>
        </form>
    </div>
@endsection


<script>
    document.addEventListener('DOMContentLoaded', function() {
        let ingredients = @json($ingredients);
        let ingredientsContainer = document.getElementById('ingredientsContainer');

        function addIngredientRow() {
            let ingredientOptions = '<option value="">Select ingredient</option>';
            ingredients.forEach(ingredient => {
                ingredientOptions +=
                    `<option value="${ingredient.id}">${ingredient.name} (Measurement Unit: ${ingredient.unit})</option>`;
            });

            let newRow = document.createElement('div');
            newRow.className = 'mb-3 d-flex align-items-center gap-2 ingredient-row';
            newRow.innerHTML = `
                <label class="form-label mb-0">Ingredients</label>
                <select class="form-select" name="ingredients[]">
                    ${ingredientOptions}
                </select>
                <input type="text" class="form-control" name="ingredient_quantities[]" placeholder="Enter quantities">
                <button type="button" class="btn btn-success btn-add-ingredient">+</button>
                <button type="button" class="btn btn-danger btn-remove-ingredient">-</button>
            `;
            ingredientsContainer.appendChild(newRow);

            newRow.querySelector('.btn-add-ingredient').addEventListener('click', addIngredientRow);
            newRow.querySelector('.btn-remove-ingredient').addEventListener('click', function() {
                newRow.remove();
            });
        }

        document.getElementById('addIngredient').addEventListener('click', addIngredientRow);

        document.getElementById('removeIngredient').addEventListener('click', function() {
            let rows = ingredientsContainer.querySelectorAll('.ingredient-row');
            if (rows.length > 0) {
                rows[rows.length - 1].remove();
            }
        });
    });
</script>
