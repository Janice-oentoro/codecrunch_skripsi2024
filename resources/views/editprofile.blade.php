@php
    use App\Http\Controllers\AuthController;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Session;
@endphp
<x-layout>
    @php
        $user = Auth::user();
    @endphp
    @auth

    @php
        $avatar= AuthController::imageAdapter(Auth::user()->avatar);
    @endphp

    <div class="mt-3">     
    @if (Session::has('success'))
        <div class="alert alert-success d-block mx-5" role="alert">
            {{ nl2br(Session::get('success')) }}
        </div>
    @endif

    @if(Auth::check() && Auth::user()->role == "consultant")
    <div class="text-end me-5">
        <button class="btn btn-primary" onclick=window.location="{{ url('/editskill') }}">Edit Skill</button>
    </div>
    @endif

        <div class="container mt-4 py-5 editprofcont">
            <div class="container d-block align-items-center justify-content-center" style="width:200px; height:150px;">
                @if (Auth::user()->avatar != null)
                <img src="{{ asset($avatar) }}" width="150px" height="150px"
                    class="rounded-circle justify-content-center align-items-center"
                    style="height:150px; width:150px;" alt="..."/>
                @else
                <img src="{{ asset('/storage/images/def-icon.png') }}" width="150px" height="150px"
                    class="justify-content-center align-items-center"
                    style="height:150px; width:150px;" alt="..."/>
                @endif
            </div>

            <br>

    <div class="container d-block align-items-center justify-content-center" style="width:65%;">
            <form action="{{ route('edit-profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="row mb-3 g-0">                        
                        <label class="form-label" for="name">Name</label>
                            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" name="name" />
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="row mb-3 g-0">                        
                        <label class="form-label" for="email">Email</label>
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}" name="email" />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="row mb-3 g-0">                        
                        <label class="form-label" for="phone">Phone</label>
                        <input type="text" id="phone" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}" name="phone" />
                        @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    @if(Auth::check() && Auth::user()->role == "consultant")
                    <div class="row mb-3 g-0">                        
                        <label class="form-label" for="price">Price</label>
                        <input type="number" id="price" class="form-control @error('price') is-invalid @enderror" value="{{ $user->price }}" name="price" />
                        @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    @endif

                    <div class="row mb-3 g-0">
                        <label for="image">Profile Picture</label>
                        <input type="file" class="form-control" name="avatar" id="avatar" value="{{$user->avatar}}">
                    </div>
                    <br>
                    <div class="text-end">
                        <button class="btn btn-warning">Submit</button>
                    </div>

            </form>
        </div>
        </div>
        </div>
    @else
            <p>Login first</p>
    @endif
</div>
</x-layout>