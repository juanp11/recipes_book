@extends('layouts.landing')

@section('title', 'Recipes Book')
@section('content')
    <div class="container text-center">
        <h1 class="mt-4">Ingredients Page</h1>
    </div>
    <div class="container text-center mt-5">
        <p>This is the Ingredients index page.</p>
    </div>
    <div class="container">
        <a href="{{ route('ingredients.add') }}" class="btn btn-primary mt-3">Add New Ingredient</a>
    </div>
    <div class="container">
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
                    <th scope="col">Name</th>
                    <th scope="col">Cost</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($ingredients as $ingredient)
                    <tr>
                        <td>{{ $ingredient->name }}</td>
                        <td>{{ $ingredient->cost }}</td>
                        <td>
                            <a href="{{ route('ingredients.edit', $ingredient->id) }}"
                                class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('ingredients.delete', $ingredient->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this ingredient?')">Delete</button>
                            </form>
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
