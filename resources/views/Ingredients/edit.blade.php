@extends('layouts.landing')

@section('title', 'Recipes Book')
@section('content')
    <div class="container text-center">
        <h1 class="mt-4">Add Ingredients</h1>
    </div>
    <div class="container">
        <form method="POST" action="{{ route('ingredients.update', $ingredient->id) }}">
            @method('PUT')
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name Ingredient</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $ingredient->name }}">
                @error('name')
                <div class="error">
                    <p style="color: red">{{ $message }}</p>
                </div>
            @enderror
            </div>
            <div class="mb-3">
                <label for="cost" class="form-label">Cost</label>
                <input type="number" class="form-control" id="cost" name="cost" step="0.01" value="{{ $ingredient->cost }}"">
                @error('cost')
                <div class="error">
                    <p style="color: red">{{ $message }}</p>
                </div>
            @enderror
            </div>
            <div class="mb-3">
                <label for="unit" class="form-label">Unit</label>
                <select class="form-select" id="unit" name="unit">
                    <option value="">Select unit</option>
                    <option value="grams" {{ $ingredient->unit == 'grams' ? 'selected' : '' }}>Grams</option>
                    <option value="kilograms" {{ $ingredient->unit == 'kilograms' ? 'selected' : '' }}>Kilograms</option>
                    <option value="liters" {{ $ingredient->unit == 'liters' ? 'selected' : '' }}>Liters</option>
                    <option value="milliliters" {{ $ingredient->unit == 'milliliters' ? 'selected' : '' }}>Milliliters</option>
                    <option value="pieces" {{ $ingredient->unit == 'pieces' ? 'selected' : '' }}>Pieces</option>
                    <option value="cups" {{ $ingredient->unit == 'cups' ? 'selected' : '' }}>Cups</option>
                </select>
                @error('unit')
                <div class="error">
                    <p style="color: red">{{ $message }}</p>
                </div>
            @enderror
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{  route('ingredients.index') }}" class="btn btn-danger">Back</a>
        </form>
    </div>
@endsection
