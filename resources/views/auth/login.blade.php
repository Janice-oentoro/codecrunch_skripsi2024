<x-layout>
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

<div class="login-body">
    <div class="login-container">
        <div class="login-form">
            <h2 style="font-weight: bold; color: white;">LOGIN</h2>
            <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <input id="email" type="email" placeholder="Email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div>
                <button type="submit">
                    {{ __('Login') }}
                </button>
            </div>
            <div class="mt-2">
                @if (Route::has('password.request'))
                    <a class="btn btn-link" href="{{ route('password.request') }}" style="color:white;">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
            </div>
            </form>
        </div>
        <div class="illustration">
            <img src="{{ asset('storage/images/Login 1.png') }}" alt="Illustration">
          </div>
    </div>
</div>
</x-layout>
