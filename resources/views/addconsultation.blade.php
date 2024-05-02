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
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="desc" class="col-md-4 col-form-label text-md-end">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="desc" type="text" class="form-control" name="desc" value="{{ old('desc') }}" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="user_id" class="col-md-4 col-form-label text-md-end">{{ __('User ID') }}</label>

                            <div class="col-md-6">
                                <input id="user_id" type="number" class="form-control" name="user_id" required autofocus>
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
                                <input id="consult_datetime" type="datetime-local" class="form-control" name="consult_datetime" required autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="consult_datetime" class="col-md-4 col-form-label text-md-end">{{ __('End Date Time') }}</label>

                            <div class="col-md-6">
                                <input id="end_consult_datetime" type="datetime-local" class="form-control" name="end_consult_datetime" required autofocus>
                            </div>
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
                                <input id="status" type="hidden" class="form-control" name="status" value="unpaid">
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