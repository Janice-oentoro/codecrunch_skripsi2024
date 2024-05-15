<x-layout>
    <h4>Transaction History Page</h4>
    @foreach($trans as $t)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{$t->title}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Transaction ID: #{{$t->id}}</h6>
                <p class="card-text">Price: {{$t->price}}</p>
                <p class="card-text">Price: {{$t->transaction_datetime}}</p>
            </div>
        </div>
    @endforeach
</x-layout>