<?php 
    use Carbon\Carbon; #GET CURRENT TIME
    use App\Models\Consultation;
    use Illuminate\Support\Facades\Auth;
    $curr= Carbon::now('GMT+7')->format('Y-m-d H:i:s');
?>
<x-layout>
    @php
    $user = Auth::user();
    @endphp

    @auth
        <div class="test">
            <h2>Consultation</h2>
        </div>

            @if(Auth::user()->role == "consultant")
            <!-- Consultant view -->
                <button class="btn btn-primary" onclick=window.location="{{ url('/addconsultation') }}">Add Consultation</button>

                <!-- Display Consultations -->
                <h5>Display Consultation</h5>

                <!-- UNPAID -->
                @foreach ($cconsults as $ccon)
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                    
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src="..." class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$ccon->title}}</h5>
                                <p class="card-text">User: {{$ccon->name}}</p>
                                <p class="card-text">Description: {{$ccon->desc}}</p>
                                <p class="card-text">Type: {{$ccon->type}}</p>
                                <p class="card-text">Start DateTime: {{$ccon->consult_datetime}}</p>
                                <p class="card-text">End DateTime: {{$ccon->end_consult_datetime}}</p>
                                <p class="card-text">Link: {{$ccon->link}}</p>
                                <p class="card-text"><small class="text-muted">{{$ccon->status}}</small></p>
                            </div>
                            
                            <div class="card-body text-end">
                                <!-- Button trigger modal Prog -->
                                <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editconsultation-{{$ccon->id}}">Edit</a>
                                
                                <!-- Modal Prog-->
                                <div class="modal fade" id="editconsultation-{{$ccon->id}}" tabindex="-1" aria-labelledby="editconsultation" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editconsultation">Edit Consultation</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                                <div class="modal-body">
                                                <form action="{{ route('edit-con', $ccon->id) }}" method="POST" enctype="multipart/form-data" class="modal-form">
                                                @csrf
                                                    <div class="form-outline text-start">                        
                                                        <label class="form-label" for="form12">Title</label>
                                                        <input type="text" class="form-control" value="{{$ccon->title}}" name="title" />
                                                    </div>

                                                    <div class="form-outline text-start">                        
                                                        <label class="form-label" for="form12">Description</label>
                                                        <input type="text" class="form-control" value="{{$ccon->desc}}" name="desc" />
                                                    </div>

                                                    <div class="form-outline text-start">                        
                                                        <label class="form-label" for="form12">User ID</label>
                                                        <input type="number" class="form-control" value="{{$ccon->user_id}}" name="user_id" />
                                                    </div>

                                                    <div class="form-outline text-start">                        
                                                        <label class="form-label" for="form12">Type</label>
                                                        <select class="form-select" id="type" name="type" required focus>
                                                            <option value="chat">Chat</option>        
                                                            <option value="video conference">Video Conference</option>             
                                                        </select>
                                                    </div>

                                                    <div class="form-outline text-start">                        
                                                        <label class="form-label" for="form12">Start DateTime</label>
                                                        <input type="datetime-local" class="form-control" value="{{$ccon->consult_datetime}}" name="consult_datetime" />
                                                    </div>

                                                    <div class="form-outline text-start">                        
                                                        <label class="form-label" for="form12">End DateTime</label>
                                                        <input type="datetime-local" class="form-control" value="{{$ccon->end_consult_datetime}}" name="end_consult_datetime" />
                                                    </div>

                                                    <div class="form-outline text-start">                        
                                                        <label class="form-label" for="form12">Link</label>
                                                        <input type="text" id="form12" class="form-control" value="{{$ccon->link}}" name="link" />
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-warning">Submit</button>
                                                    </div>
                                                
                                                </form>
                                        </div>

                                        </div>
                                    </div>
                                </div>

                                <form action="{{ route('delete-con') }}" method="POST">
                                @csrf
                                @method('delete')
                                <input type="hidden" name="consultation_id" value="{{ $ccon->id }}">
                                <button class="btn btn-danger">Delete</button>
                                </form>     
                            </div>


                            </div>
                        </div>
                        </div>
                    @endforeach
                </ol>

            <!-- User view -->
            @elseif(Auth::user()->role == "user")
            <h5>DISPLAY CONSULTATION</h5>

            <!-- UNPAID -->
            <h4>UNPAID</h4>
            @foreach ($cus as $cu)
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                    
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src="..." class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$cu->title}}</h5>
                                <p class="card-text">Consultant: {{$cu->name}}</p>
                                <p class="card-text">Description: {{$cu->desc}}</p>
                                <p class="card-text">Type: {{$cu->type}}</p>
                                <p class="card-text">Start DateTime: {{$cu->consult_datetime}}</p>
                                <p class="card-text">End DateTime: {{$cu->end_consult_datetime}}</p>
                                <p class="card-text">Link: {{$cu->link}}</p>
                                <p class="card-text"><small class="text-muted">{{$cu->status}}</small></p>
                            </div>
                            </div>
                        </div>
                        </div>
                </ol>

                @endforeach
                
            <!-- COMING SOON -->
            <h4>COMING SOON</h4>
            @foreach ($ccss as $ccs)
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                    
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src="..." class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$ccs->title}}</h5>
                                <p class="card-text">Consultant: {{$ccs->name}}</p>
                                <p class="card-text">Description: {{$ccs->desc}}</p>
                                <p class="card-text">Type: {{$ccs->type}}</p>
                                <p class="card-text">Start DateTime: {{$ccs->consult_datetime}}</p>
                                <p class="card-text">End DateTime: {{$ccs->end_consult_datetime}}</p>
                                <p class="card-text">Link: {{$ccs->link}}</p>
                                <p class="card-text"><small class="text-muted">{{$ccs->status}}</small></p>
                            </div>
                            </div>
                        </div>
                        </div>
                </ol>

                @endforeach

            <!-- ON GOING -->
            <h4>ONGOING</h4>
            @foreach ($cogs as $cu)
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                    
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src="..." class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$cu->title}}</h5>
                                <p class="card-text">Consultant: {{$cu->name}}</p>
                                <p class="card-text">Description: {{$cu->desc}}</p>
                                <p class="card-text">Type: {{$cu->type}}</p>
                                <p class="card-text">Start DateTime: {{$cu->consult_datetime}}</p>
                                <p class="card-text">End DateTime: {{$cu->end_consult_datetime}}</p>
                                <p class="card-text">Link: {{$cu->link}}</p>
                                <p class="card-text"><small class="text-muted">{{$cu->status}}</small></p>
                            </div>
                            </div>
                        </div>
                        </div>
                </ol>

                @endforeach

            <!-- FINISHED -->
            <h4>FINISHED</h4>
            @foreach ($cufs as $cu)
                <ol clsss="list-group list-group-flush list-group-numbered flex-fill">
                    
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            <img src="..." class="img-fluid rounded-start" alt="...">
                            </div>
                            <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title">{{$cu->title}}</h5>
                                <p class="card-text">Consultant: {{$cu->name}}</p>
                                <p class="card-text">Description: {{$cu->desc}}</p>
                                <p class="card-text">Type: {{$cu->type}}</p>
                                <p class="card-text">Start DateTime: {{$cu->consult_datetime}}</p>
                                <p class="card-text">End DateTime: {{$cu->end_consult_datetime}}</p>
                                <p class="card-text">Link: {{$cu->link}}</p>
                                <p class="card-text"><small class="text-muted">{{$cu->status}}</small></p>
                            </div>
                            </div>
                        </div>
                        </div>
                </ol>

                @endforeach

            @endif
            
    @else
            <p>Login first</p>
    @endif

</x-layout>