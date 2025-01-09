<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-body p-4">
                <header class="mb-4 border-bottom pb-3">
                    <h2 class="fs-4 fw-semibold text-primary mb-2">
                        {{ __('Profile Information') }}
                    </h2>
                    <p class="text-muted small">
                        {{ __("Update your account's profile information and email address.") }}
                    </p>
                </header>

                <form method="post" action="{{ route('profile.update') }}" class="needs-validation">
                    @csrf
                    @method('patch')

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $user->name) }}" required
                                    autofocus>
                                <label for="name">{{ __('Name') }}</label>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                <label for="email">{{ __('Email') }}</label>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-floating mb-3">
                                <input type="phone" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" value="{{ old('phone', $user->phone) }}">
                                <label for="phone">{{ __('phone') }}</label>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-save me-2"></i>{{ __('Save Changes') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm mt-4">
            <div class="card-body p-4">
                <header class="mb-4 border-bottom pb-3">
                    <h2 class="fs-4 fw-semibold text-primary mb-2">
                        {{ __('Security Settings') }}
                    </h2>
                    <p class="text-muted small">
                        {{ __('Ensure your account is using a long, random password to stay secure.') }}
                    </p>
                </header>

                <form method="post" action="{{ route('password.update') }}" class="needs-validation">
                    @csrf
                    @method('put')

                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="current_password"
                                    name="current_password" required>
                                <label for="current_password">{{ __('Current Password') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password" name="password" required>
                                <label for="password">{{ __('New Password') }}</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="password_confirmation"
                                    name="password_confirmation" required>
                                <label for="password_confirmation">{{ __('Confirm Password') }}</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fas fa-key me-2"></i>{{ __('Update Password') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card shadow-sm mt-4 border-danger">
            <div class="card-body p-4">
                <header class="mb-4 border-bottom pb-3">
                    <h2 class="fs-4 fw-semibold text-danger mb-2">
                        {{ __('Delete Account') }}
                    </h2>
                    <p class="text-muted small">
                        {{ __('Once your account is deleted, all of its resources and data will be permanently deleted.') }}
                    </p>
                </header>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-danger px-4" data-bs-toggle="modal" data-bs-target="#deleteAccountModal">
                        <i class="fas fa-trash-alt me-2"></i>{{ __('Delete Account') }}
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border: none;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .form-floating input {
            border-radius: 7px;
        }

        .btn-primary {
            background-color: var(--accent-color);
            border: none;
            border-radius: 7px;
            padding: 10px 20px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #8b68d8;
            /* Darker shade of accent color */
            transform: translateY(-2px);
        }

        .btn-danger {
            border-radius: 7px;
            padding: 10px 20px;
        }

        .text-primary {
            /* color: var(--accent-color) !important; */
            color: var(--primary-color) !important;
        }

        .border-bottom {
            border-color: #e9ecef !important;
        }
    </style>
</x-app-layout>
