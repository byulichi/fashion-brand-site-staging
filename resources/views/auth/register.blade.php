<x-guest-layout>
    <!-- Header -->
    @include('layouts.navigation')
    <div class="container d-flex align-items-center justify-content-center vh-100">
        <div class="row w-100">

            <!-- Registration Form -->
            <div class="col-md-6 mx-auto">
                <h2 class="text-start">Create Account</h2>
                <p class="text-muted text-start">Create your ○○ Online account to start shopping and get more
                    surprise!</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="first_name" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="last_name" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" required>
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
