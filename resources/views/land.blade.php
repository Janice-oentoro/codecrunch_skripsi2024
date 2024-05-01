<x-layout>
    @foreach($users as $u)
    <div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
        <img src="..." class="img-fluid rounded-start" alt="...">
        </div>
        <div class="col-md-8">
        <div class="card-body">
            <h5 class="card-title">{{$u->name}}</h5>
            <p class="card-text">Rp {{$u->price}}</p>
            <a href="#" class="btn btn-warning">Detail</a>
        </div>
        </div>
    </div>
    </div>
    @endforeach
</x-layout>