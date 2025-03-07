@include('layouts.app')
@include('auth.register')

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="col-md-4 p-4 bg-light rounded shadow fade-in">
        <form id="login-form" method="POST" action="{{ route('login') }}">
            @csrf
            <div class="text-center mb-3">
                <h2>Login</h2>
            </div>
            <div class="mb-2">
                <input type="hidden" name="function" value="login">
                <label>Email</label>
                <input class="form-control" type="email" name="email" id="email" placeholder="Email" required>
            </div>
            <div class="mb-2">
                <label>Password</label>
                <input class="form-control" type="password" name="password" id="password" placeholder="Password" required>
            </div>
            <div id="response"></div>
            <div class="mb-2">
                <input class="btn btn-success w-100" type="submit" value="Login">
            </div>
        </form>
        <div>
            <button class="btn btn-secondary w-100" data-bs-toggle="modal" data-bs-target="#registerModal">Register</button>
        </div>

        @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    </div>
</div>