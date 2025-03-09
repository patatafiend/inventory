@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Units</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @include('units.unit-add-modal')

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody id='unit-list'>
            @foreach ($units as $unit)
                <tr>
                    <td>{{ $unit->name }}</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-warning edit-unit">Edit</button>
                        <button type="button" class="btn btn-sm btn-danger delete-unit">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>


@include('units.unit-edit-modal')

@endsection

@section('scripts')
    <meta name="store-units-route" content="{{ route('units.store') }}">
    <meta name="delete-units-route" content="{{ url('/units') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection