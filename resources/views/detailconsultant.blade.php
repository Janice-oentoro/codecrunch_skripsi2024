<x-layout>
    <div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
        <img src="..." class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
        <div class="card-body">
            <h5 class="card-title">{{$u->name}}</h5>
            <p class="card-text">Rp {{$u->price}}</p>
            @if(Auth::check())
            <a href="#Chat" class="btn btn-primary"></a>
            @else
            <p></p>
            @endif
        </div>
        </div>
    </div>
    </div>
</x-layout>