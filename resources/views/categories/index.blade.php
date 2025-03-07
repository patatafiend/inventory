@extends('layouts.app')

@section('content')



<div class="container">
    <h2 class="mb-4">Category Management</h2>

    <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
        Add Category
    </button>

    @include('categories.category-form')
    @include('categories.category-edit-modal')

    <ul class="category-list">
        @foreach ($categories as $category)
            @include('categories.category-list-item', ['category' => $category, 'level' => 0])
        @endforeach
    </ul>

    
</div>



@endsection

@section('scripts')
    <meta name="store-categories-route" content="{{ route('categories.store') }}">
    <meta name="delete-categories-route" content="{{ url('/categories') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection