@php
    use App\Http\Controllers\AuthController;
    use App\Models\ConsultationFeedback;
    use Illuminate\Support\Str;
@endphp
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

                <!-- PENDING -->
                <h4>PENDING</h4>
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                @foreach ($ccus as $ccon)
                @php
                    $avatar = AuthController::imageAdapter($ccon->avatar);
                @endphp
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            @if ($ccon->avatar != null) 
                                <img src="{{ asset($avatar) }}" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" class="img-fluid rounded-circle" alt="...">
                            @endif
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

                                            <form action="{{ route('cancel-con') }}" method="POST" class="modal-form">
                                            @csrf
                                            @method('put')
                                            <input type="hidden" name="consultation_id" value="{{ $ccon->id }}">
                                                <div class="modal-footer">
                                                    <button class="btn btn-danger">Cancel</button>
                                                </div>
                                            </form>  
                                        </div>
       
                                        </div>
                                    </div>
                                </div>

                            </div>
                            </div>
                        </div>
                        </div>
                    @endforeach
                </ol>

                <!-- COMING SOON -->
                <h4>COMING SOON</h4>
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                @foreach ($cccss as $ccon)
                @php
                    $avatar = AuthController::imageAdapter($ccon->avatar);
                @endphp
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            @if ($ccon->avatar != null) 
                                <img src="{{ asset($avatar) }}" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" class="img-fluid rounded-circle" alt="...">
                            @endif
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

                                <form action="{{ route('cancel-con') }}" method="POST">
                                @csrf
                                @method('put')
                                <input type="hidden" name="consultation_id" value="{{ $ccon->id }}">
                                <button class="btn btn-danger">Cancel</button>
                                </form>     
                            </div>
                            </div>
                        </div>
                        </div>
                    @endforeach
                </ol>

                <!-- ONGOING -->
                <h4>ONGOING</h4>
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                @foreach ($ccogs as $ccon)
                @php
                    $avatar = AuthController::imageAdapter($ccon->avatar);
                @endphp
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            @if ($ccon->avatar != null) 
                                <img src="{{ asset($avatar) }}" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" class="img-fluid rounded-circle" alt="...">
                            @endif
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
                            </div>
                        </div>
                        </div>
                    @endforeach
                </ol>
                
                <!-- FINISHED -->
                <h4>FINISHED</h4>
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                @foreach ($ccfs as $ccon)
                @php
                    $avatar = AuthController::imageAdapter($ccon->avatar);
                @endphp
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            @if ($ccon->avatar != null) 
                                <img src="{{ asset($avatar) }}" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" class="img-fluid rounded-circle" alt="...">
                            @endif
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
                            </div>
                        </div>
                        </div>
                    @endforeach
                </ol>

                <!-- CANCELLED -->
                <h4>CANCELLED</h4>
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                @foreach ($cccs as $ccon)
                @php
                    $avatar = AuthController::imageAdapter($ccon->avatar);
                @endphp
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            @if ($ccon->avatar != null) 
                                <img src="{{ asset($avatar) }}" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" class="img-fluid rounded-circle" alt="...">
                            @endif
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
                            </div>
                        </div>
                        </div>
                    @endforeach
                </ol>

            <!-- User view -->
            @elseif(Auth::user()->role == "user")
            <h5>DISPLAY CONSULTATION</h5>

            <!-- PENDING -->
            <h4>PENDING</h4>
            <ol class="list-group list-group-flush list-group-numbered flex-fill">
                    @foreach ($cus as $cu)
                    @php
                        $avatar = AuthController::imageAdapter($cu->avatar);
                    @endphp
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            @if ($cu->avatar != null) 
                                <img src="{{ asset($avatar) }}" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" class="img-fluid rounded-circle" alt="...">
                            @endif
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

                                <form action="/pay">

                                <button type="submit" class="btn text-white" name="pay" value="{{ $cu->id }}"
                                style="background-color:blueviolet; font-size: 18px">Pay</button>

                                </form>

                            </div>
                            </div>
                        </div>
                        </div>
                    @endforeach
                </ol>
                
            <!-- COMING SOON -->
            <h4>COMING SOON</h4>
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                @foreach ($ccss as $cu)    
                    @php
                        $avatar = AuthController::imageAdapter($cu->avatar);
                    @endphp
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            @if ($cu->avatar != null) 
                                <img src="{{ asset($avatar) }}" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" class="img-fluid rounded-circle" alt="...">
                            @endif
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
                @endforeach
                </ol>

            <!-- ONGOING -->
            <h4>ONGOING</h4>
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                @foreach ($cogs as $cu)    
                    @php
                        $avatar = AuthController::imageAdapter($cu->avatar);
                    @endphp
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            @if ($cu->avatar != null) 
                                <img src="{{ asset($avatar) }}" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" class="img-fluid rounded-circle" alt="...">
                            @endif
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
                @endforeach
                </ol>

            <!-- FINISHED -->
            <h4>FINISHED</h4>
            @foreach ($cufs as $cu)
                <ol clsss="list-group list-group-flush list-group-numbered flex-fill">
                    @php
                        $avatar = AuthController::imageAdapter($cu->avatar);
                    @endphp
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            @if ($cu->avatar != null) 
                                <img src="{{ asset($avatar) }}" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" class="img-fluid rounded-circle" alt="...">
                            @endif
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

                            @php
                                if(ConsultationFeedback::where('consultation_id', $cu->id)->exists()){
                                    $feedback = true;
                                } else {
                                    $feedback = false;
                                };
                            @endphp

                            <div class="card-body text-end">
                                <!-- Button trigger modal Prog -->
                                @if(!$feedback)
                                    <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addfeedback-{{$cu->id}}">Feedback</a>
                                @endif

                                <!-- Modal Prog-->
                                <div class="modal fade" id="addfeedback-{{$cu->id}}" tabindex="-1" aria-labelledby="addfeedback" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="addfeedback">Add Feedback</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                                <div class="modal-body">
                                                <form action="{{ route('add-feedback') }}" method="POST" enctype="multipart/form-data" class="modal-form">
                                                @csrf
                                                    <div class="form-outline text-start">                        
                                                        <label class="form-label" for="form12">Rating</label>
                                                        <select class="form-select" id="rating" name="rating" required focus>
                                                            <option value="1">1</option>        
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>    
                                                            <option value="4">4</option>    
                                                            <option value="5">5</option>                 
                                                        </select>
                                                    </div>

                                                    <div class="form-outline text-start">                        
                                                        <label class="form-label" for="form12">Comment</label>
                                                        <input type="text" class="form-control" value="{{ old('comment') }}" name="comment" required autofocus/>
                                                    </div>
                                                        <input type="hidden" class="form-control" value="{{ $cu->id }}" name="consultation_id" required autofocus/>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-warning">Submit</button>
                                                    </div>
                                                </form> 
                                        </div>
       
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>


                        </div>
                    </div>
                        @endforeach
                </ol>

            <!-- CANCELLED -->
            <h4>CANCELLED</h4>
            @foreach ($cucs as $cu)
                <ol clsss="list-group list-group-flush list-group-numbered flex-fill">
                    @php
                        $avatar = AuthController::imageAdapter($cu->avatar);
                    @endphp
                    <div class="card mb-3" style="max-width: 540px;">
                        <div class="row g-0">
                            <div class="col-md-4">
                            @if ($cu->avatar != null) 
                                <img src="{{ asset($avatar) }}" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" class="img-fluid rounded-circle" alt="...">
                            @endif
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
                        @endforeach
                </ol>
                
            @endif
            
    @else
            <p>Login first</p>
    @endif

</x-layout>