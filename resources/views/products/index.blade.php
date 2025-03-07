@extends('layouts.app')

@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    @vite('resources/js/ajax/product.js')
</head>
<body class="container" style="background-color: rgba(34, 139, 34, 0.5)">
    <div class="container">
        <h2 class="text-center text-black text-4xl font-bold p-4">Products</h2>

        @include('products.partials.add-product-modal')

        <table class="table mt-3 rounded-table text-center" id="product-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Unit</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody id="product-list" class="rounded-table">
                @foreach ($products as $product)
                    <tr id="product-{{ $product->id }}">
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->unit->name }}</td>
                        <td>
                            <button class="btn btn-info view-product" data-id="{{ $product->id }}">View</button>
                            <button class="btn btn-warning edit-product" 
                                data-id="{{ $product->id }}" 
                                data-name="{{ $product->name }}" 
                                data-description="{{ $product->description }}" 
                                data-quantity="{{ $product->quantity }}" 
                                data-price="{{ $product->price }}"
                                data-category_id="{{ $product->category_id }}"
                                data-unit_id="{{ $product->unit_id }}">Edit</button>
                            <button class="btn btn-danger delete-product" data-id="{{ $product->id }}">Delete</button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

@include('products.partials.show-product-modal')
@include('products.partials.edit-product-modal')
@endsection

@section('scripts')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="store-product-route" content="{{ route('products.store') }}">
    <meta name="delete-product-route" content="{{ url('/products') }}">
@endsection