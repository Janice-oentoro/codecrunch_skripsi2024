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
                    @if(Auth::check() && Auth::user()->role == "consultant")
                    <form action="{{ route('add-conprog') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                            <div class="form-check">
                                @foreach ($programmings as $p)
                                <input class="form-check-input" name="prog_id" type="checkbox" value="{{$p->id}}" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{$p->prog_name}}
                                </label>
                                <br>
                                @endforeach
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
                            <div class="form-check">
                                @foreach ($topics as $t)
                                <input class="form-check-input" name="topic_id" type="checkbox" value="{{$t->id}}" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    {{$t->topic_name}}
                                </label>
                                <br>
                                @endforeach
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

        </div>
    @else
            <p>Login first</p>
    @endif
</x-layout>