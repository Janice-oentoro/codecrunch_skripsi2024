<x-layout>
    @php
        $user = Auth::user()->role == "consultant";
    @endphp
    @auth
        <div class="test">
            <a>Edit Programming Language Consultant Page</a>
        </div>

        <div class="test">

            @if(Auth::check() && Auth::user()->role == "consultant")
            <form action="{{ route('edit-profile') }}" method="POST" enctype="multipart/form-data">
                @csrf
                    <div class="form-check">
                    
                        @foreach ($programmings as $p)
                        <input class="form-check-input" type="checkbox" value="{{$p->id}}" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{$p->prog_name}}
                        </label>
                        <br>
                        @endforeach
                    </div>

                    <br>
                    <button class="btn btn-warning">Submit</button>
                </div>

            </form>
            <div class="abc">Skill Form</div>
            @endif
        </div>
    @else
            <p>Login first</p>
    @endif
</x-layout>