<x-layout>
    @php
        $user = Auth::user()->role == "consultant";
    @endphp
    
    @auth
    <div class="test1">
        <a>Add Consultation Page Consultant</a>
    </div>

    <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Consultation') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('add-con') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="title" class="col-md-4 col-form-label text-md-end">{{ __('Title') }}</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="desc" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="desc" type="text" class="form-control @error('desc') is-invalid @enderror" name="desc" value="{{ old('desc') }}" autofocus>
                                @error('desc')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('User Full Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="string" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Type') }}</label>
                                <div class="col-md-6">
                                    <select class="form-select" id="type" name="type" required focus>
                                        <option value="chat">Chat</option>        
                                        <option value="video conference">Video Conference</option>             
                                    </select>
                                </div>
                        </div>

                        <div class="row mb-3">
                            <label for="consult_datetime" class="col-md-4 col-form-label text-md-end">{{ __('Start Date Time') }}</label>

                            <div class="col-md-6">
                                <input id="consult_datetime" type="datetime-local" class="form-control @error('consult_datetime') is-invalid @enderror" name="consult_datetime" required autofocus>
                            </div>
                            @error('consult_datetime')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="row mb-3">
                            <label for="consult_datetime" class="col-md-4 col-form-label text-md-end">{{ __('End Date Time') }}</label>

                            <div class="col-md-6">
                                <input id="end_consult_datetime" type="datetime-local" class="form-control @error('end_consult_datetime') is-invalid @enderror" name="end_consult_datetime" required autofocus>
                            </div>
                            @error('end_consult_datetime')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <!-- Link -->
                        <div class="row mb-3">
                            <label for="link" class="col-md-4 col-form-label text-md-end">{{ __('Link') }}</label>

                            <div class="col-md-6">
                                <input id="link" type="text" class="form-control" name="link" value="{{ old('link') }}" autofocus>
                            </div>
                        </div>

                        <!-- Status -->
                        <div class="row mb-3">
                            <label for="link" class="display:hidden"></label>
                           
                            <div class="col-md-6">
                                <input id="status" type="hidden" class="form-control" name="status" value="pending">
                            </div>
                        </div>
                        
                        <input id="consultant_id" type="hidden" class="form-control" name="consultant_id" value="{{Auth::user()->id}}">

                        <div class="row mb-0 mt-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add Consultation') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    @else
        <p>Login first</p>
    @endif
</x-layout>