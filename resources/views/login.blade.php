<x-layout>
<div class="container mt-5 ps-5 pe-5 justify-content-center" style="width: 50%;">
        <div class="md-8">
            <div class="cont1 card py-5">
                <div class="card-body">
                    
                    <h3 class="row mb-3 justify-content-center"
                    style="font-weight: bold; color: white;">LOGIN</h3>
                    
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-4 justify-content-center">
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                name="email" value="{{ old('email') }}" placeholder="Email" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-2 justify-content-center">
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                name="password" placeholder="Password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4 justify-content-center">
                            <div class="col-md-6">
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}" style="color:white;">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>

                        <div class="row mb-0 justify-content-center">
                            <div class="col-md-6">
                                <button type="submit" class="btn btn-primary" style="display: block;
                                width: 100%;">
                                    {{ __('Login') }}
                                </button>
                            </div> 
                        </div>

                    </form>
                </div>
                
            </div>
        </div>

</div>

</x-layout>
