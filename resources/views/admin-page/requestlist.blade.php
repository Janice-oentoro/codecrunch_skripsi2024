<x-layout>
<div class="container mt-3">
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
                            <th scope="col" style="text-align:center">Status</th>
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
                                @if($r->status == "pending")
                                <td class="rounded-3 text-white" 
                                style="background-color:peru; width:100px; text-align: center; vertical-align: middle;">
                                {{$r->status}}</td>
                                @elseif($r->status == "success")
                                <td class="rounded-3 text-white" 
                                style="background-color:green; width:100px; text-align: center; vertical-align: middle;">
                                {{$r->status}}</td>
                                @else
                                <td class="rounded-3 text-white" 
                                style="background-color:firebrick; width:100px; text-align: center; vertical-align: middle;">
                                {{$r->status}}</td>
                                @endif
                                <td>
                                    @if($r->status == "pending")
                                    <form action="{{ route('accept-req') }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="id" value="{{$r->id}}">
                                        <button type="submit" class="btn btn-success"><i class="fa-solid fa-check"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form action="{{ route('reject-req') }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="id" value="{{$r->id}}">
                                        <button type="submit" class="btn btn-danger"><i class="fa-solid fa-xmark"></i></button>
                                    </form>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="pagination">
            {{ $reqs->links() }}
        </div>
</div>
</x-layout>