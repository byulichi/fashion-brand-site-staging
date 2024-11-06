<x-guest-layout>
    <!-- Header -->
    @include('layouts.navigation')
    <div class="container d-flex align-items-center justify-content-center" style="height: 80vh">
        <div class="row w-100">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- Registration Form -->
            <div class="col-md-6 mx-auto">
                <h2 class="text-start">Create Account</h2>
                <p class="text-muted text-start">Create an online account to start shopping and get more
                    surprise!</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Username</label>
                        <input type="text" class="form-control" id="name" name="name" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Password Confirmation</label>
                        <input type="password" class="form-control" id="password_confirmation"
                            name="password_confirmation" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Create Account</button>
                </form>

                <div class="text-center mt-4">
                    <p>Already registered? <a href="{{ route('login') }}" class="text-decoration-underline">Login</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

</x-guest-layout>
