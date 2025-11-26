@extends('layouts.landing')

@section('title', 'Recipes Book')
@section('content')
    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-lg border-0 rounded-lg">
                    <div class="card-header bg-primary text-white">
                        <h3 class="mb-0">{{ $recipe->title }}</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="mb-4">
                            <h5 class="text-primary mb-3">Instructions</h5>
                            <p class="card-text text-muted" style="text-align: justify; line-height: 1.8;">
                                {{ $recipe->instructions }}
                            </p>
                        </div>
                        
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded">
                                    <h6 class="text-secondary mb-2">Preparation Time</h6>
                                    <p class="mb-0 fw-bold">{{ $recipe->preparation_time }} minutes</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded">
                                    <h6 class="text-secondary mb-2">Servings</h6>
                                    <p class="mb-0 fw-bold">{{ $recipe->servings }} people</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Ingredients</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($ingredients as $ingredient)
                            <li class="list-group-item d-flex align-items-center">
                                <span>{{ $ingredient['name'] }} - {{ $ingredient['quantity'] }} {{ $ingredient['unit'] }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <div class="card-header bg-warning text-white mt-4">
                        <h5 class="mb-0">Costs</h5>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex align-items-center">
                            <span>Total Cost Recipe: ${{ number_format($totalReceipeCost, 2) }}</span>
                        </li>
                    </ul>
                    <div class="card-footer bg-white border-0 p-4">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-between">
                            <a href="{{ route('recipes.index') }}" class="btn btn-outline-danger">
                                Back to Recipes
                            </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
