<x-layout>
<!-- USER VIEW -->
@if(Auth::user()->role == "user")
    @if($transCountU > 0)
    <a href="/refund" class="btn btn-primary" name="id">Refund</a>
    <h4>Transaction History Page</h4>
    <h5>Total Transactions: {{ $transCountU }}</h5>

    @foreach($transU as $t)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{$t->title}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Transaction ID: {{$t->id}}</h6>
                <p class="card-text">Price: {{$t->price}}</p>
                <p class="card-text">Transaction Datetime: {{$t->transaction_datetime}}</p>
            </div>
        </div>
    @endforeach
    
    @else
    <p>No Transactions</p>
    @endif

<!-- CONSULTANT VIEW -->
@elseif(Auth::user()->role == "consultant")
    @if($transCountC > 0)
    <a href="/withdraw" class="btn btn-primary" name="id">Withdraw</a>
    <h4>Transaction History Page</h4>
    <h5>Total Transactions: {{ $transCountC }}</h5>
    @foreach($transC as $t)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">{{$t->title}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">Transaction ID: #{{$t->id}}</h6>
                <p class="card-text">Price: {{$t->price}}</p>
                <p class="card-text">Transaction Datetime: {{$t->transaction_datetime}}</p>
            </div>
        </div>
    @endforeach

    @else
    <p>No Transactions</p>
    @endif 
@else
    <p> Login First</p>
@endif
</x-layout>