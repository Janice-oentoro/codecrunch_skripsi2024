<x-layout>
    @php
        $user = Auth::user()->role == "consultant";
    @endphp
    @auth
        <div class="test">
            <a>Edit Programming Language Consultant Page</a>
        </div>

        <div class="test">
         <!-- Button trigger modal Prog -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addprogramming">
                Add Programming 
            </button>

         <!-- Modal Prog-->
            <div class="modal fade" id="addprogramming" tabindex="-1" aria-labelledby="addprogramming" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addprogramming">Add Programming Language</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('add-conprog') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                            <div class="test1-form">
                                <select class="form-select" aria-label="addProg" name="prog_id">
                                @foreach ($programmings as $p)
                                    <option value="{{$p->id}}">{{$p->prog_name}}</option>
                                @endforeach
                                </select>
                            </div>

                                <input type="hidden" name="consultant_id" value="{{ Auth::user()->id }}">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-warning">Submit</button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>

                </div>
            </div>
        </div>

        <br>

         <!-- Button trigger modal Topic-->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addtopic">
            Add Topic 
            </button>

         <!-- Modal Topic-->
            <div class="modal fade" id="addtopic" tabindex="-1" aria-labelledby="addtopic" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addtopic">Add Topic</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @if(Auth::check() && Auth::user()->role == "consultant")
                    <form action="{{ route('add-contopic') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                            <div class="test2-form">
                                <select class="form-select" aria-label="addTopic" name="topic_id">
                                @foreach ($topics as $t)
                                    <option value="{{$t->id}}">{{$t->topic_name}}</option>
                                @endforeach
                                </select>
                            </div>
                            <input type="hidden" name="consultant_id" value="{{ Auth::user()->id }}">
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-warning">Submit</button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>

                </div>
            </div>
            </div>

            <!-- Display -->
            <!-- Display Programmings -->
            <h5>Display Programming</h5>
            <div class="col-md-12" id="consultant-content">
            <div class="item-table">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Programming Language</th>
                            <th colspan="2" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($progcons as $progcon)
                            <tr>
                                <th scope="row">{{ $no }}</th>
                                <td>{{ $progcon->prog_name }}</td>
                                <td>
                                <form action="{{ route('delete-progcon') }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="progcon_id" value="{{ $progcon->id }}">
                                    <button class="btn btn-danger">Delete</button>
                                </form> 
                                </td>
                                @php
                                    $no++;
                                @endphp
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

            <br>

            <!-- Display Topics -->
            <h5>Display Topics</h5>
            <ol class="list-group list-group-flush list-group-numbered flex-fill">
            <div class="col-md-12" id="consultant-content">
            <div class="item-table">
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Topic Name</th>
                            <th colspan="2" scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $no1 = 1;
                        @endphp
                        @foreach ($topiccons as $topic)
                            <tr>
                                <th scope="row">{{ $no1 }}</th>
                                <td>{{ $topic->topic_name }}</td>
                                <td>
                                <form action="{{ route('delete-topiccon') }}" method="POST">
                                    @csrf
                                    @method('delete')
                                    <input type="hidden" name="topic_id" value="{{ $topic->id }}">
                                    <button class="btn btn-danger">Delete</button>
                                </form> 
                                </td>
                                @php
                                    $no1++;
                                @endphp
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        </div>
</x-layout>