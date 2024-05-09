@php
    use App\Http\Controllers\AuthController;
    use Illuminate\Support\Str;
@endphp
<x-layout>
    @php
        $user = Auth::user();
    @endphp
    @auth
        <div class="test">
            <a>Edit Profile Page</a>
        </div>

            <div class="editprof1">
            <div class="editprof3">
                <p>Profile Settings</p>
            </div>
            @php
                $avatar= AuthController::imageAdapter(Auth::user()->avatar);
            @endphp

            @if (Auth::user()->avatar != null)
            <img class="rounded-circle" alt="avatar" height="25%" width="25%" src="{{ asset($avatar) }}"/>
            @else
            <img class="rounded-circle" alt="avatar" height="25%" width="25%" src="{{ asset('/storage/images/def-icon.png') }}"/>
            @endif

            <br>

            @if(Auth::check() && Auth::user()->role == "consultant")
                <button class="btn btn-primary" onclick=window.location="{{ url('/editskill') }}">Edit Skill</button>
            @endif
            <form action="{{ route('edit-profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="editprof2">
                    <div class="form-outline">                        
                        <label class="form-label" for="form12">Name</label>
                        <input type="text" id="form12" class="form-control" value="{{ $user->name }}" name="name" />
                    </div>

                    <div class="form-outline">                        
                        <label class="form-label" for="form12">Email</label>
                        <input type="email" id="form12" class="form-control" value="{{ $user->email }}" name="email" />
                    </div>

                    <div class="form-outline">                        
                        <label class="form-label" for="form12">Phone</label>
                        <input type="text" id="form12" class="form-control" value="{{ $user->phone }}" name="phone" />
                    </div>

                    @if(Auth::check() && Auth::user()->role == "consultant")
                    <div class="form-outline">                        
                        <label class="form-label" for="form12">Price</label>
                        <input type="number" id="form12" class="form-control" value="{{ $user->price }}" name="price" />
                    </div>
                    @endif

                    <div class="form-group-editprof">
                        <label for="image">Profile Picture</label>
                        <input type="file" class="form-control" name="avatar" id="avatar" value="{{$user->avatar}}">
                    </div>
                    <br>
                    <button class="btn btn-warning">Submit</button>
                </div>

            </form>
        </div>

        </div>
    @else
            <p>Login first</p>
    @endif
</x-layout>