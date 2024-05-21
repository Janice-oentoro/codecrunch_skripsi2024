<x-layout>
<div class="container mt-5 ps-5 pe-5 justify-content-center">
        <div class="md-8">
            <div class="cont1 card p-3">
                <div class="card-body">

                    <h3 class="row mb-3 justify-content-center"
                    style="font-weight: bold; color: white;">REGISTER</h3>
                    
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-5">
                                <input id="name" type="text" placeholder="Name"
                                class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-5">
                                <input id="email" type="email" placeholder="Email"
                                class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-5">
                                <input id="password" type="password" placeholder="Password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-5">
                                <input id="password-confirm" type="password" placeholder="Confirm Password"
                                class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-5">
                                <input id="phone" type="text" placeholder="Phone Number"
                                class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center">
                             <div class="col-md-5">
                                    <select class="form-select" id="role" name="role" required focus>
                                        <option value="user">User</option>        
                                        <option value="consultant">Consultant</option>             
                                    </select>
                                </div>
                        </div>
                        
                        <div class="row mb-0 justify-content-center">
                            <div class="col-md-5">
                                <button type="submit" class="btn btn-primary" style="display: block;
                                width: 100%;">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</div>
</x-layout>
