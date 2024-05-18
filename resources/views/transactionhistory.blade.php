<x-layout>
<!-- USER VIEW -->
@if(Auth::user()->role == "user")
    @if($transCountU > 0)
    <!-- Button trigger modal Prog -->
    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#refund">Refund</a>
                                
    <!-- Modal Prog-->
    <div class="modal fade" id="refund" tabindex="-1" aria-labelledby="refund" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="refund">Refund</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                    <div class="modal-body">
                    <form action="{{ route('add-refund') }}" method="POST" enctype="multipart/form-data" class="modal-form">
                    @csrf
                        <div class="form-outline text-start">                        
                            <label class="form-label" for="form12">Transaction ID</label>
                            <input type="number" class="form-control" value="{{ old('transaction_id') }}" name="transaction_id" />
                        </div>

                        <div class="form-outline text-start">                        
                            <label class="form-label" for="form12">Bank Account Number</label>
                            <input type="text" class="form-control" value="{{ old('bank_acc') }}" name="bank_acc" />
                        </div>

                        <div class="form-outline text-start">                        
                            <label class="form-label" for="form12">Amount</label>
                            <input type="number" class="form-control" value="{{ old('amount') }}" name="amount" />
                        </div>

                            <input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="user_id" />
                            <input type="hidden" class="form-control" value="refund" name="type" />
                            <input type="hidden" class="form-control" value="pending" name="status" />

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    
                    </form>
            </div>

            </div>
        </div>
    </div>

    <h2>Transaction History Page</h2>
    <h4>Total Transactions: {{ $totalTrans }}</h4>
    <br>
    <h5>Total Transfers: {{ $transCountU }}</h5>
    @foreach($transU as $t)
        <div class="card" style="width: 23rem;">
            <div class="card-body">
                <h5 class="card-title">Transaction ID: {{$t->id}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$t->title}}</h6>
                <p class="card-text">Rp {{$t->amount}}</p>
                <p class="card-text">Transaction Datetime: {{$t->transaction_datetime}}</p>
            </div>
        </div>
    @endforeach
    <br>
    @if($transURC > 0)
        <h5>Total Successful Refunds: {{ $transURC }}</h5>
        @foreach($transUR as $t)
            <div class="card" style="width: 23rem;">
                <div class="card-body">
                    <h5 class="card-title">Refund ID: {{$t->id}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Refunded Transaction ID: {{$t->transaction_id}}</h6>
                    <p class="card-text">{{$t->type}}</p>
                    <p class="card-text">Rp {{$t->amount}}</p>
                    <p class="card-text">Transaction Datetime: {{$t->ref_datetime}}</p>
                    <p class="card-text">Status: {{$t->status}}</p>
                </div>
            </div>
        @endforeach
    @endif
    
    @else
    <p>No Transactions</p>
    @endif

<!-- CONSULTANT VIEW -->
@elseif(Auth::user()->role == "consultant")
    @if($transCountC > 0)
    <!-- Button trigger modal Prog -->
    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#withdraw">Withdraw</a>
                                
    <!-- Modal Prog-->
    <div class="modal fade" id="withdraw" tabindex="-1" aria-labelledby="withdraw" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="withdraw">Withdraw</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
                    <div class="modal-body">
                    <form action="{{ route('add-withdraw') }}" method="POST" enctype="multipart/form-data" class="modal-form">
                    @csrf
                        <div class="form-outline text-start">                        
                            <label class="form-label" for="form12">Bank Account Number</label>
                            <input type="text" class="form-control" value="{{ old('bank_acc') }}" name="bank_acc" />
                        </div>
                        
                        <div class="form-outline text-start">                        
                            <label class="form-label" for="form12">Amount</label>
                            <input type="number" class="form-control" value="{{ old('amount') }}" name="amount" />
                        </div>
                            <input type="hidden" class="form-control" value="{{Auth::user()->id}}" name="user_id" />
                            <input type="hidden" class="form-control" value="withdraw" name="type" />
                            <input type="hidden" class="form-control" value="pending" name="status" />

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    
                    </form>
            </div>

            </div>
        </div>
    </div>

    <h2>Transaction History Page</h2>
    <h4>Total Transactions: {{ $totalTrans }}</h4>
    <h5>Wallet: Rp {{ $transWallet }}</h5>
    <br>
    @foreach($transC as $t)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Transaction ID: {{$t->id}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$t->title}}</h6>
                <p class="card-text">Rp {{$t->amount}}</p>
                <p class="card-text">Transaction Datetime: {{$t->transaction_datetime}}</p>
            </div>
        </div>
    @endforeach
    <br>

    @if($transCountW > 0)
    <h5>Total Withdraws: {{ $transCountW }}</h5>
    @foreach($transW as $t)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Withdraw ID: {{$t->id}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$t->type}}</h6>
                <p class="card-text">Rp {{$t->amount}}</p>
                <p class="card-text">Transaction Datetime: {{$t->created_at}}</p>
                <p class="card-text">Status: {{$t->status}}</p>
            </div>
        </div>
    @endforeach
    @endif
    <br>

    @if($transCountRC > 0)
    <h5>Total Refunds: {{ $transCountRC }}</h5>
    @foreach($transRC as $t)
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Refund ID: {{$t->id}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$t->type}}</h6>
                <p class="card-text">Rp {{$t->amount}}</p>
                <p class="card-text">Transaction Datetime: {{$t->created_at}}</p>
                <p class="card-text">Status: {{$t->status}}</p>
            </div>
        </div>
    @endforeach
    @endif

    @else
    <p>No Transactions</p>
    @endif 
@else
    <p> Login First</p>
@endif
</x-layout>