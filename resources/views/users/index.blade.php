<!-- filepath: /c:/xampp/htdocs/inventory/resources/views/users/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Users</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                <tr  id="user-{{ $user->id }}">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#editUserModal" class="btn btn-sm btn-warning edit-user">Edit</button>
                        <button type="button" class="btn btn-sm btn-danger delete-user" data-id="{{$user->id}}">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

@include('users.user-edit-modal')

@endsection

@section('scripts')
    <meta name="store-users-route" content="{{ route('users.store') }}">
    <meta name="delete-users-route" content="{{ url('/users') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection