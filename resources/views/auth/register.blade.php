<div class="modal fade" id="registerModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Register</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="registerForm" method="POST" action="{{ route('register') }}" class="d-flex flex-column">
                    @csrf
                    <div class="mb-2">
                        <label for="name">Name:</label>
                        <input class="form-control" type="text" id="name" name="name" required>
                    </div>
                    <div class="mb-2">
                        <label for="email">Email:</label>
                        <input class="form-control" type="email" id="email" name="email" required>
                    </div>
                    <div class="mb-2">
                        <label for="password">Password:</label>
                        <input class="form-control" type="password" id="password" name="password" required>
                    </div>
                    <div class="mb-2">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input class="form-control" type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <button class="btn btn-success w-100" type="submit">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>