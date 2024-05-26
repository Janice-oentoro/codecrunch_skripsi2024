<x-layout>
<!-- USER VIEW -->
@if(Auth::user()->role == "user")
    @if($transCountU > 0)    
    <div class="mt-3 mx-5">
    <div class="row g-0">
    <!-- Button trigger modal Prog -->
    <div class="col text-start"><h2>Transaction History Page</h2></div>
    <div class="col text-end">
    <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#refund">Refund</a>
    </div>
                                
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
    </div>
    
    <!-- TRANSFERS -->
    <h4>Total Transactions: {{ $totalTrans }}</h4>
    <h5 class="mb-3">Total Transfers: {{ $transCountU }}</h5>
    <div class="row g-0">
        @foreach($transU as $t)
        <div class="col-md-3 mb-3">
            <div class="card d-block" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Transaction ID: {{$t->id}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$t->title}}</h6>
                    <p class="card-text">Rp {{$t->amount}}</p>
                    <p class="card-text">{{$t->transaction_datetime}}</p>
                </div>
            </div>
        </div>
    @endforeach
    </div>
    <div class="mt-3">
        <div class="pagination">
            {{ $transU->links() }}
        </div>
    </div>
    <!-- TRANSFERS -->

    <br>
    <!-- REFUNDS -->
    @if($transURC > 0)
        <h5 class="mb-3">Total Refunds: {{ $transURC }}</h5>
        <div class="row g-0">
        @foreach($transUR as $t)
        <div class="col-md-3 mb-3">
            <div class="card d-block" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Refund ID: {{$t->id}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">Refunded Transaction ID: {{$t->transaction_id}}</h6>
                    <p class="card-text">{{$t->type}}</p>
                    <p class="card-text">Rp {{$t->amount}}</p>
                    <p class="card-text">{{$t->ref_datetime}}</p>
                    @if($t->status == "pending")
                    <p class="card-text rounded-pill text-white" 
                    style="background-color:peru; width:150px; text-align:center;">{{$t->status}}</p>
                    @elseif($t->status == "success")
                    <p class="card-text rounded-pill text-white" 
                    style="background-color:green; width:150px; text-align:center;">{{$t->status}}</p>
                    @else
                    <p class="card-text rounded-pill text-white" 
                    style="background-color:firebrick; width:150px; text-align:center;">{{$t->status}}</p>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
        </div>
    @endif
    </div>
    <!-- REFUNDS -->
    
    @else
    <div class="mt-3 ms-5">
    <p>No Transactions</p>
    </div>
    @endif

<!-- CONSULTANT VIEW -->
@elseif(Auth::user()->role == "consultant")
<!-- TRANSACTIONS -->
    @if($transCountC > 0)
    <div class="mt-3 mx-5">
    <div class="row g-0">
        <div class="col text-start"><h2>Transaction History Page</h2></div>
        <div class="col text-end">
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
    </div>
</div>
    <h4>Total Transactions: {{ $totalTrans }}</h4>
    <h5 class="mb-3">Wallet: Rp {{ $transWallet }}</h5>
    <div class="row g-0">
        @foreach($transC as $t)
        <div class="col-md-3 mb-3">
            <div class="card d-block" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Transaction ID: {{$t->id}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$t->title}}</h6>
                    <p class="card-text">Rp {{$t->amount}}</p>
                    <p class="card-text">{{$t->transaction_datetime}}</p>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="mt-3">
        <div class="pagination">
            {{ $transC->links() }}
        </div>
    </div>
<!-- TRANSACTIONS -->
    <br>

<!-- WITHDRAWS -->
    @if($transCountW > 0)
    <h5>Total Withdraws: {{ $transCountW }}</h5>
    <div class="row g-0">
    @foreach($transW as $t)
    <div class="col-md-3 mb-3">
        <div class="card d-block" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Withdraw ID: {{$t->id}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$t->type}}</h6>
                <p class="card-text">Rp {{$t->amount}}</p>
                <p class="card-text">{{$t->created_at}}</p>
                @if($t->status == "pending")
                <p class="card-text rounded-pill text-white" 
                style="background-color:peru; width:150px; text-align:center;">{{$t->status}}</p>
                @elseif($t->status == "success")
                <p class="card-text rounded-pill text-white" 
                style="background-color:green; width:150px; text-align:center;">{{$t->status}}</p>
                @else
                <p class="card-text rounded-pill text-white" 
                style="background-color:firebrick; width:150px; text-align:center;">{{$t->status}}</p>
                @endif
            </div>
        </div>
    </div>
    @endforeach
    </div>
    <div class="mt-3">
        <div class="pagination">
            {{ $transW->links() }}
        </div>
    </div>
    @endif
<!-- WITHDRAWS -->
    <br>

<!-- REFUNDS FROM USER -->
    @if($transCountRC > 0)
    <h5>Total Refunds: {{ $transCountRC }}</h5>
    <div class="row g-0">
    @foreach($transRC as $t)
    <div class="col-md-3 mb-3">
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title">Refund ID: {{$t->id}}</h5>
                <h6 class="card-subtitle mb-2 text-muted">{{$t->type}}</h6>
                <p class="card-text">Rp {{$t->amount}}</p>
                <p class="card-text">{{$t->created_at}}</p>
                @if($t->status == "pending")
                <p class="card-text rounded-pill text-white" 
                style="background-color:peru; width:150px; text-align:center;">{{$t->status}}</p>
                @elseif($t->status == "success")
                <p class="card-text rounded-pill text-white" 
                style="background-color:green; width:150px; text-align:center;">{{$t->status}}</p>
                @else
                <p class="card-text rounded-pill text-white" 
                style="background-color:firebrick; width:150px; text-align:center;">{{$t->status}}</p>
                @endif
            </div>
        </div>
    </div>
    @endforeach
    </div>
    <div class="mt-3">
        <div class="pagination">
            {{ $transRC->links() }}
        </div>
    </div>
    @endif
<!-- REFUNDS FROM USER -->

    @else
        <div class="mt-3 ms-5">
        <p>No Transactions</p>  
        </div>
    @endif 
    </div>
@else
    <p> Login First</p>
@endif
</x-layout>