<x-guest-layout>
    <!-- Header -->
    @include("layouts.navigation")
    <div class="login-container">
        <div class="login-form">
            <h2 class="mb-4">Welcome Back</h2>
            <p class="mb-4">Please enter your e-mail and password</p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    <a class="d-block mt-2" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                </div>

                <!-- Remember Me -->
                <div class="form-check mb-3">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                </div>

                <button type="submit" class="btn btn-primary w-100 mb-3">{{ __('Log in') }}</button>
                <div class="text-center">
                    <p>Don't have an account? <a href="{{ route('register') }}">{{ __('Create One') }}</a></p>
                    {{-- <p>OR</p>
                    <button type="button" class="btn btn-outline-secondary w-100">GUEST CHECKOUT</button>
                    <p class="mt-3"><small>Your personal details are protected.</small></p> --}}
                </div>
            </form>
        </div>
        <div class="login-image"></div>
    </div>
</x-guest-layout>
<style>
    .login-container {
        display: flex;
        min-height: 80vh;
    }
    .login-form {
        flex: 1;
        padding: 50px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .login-image {
        flex: 1;
        background-image: url('https://www.arianionline.my/assets/images/login-banner.jpg');
        background-size: cover;
        background-position: center;
    }
</style>
