<x-layout>
    <h3>Request List</h3>
    <div class="col-md-12" id="admin-content">
            <div class="item-table">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Request ID</th>
                            <th scope="col">Transaction ID</th>
                            <th scope="col">User ID</th>
                            <th scope="col">Bank Acc</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Type</th>
                            <th scope="col">Status</th>
                            <th colspan="2" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reqs as $r)
                            <tr>
                                <th scope="row">{{ $r->id }}</th>
                                <td>{{ $r->transaction_id }}</td>
                                <td>{{ $r->user_id }}</td>
                                <td>{{ $r->bank_acc }}</td>
                                <td>{{ $r->amount }}</td>
                                <td>{{ $r->type}}</td>
                                <td>{{ $r->status }}</td>
                                <td>
                                    @if($r->status == "pending")
                                    <form action="{{ route('accept-req') }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="id" value="{{$r->id}}">
                                        <button type="submit" class="btn btn-success">Accept</button>
                                    </form>

                                    <form action="{{ route('reject-req') }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="id" value="{{$r->id}}">
                                        <button type="submit" class="btn btn-danger">Reject</button>
                                    </form>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

</x-layout>