@extends('layouts.landing')

@section('title', 'Recipes Book')
@section('content')
    <div class="container text-center">
        <h1 class="mt-4">Recipes</h1>
    </div>
    <div class="container">
        <a href="{{ route('recipes.add') }}" class="btn btn-success mt-3">Create Recipe</a>
    </div>
    <div class="container mt-3">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>
    <div class="container">
        <table class="table table-striped mt-3 text-center table-hover">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Total Cost</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($recipes as $recipe)
                    <tr>
                        <td>{{ Str::limit($recipe->title, 80) }}</td>
                        <td>${{ $recipe->total_cost }}</td>
                        <td>
                            <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-sm btn-primary">Show</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No ingredients found.</td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>
@endsection
