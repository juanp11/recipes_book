@extends('layouts.landing')

@section('title', 'Recipes Book')
@section('content')
    <div class="container text-center">
        <h1 class="mt-4">Add Ingredients</h1>
    </div>
    <div class="container">
        <form method="POST" action="{{ route('ingredients.save') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name Ingredient</label>
                <input type="text" class="form-control" id="name" name="name">
                @error('name')
                <div class="error">
                    <p style="color: red">{{ $message }}</p>
                </div>
            @enderror
            </div>
            <div class="mb-3">
                <label for="cost" class="form-label">Cost</label>
                <input type="number" class="form-control" id="cost" name="cost" step="0.01">
                @error('cost')
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
