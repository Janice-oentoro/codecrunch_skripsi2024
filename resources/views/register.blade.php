<x-layout>
    <div class="register-body">
        <div class="register-container">
            <div class="register-image-container">
                <img src="{{ asset('storage/images/signup_illus 1.png') }}" alt="Placeholder Image">
            </div>
            <div class="register-form-container">
            <h3 class="row mb-3 justify-content-center"
            style="font-weight: bold; color: white;">REGISTER</h3>
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div>
                        <input id="name" type="text" placeholder="Name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div>
                        <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
                    </div>
                    <div>
                        <input id="phone" type="text" placeholder="Phone Number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div>
                        <select class="form-select" id="role" name="role" required focus>
                            <option value="" disabled selected>Role</option>
                            <option value="user">User</option>
                            <option value="consultant">Consultant</option>
                        </select>
                    </div>
                    <div class="register-button">
                        <button type="submit" class="form-control">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-layout>
