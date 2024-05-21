@php
    use App\Http\Controllers\AuthController;
    use App\Models\Consultation;
    use App\Models\ConsultationFeedback;
    use Illuminate\Support\Str;
@endphp
<x-layout>
    @php
    $user = Auth::user();
    @endphp

    @auth
            @if(Auth::user()->role == "consultant")
            <!-- Consultant view -->

                <!-- ADD CONSULTATION MODAL -->
                <!-- Button trigger modal Prog -->
                <div class="ms-5 my-3">
                    <a class="btn btn-primary" data-bs-toggle="modal" style="width: 150px;"
                    data-bs-target="#addconsultation">New Consultation</a>
                </div>

                <!-- Modal Prog-->
                <div class="modal fade" id="addconsultation" tabindex="-1" aria-labelledby="addconsultation" aria-hidden="true">
                    <div class="modal-dialog modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editconsultation">Add Consultation</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                                <div class="modal-body">
                                <form action="{{ route('add-con') }}" method="POST" enctype="multipart/form-data" class="modal-form">
                                @csrf
                                    <div class="form-outline text-start">                        
                                        <label class="form-label" for="form12">Title</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{old('title')}}" name="title" />
                                        @error('title')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline text-start">                        
                                        <label class="form-label" for="form12">Description</label>
                                        <input type="text" class="form-control @error('desc') is-invalid @enderror" value="{{old('desc')}}" name="desc" />
                                        @error('desc')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline text-start">                        
                                        <label class="form-label" for="form12">User Full Name</label>
                                        <input type="string" class="form-control @error('desc') is-invalid @enderror" value="{{old('name')}}" name="name" />
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
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
                                        <input type="datetime-local" class="form-control @error('consult_datetime') is-invalid @enderror" value="{{old('consult_datetime')}}" name="consult_datetime" />
                                        @error('consult_datetime')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline text-start">                        
                                        <label class="form-label" for="form12">End DateTime</label>
                                        <input type="datetime-local" class="form-control @error('end_consult_datetime') is-invalid @enderror" value="{{old('end_consult_datetime')}}" name="end_consult_datetime" />
                                        @error('end_consult_datetime')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-outline text-start">                        
                                        <label class="form-label" for="form12">Link</label>
                                        <input type="text" id="form12" class="form-control" value="{{old('link')}}" name="link" />
                                    </div>

                                    <input id="status" type="hidden" class="form-control" name="status" value="pending">
                                    <input id="consultant_id" type="hidden" class="form-control" name="consultant_id" value="{{Auth::user()->id}}">
                                    
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                
                                </form>
                        </div>

                        </div>
                    </div>
                </div>

                @if(Consultation::where('consultant_id', Auth::id())->doesntExist())
                <div class="ms-5">
                    <p>No Consultations</p>
                </div>
                @else

            <div class="ms-5">
                @if($ccus != "")
                <!-- PENDING -->
                <h4>PENDING</h4>
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                @foreach ($ccus as $ccon)
                @php
                    $avatar = AuthController::imageAdapter($ccon->avatar);
                @endphp
                    <div class="card mb-3" style="width: 75%;">
                        <div class="row g-0">
                            <div class="col-md-4 p-5">
                            @if ($ccon->avatar != null) 
                                <img src="{{ asset($avatar) }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @endif
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title">{{$ccon->title}}</h5>
                                    <p class="card-text">User: {{$ccon->name}}</p>
                                    <p class="card-text">Description: {{$ccon->desc}}</p>
                                    <p class="card-text">Type: {{$ccon->type}}</p>
                                    <p class="card-text">Link: {{$ccon->link}}</p>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title">  </h5>
                                    <br>
                                    <p class="card-text">Start: {{$ccon->consult_datetime}}</p>
                                    <p class="card-text">Start: {{$ccon->consult_datetime}}</p>
                                    <p class="card-text">End: {{$ccon->end_consult_datetime}}</p>
                                    <p class="card-text"><small class="text-muted">{{$ccon->status}}</small></p>
                                    <!-- Button trigger modal Prog -->
                                    <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editconsultation-{{$ccon->id}}"
                                    style="width: 100px;">Edit</a>
                                </div>
                            </div>

                            <div class="card-body text-end">
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
                                                        <input type="text" class="form-control @error('title') is-invalid @enderror" value="{{$ccon->title}}" name="title" />
                                                        @error('title')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-outline text-start">                        
                                                        <label class="form-label" for="form12">Description</label>
                                                        <input type="text" class="form-control @error('desc') is-invalid @enderror" value="{{$ccon->desc}}" name="desc" />
                                                        @error('desc')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-outline text-start">                        
                                                        <label class="form-label" for="form12">User Full Name</label>
                                                        <input type="string" class="form-control @error('desc') is-invalid @enderror" value="{{$ccon->name}}" name="name" />
                                                        @error('name')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
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
                                                        <input type="datetime-local" class="form-control @error('consult_datetime') is-invalid @enderror" value="{{$ccon->consult_datetime}}" name="consult_datetime" />
                                                        @error('consult_datetime')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-outline text-start">                        
                                                        <label class="form-label" for="form12">End DateTime</label>
                                                        <input type="datetime-local" class="form-control @error('end_consult_datetime') is-invalid @enderror" value="{{$ccon->end_consult_datetime}}" name="end_consult_datetime" />
                                                        @error('end_consult_datetime')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>

                                                    <div class="form-outline text-start">                        
                                                        <label class="form-label" for="form12">Link</label>
                                                        <input type="text" id="form12" class="form-control" value="{{$ccon->link}}" name="link" />
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">Submit</button>
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
                    @endforeach
                </ol>
                @endif
            </div>

            <div class="ms-5 mt-4">    
                @if($cccss != "")
                <!-- COMING SOON -->
                <h4>COMING SOON</h4>
            
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                @foreach ($cccss as $ccon)
                @php
                    $avatar = AuthController::imageAdapter($ccon->avatar);
                @endphp
                <div class="card mb-3" style="width: 75%;">
                        <div class="row g-0">
                            <div class="col-md-4 p-5">
                            @if ($ccon->avatar != null) 
                                <img src="{{ asset($avatar) }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @endif
                            </div>
                        <div class="col">
                            <div class="card-body">
                                <h5 class="card-title">{{$ccon->title}}</h5>
                                <p class="card-text">User: {{$ccon->name}}</p>
                                <p class="card-text">Description: {{$ccon->desc}}</p>
                                <p class="card-text">Type: {{$ccon->type}}</p>
                                <p class="card-text">Link: {{$ccon->link}}</p>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card-body">
                            <h5 class="card-title">  </h5>
                                <br>
                                <p class="card-text">Start DateTime: {{$ccon->consult_datetime}}</p>
                                <p class="card-text">End DateTime: {{$ccon->end_consult_datetime}}</p>
                                <p class="card-text"><small class="text-muted">{{$ccon->status}}</small></p>
                                <form action="{{ route('cancel-con') }}" method="POST">
                                @csrf
                                @method('put')
                                <input type="hidden" name="consultation_id" value="{{ $ccon->id }}">
                                <button class="btn btn-danger">Cancel</button>
                                </form>   
                            </div>
                        </div>

                            <div class="card-body text-end">
                            </div>  
                            
                        </div>
                        </div>
                        </div>
                    @endforeach
                </ol>
                @endif
            </div>

            <div class="ms-5 mt-4">
                @if($ccogs != "")
                <!-- ONGOING -->
                <h4>ONGOING</h4>
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                @foreach ($ccogs as $ccon)
                @php
                    $avatar = AuthController::imageAdapter($ccon->avatar);
                @endphp
                <div class="card mb-3" style="width: 75%;">
                        <div class="row g-0">
                            <div class="col-md-4 p-5">
                            @if ($ccon->avatar != null) 
                                <img src="{{ asset($avatar) }}" width="125px" height="125pxpx" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125pxpx" class="img-fluid rounded-circle" alt="...">
                            @endif
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title">{{$ccon->title}}</h5>
                                    <p class="card-text">User: {{$ccon->name}}</p>
                                    <p class="card-text">Description: {{$ccon->desc}}</p>
                                    <p class="card-text">Type: {{$ccon->type}}</p>
                                    <p class="card-text">Link: {{$ccon->link}}</p>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card-body">
                                <h5 class="card-title">  </h5>
                                <br>
                                <p class="card-text">Start DateTime: {{$ccon->consult_datetime}}</p>
                                <p class="card-text">End DateTime: {{$ccon->end_consult_datetime}}</p>
                                <p class="card-text"><small class="text-muted">{{$ccon->status}}</small></p>
                                </div>
                            </div>
                        </div>
                        </div>
                    @endforeach
                </ol>
                @endif
            </div>
                
            <div class="ms-5 mt-4">
                @if($ccfs != "")
                <!-- FINISHED -->
                <h4>FINISHED</h4>
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                @foreach ($ccfs as $ccon)
                @php
                    $avatar = AuthController::imageAdapter($ccon->avatar);
                @endphp
                <div class="card mb-3" style="width: 75%;">
                        <div class="row g-0">
                            <div class="col-md-4 p-5">
                            @if ($ccon->avatar != null) 
                                <img src="{{ asset($avatar) }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125pxpx" class="img-fluid rounded-circle" alt="...">
                            @endif
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title">{{$ccon->title}}</h5>
                                    <p class="card-text">User: {{$ccon->name}}</p>
                                    <p class="card-text">Description: {{$ccon->desc}}</p>
                                    <p class="card-text">Type: {{$ccon->type}}</p>
                                    <p class="card-text">Link: {{$ccon->link}}</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-body">  
                                <h5 class="card-title">  </h5>
                                <br>
                                <p class="card-text">Start DateTime: {{$ccon->consult_datetime}}</p>
                                    <p class="card-text">End DateTime: {{$ccon->end_consult_datetime}}</p>
                                    <p class="card-text"><small class="text-muted">{{$ccon->status}}</small></p>
                                </div>
                            </div>
                        </div>
                        </div>
                    @endforeach
                </ol>
                @endif
            </div>

            <div class="ms-5 mt-4">
                @if($cccs != "")
                <!-- CANCELLED -->
                <h4>CANCELLED</h4>
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                @foreach ($cccs as $ccon)
                @php
                    $avatar = AuthController::imageAdapter($ccon->avatar);
                @endphp
                <div class="card mb-3" style="width: 75%;">
                        <div class="row g-0">
                            <div class="col-md-4 p-5">
                            @if ($ccon->avatar != null) 
                                <img src="{{ asset($avatar) }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @endif
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title">{{$ccon->title}}</h5>
                                    <p class="card-text">User: {{$ccon->name}}</p>
                                    <p class="card-text">Description: {{$ccon->desc}}</p>
                                    <p class="card-text">Type: {{$ccon->type}}</p>
                                    <p class="card-text">Link: {{$ccon->link}}</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-body">  
                                <h5 class="card-title">  </h5>
                                <br>                                 
                                <p class="card-text">Start DateTime: {{$ccon->consult_datetime}}</p>
                                <p class="card-text">End DateTime: {{$ccon->end_consult_datetime}}</p>
                                <p class="card-text"><small class="text-muted">{{$ccon->status}}</small></p>
                                </div>
                            </div>
                        </div>
                        </div>
                    @endforeach
                </ol>
                @endif
            @endif
        </div>

        <!-- User view -->
        @elseif(Auth::user()->role == "user")

        @if(Consultation::where('user_id', Auth::id())->doesntExist())
        <div class="ms-5 mt-4">
            <p>No Consultations</p>
        </div>    
        @else

        <div class="ms-5 mt-4">
            @if($cus != "")
            <!-- PENDING -->
            <h4>PENDING</h4>
            <ol class="list-group list-group-flush list-group-numbered flex-fill">
                    @foreach ($cus as $cu)
                    @php
                        $avatar = AuthController::imageAdapter($cu->avatar);
                    @endphp
                    <div class="card mb-3" style="width: 75%;">
                        <div class="row g-0">
                            <div class="col-md-4 p-5">
                            @if ($cu->avatar != null) 
                                <img src="{{ asset($avatar) }}" width="125px" height="125pxpx" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @endif
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title">{{$cu->title}}</h5>
                                    <p class="card-text">Consultant: {{$cu->name}}</p>
                                    <p class="card-text">Description: {{$cu->desc}}</p>
                                    <p class="card-text">Type: {{$cu->type}}</p>
                                    <p class="card-text">Link: {{$cu->link}}</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title">  </h5>
                                    <br>
                                    <p class="card-text">Start DateTime: {{$cu->consult_datetime}}</p>
                                    <p class="card-text">End DateTime: {{$cu->end_consult_datetime}}</p>
                                    <p class="card-text"><small class="text-muted">{{$cu->status}}</small></p>
                                    <form action="/pay">
                                    <button type="submit" class="btn btn-primary text-white" name="pay" value="{{ $cu->id }}"
                                    style="width: 100px;">Pay</button>
                                    </form>
                                </div>
                            </div>
                            
                            <div class="card-body text-end">
                            </div>

                        </div>
                        </div>
                    @endforeach
                </ol>
            @endif
        </div>
              
        <div class="ms-5 mt-4">
            @if($ccss != "")
            <!-- COMING SOON -->
            <h4>COMING SOON</h4>
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                @foreach ($ccss as $cu)    
                    @php
                        $avatar = AuthController::imageAdapter($cu->avatar);
                    @endphp
                    <div class="card mb-3" style="width: 75%;">
                        <div class="row g-0">
                            <div class="col-md-4 p-5">
                            @if ($cu->avatar != null) 
                                <img src="{{ asset($avatar) }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @endif
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title">{{$cu->title}}</h5>
                                    <p class="card-text">Consultant: {{$cu->name}}</p>
                                    <p class="card-text">Description: {{$cu->desc}}</p>
                                    <p class="card-text">Type: {{$cu->type}}</p>
                                    <p class="card-text">Link: {{$cu->link}}</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title">  </h5>
                                    <br>
                                    <p class="card-text">Start DateTime: {{$cu->consult_datetime}}</p>
                                    <p class="card-text">End DateTime: {{$cu->end_consult_datetime}}</p>
                                    <p class="card-text"><small class="text-muted">{{$cu->status}}</small></p>
                                </div>
                            </div>
                        </div>
                        </div>
                @endforeach
                </ol>
            @endif
        </div>

        <div class="ms-5 mt-4">
            @if($cogs != "")
            <!-- ONGOING -->
            <h4>ONGOING</h4>
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                @foreach ($cogs as $cu)    
                    @php
                        $avatar = AuthController::imageAdapter($cu->avatar);
                    @endphp
                    <div class="card mb-3" style="width: 75%;">
                        <div class="row g-0">
                            <div class="col-md-4 p-5">
                            @if ($cu->avatar != null) 
                                <img src="{{ asset($avatar) }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @endif
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title">{{$cu->title}}</h5>
                                    <p class="card-text">Consultant: {{$cu->name}}</p>
                                    <p class="card-text">Description: {{$cu->desc}}</p>
                                    <p class="card-text">Type: {{$cu->type}}</p>
                                    <p class="card-text">Link: {{$cu->link}}</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title">  </h5>
                                    <br>
                                    <p class="card-text">Start DateTime: {{$cu->consult_datetime}}</p>
                                    <p class="card-text">End DateTime: {{$cu->end_consult_datetime}}</p>
                                    <p class="card-text"><small class="text-muted">{{$cu->status}}</small></p>
                                </div>
                            </div>
                        </div>
                        </div>
                @endforeach
                </ol>
                @endif
        </div>

        <div class="ms-5 mt-4">    
            @if($cufs != "")
            <!-- FINISHED -->
            <h4>FINISHED</h4>
            @foreach ($cufs as $cu)
                <ol class="list-group list-group-flush list-group-numbered flex-fill">
                    @php
                        $avatar = AuthController::imageAdapter($cu->avatar);
                        if(ConsultationFeedback::where('consultation_id', $cu->id)->exists()){
                            $feedback = true;
                        } else {
                            $feedback = false;
                        };
                    @endphp
                    <div class="card mb-3" style="width: 75%;">
                        <div class="row g-0">
                            <div class="col-md-4 p-5">
                            @if ($cu->avatar != null) 
                                <img src="{{ asset($avatar) }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @endif
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title">{{$cu->title}}</h5>
                                    <p class="card-text">Consultant: {{$cu->name}}</p>
                                    <p class="card-text">Description: {{$cu->desc}}</p>
                                    <p class="card-text">Type: {{$cu->type}}</p>
                                    <p class="card-text">Link: {{$cu->link}}</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title">  </h5>
                                    <br>
                                    <p class="card-text">Start DateTime: {{$cu->consult_datetime}}</p>
                                    <p class="card-text">End DateTime: {{$cu->end_consult_datetime}}</p>
                                    <p class="card-text"><small class="text-muted">{{$cu->status}}</small></p>
                                    @if(!$feedback)
                                        <!-- Button Trigger Modal -->
                                        <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addfeedback-{{$cu->id}}"
                                        style="width:100px;">Feedback</a>
                                    @endif
                                </div>
                            </div>

                            <div class="card-body text-end">
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
                                                        <button type="submit" class="btn btn-success">Submit</button>
                                                    </div>
                                                </form> 
                                        </div>
       
                                        </div>
                                    </div>
                                </div>
                                </div>
                            
                        </div>
                    </div>
                        @endforeach
                </ol>
                @endif
        </div>

        <div class="ms-5 mt-4">
            @if($cucs != "")
            <!-- CANCELLED -->
            <h4>CANCELLED</h4>
            @foreach ($cucs as $cu)
                <ol clsss="list-group list-group-flush list-group-numbered flex-fill">
                    @php
                        $avatar = AuthController::imageAdapter($cu->avatar);
                    @endphp
                    <div class="card mb-3" style="width: 75%;">
                        <div class="row g-0">
                            <div class="col-md-4 p-5">
                            @if ($cu->avatar != null) 
                                <img src="{{ asset($avatar) }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @else
                                <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125px" class="img-fluid rounded-circle" alt="...">
                            @endif
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title">{{$cu->title}}</h5>
                                    <p class="card-text">Consultant: {{$cu->name}}</p>
                                    <p class="card-text">Description: {{$cu->desc}}</p>
                                    <p class="card-text">Type: {{$cu->type}}</p>
                                    <p class="card-text">Link: {{$cu->link}}</p>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-body">
                                    <h5 class="card-title">  </h5>
                                    <br>
                                    <p class="card-text">Start DateTime: {{$cu->consult_datetime}}</p>
                                    <p class="card-text">End DateTime: {{$cu->end_consult_datetime}}</p>
                                    <p class="card-text"><small class="text-muted">{{$cu->status}}</small></p>
                                </div>
                            </div>
                        </div>
                        </div>
                        @endforeach
                </ol>
                @endif
        </div>

            @endif
        @endif
            
    @else
            <p>Login first</p>
    @endif

</x-layout>