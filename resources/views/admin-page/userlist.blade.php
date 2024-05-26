<x-layout>
<div class="container mt-3">
    <h3>User List Page</h3>
    <div class="col-md-12" id="admin-content">
            <div class="item-table">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">User ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Suspend</th>
                            <th colspan="2" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $u)
                            <tr>
                                <th scope="row">{{ $u->id }}</th>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                @if($u->suspend == false)
                                <td>False</td>
                                @else
                                <td>True</td>
                                @endif
                                <td>
                                    @if($u->suspend == false)
                                    <form action="{{ route('suspend-user') }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="id" value="{{$u->id}}">
                                        <button type="submit" class="btn btn-danger">Suspend</button>
                                    </form>
                                    @else
                                    <form action="{{ route('unsuspend-user') }}" method="POST">
                                        @csrf
                                        @method('put')
                                        <input type="hidden" name="id" value="{{$u->id}}">
                                        <button type="submit" class="btn btn-success">Unsuspend</button>
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
            {{ $users->links() }}
        </div>
</div>
</x-layout>