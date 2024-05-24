@php
    use App\Http\Controllers\AuthController;
    use Illuminate\Support\Str;
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
            @if(Auth::check() && Auth::user()->role == "consultant")
            <div class="text-end me-5">
                <button class="btn btn-primary" onclick=window.location="{{ url('/editskill') }}">Edit Skill</button>
            </div>
            @endif

        <div class="container mt-4 py-5 editprofcont">
            <div class="container d-block align-items-center justify-content-center" style="width:200px; height:150px;">
                @if (Auth::user()->avatar != null)
                <img src="{{ asset($avatar) }}" width="150px" height="150px" style="clip-path: circle();" 
                    class="img-fluid rounded-circle d-flex justify-content-center align-items-center"
                    style="height:150px; width:150px;" alt="..."/>
                @else
                <img src="{{ asset('/storage/images/def-icon.png') }}" width="150px" height="150px" style="clip-path: circle();" 
                    class="img-fluid rounded-circle d-flex justify-content-center align-items-center"
                    style="height:150px; width:150px;" alt="..."/>
                @endif
            </div>

            <br>

    <div class="container d-block align-items-center justify-content-center" style="width:65%;">
            <form action="{{ route('edit-profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="row mb-3 g-0">                        
                        <label class="form-label" for="form12">Name</label>
                            <input type="text" id="form12" class="form-control" value="{{ $user->name }}" name="name" />
                    </div>

                    <div class="row mb-3 g-0">                        
                        <label class="form-label" for="form12">Email</label>
                        <input type="email" id="form12" class="form-control" value="{{ $user->email }}" name="email" />
                    </div>

                    <div class="row mb-3 g-0">                        
                        <label class="form-label" for="form12">Phone</label>
                        <input type="text" id="form12" class="form-control" value="{{ $user->phone }}" name="phone" />
                    </div>

                    @if(Auth::check() && Auth::user()->role == "consultant")
                    <div class="row mb-3 g-0">                        
                        <label class="form-label" for="form12">Price</label>
                        <input type="number" id="form12" class="form-control" value="{{ $user->price }}" name="price" />
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