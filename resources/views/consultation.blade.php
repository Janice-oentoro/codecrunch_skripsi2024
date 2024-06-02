<?php
    use App\Http\Controllers\AuthController;
    use App\Models\Consultation;
    use App\Models\ConsultationFeedback;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Session;
?>
<x-layout>
@php
$user = Auth::user();
if(Consultation::where('user_id', Auth::id())->exists() || Consultation::where('consultant_id', Auth::id())->exists()){
    $c = true;
} else {
    $c = false;
};

@endphp

@auth
<!-- ADD CONSULTATION BUTTON MODAL -->
@if(Auth::user()->role == "consultant")
<div class="ms-5 my-3">
    @if (Session::has('success'))
        <div class="alert alert-success me-5 d-block" role="alert">
            {{ nl2br(Session::get('success')) }}
        </div>
    @elseif (Session::has('success-edit'))
    <div class="alert alert-success me-5 d-block" role="alert">
        {{ nl2br(Session::get('success-edit')) }}
    </div>
    @elseif (Session::has('success-del'))
        <div class="alert alert-danger me-5 d-block" role="alert">
            {{ nl2br(Session::get('success-del')) }}
        </div>
    @endif
    <a class="btn btn-primary" data-bs-toggle="modal" style="width: 150px;"
    data-bs-target="#addconsultation">New Consultation</a>
</div>
@endif

@if($c == false)
<div class="ms-5 my-3">
    <p>No Consultations</p>
</div>
@endif

<!-- PENDING -->
<div class="ms-5">
    @if($ps != "")
    <h4>PENDING</h4>
    <div class="row g-0">
    @foreach ($ps as $ccon)
    @php
        $avatar = AuthController::imageAdapter($ccon->avatar);
        @endphp
        <div class="card mb-3 me-3 d-block" style="width: 48%;">
            <div class="row g-0">
                <div class="col-md-4 p-5">
                @if ($ccon->avatar != null) 
                    <img src="{{ asset($avatar) }}" width="125px" height="125px"
                        class="rounded-circle justify-content-center align-items-center"
                        style="height:125px; width:125px;" alt="...">
                @else
                    <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125px"
                        class="rounded-circle justify-content-center align-items-center"
                        style="height:125px; width:125px;" alt="...">
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
                        <p class="card-text">End: {{$ccon->end_consult_datetime}}</p>
                        <p class="card-text rounded-pill text-white" 
                        style="background-color:peru; width:150px; text-align:center;">{{$ccon->status}}</p>
                        <!-- EDIT CONSULTATION BUTTON MODAL -->
                        @if(Auth::user()->role == "consultant")
                        <a class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editconsultation-{{$ccon->id}}"
                            style="width: 40px;"><i class="fas fa-edit"></i></a>
                        </div>
                        @elseif(Auth::user()->role == "user")
                        <form action="/pay">
                            <button type="submit" class="btn btn-primary text-white" name="pay" value="{{ $ccon->id }}"
                            style="width: 100px;">Pay</button>
                         </form>
                        @endif
                    </div>
            </div>
        </div>

        <!-- EDIT CONSULTATION MODAL -->
        <div class="modal fade" id="editconsultation-{{$ccon->id}}" tabindex="-1" aria-labelledby="editconsultation" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editconsultation">Edit Consultation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                        <div class="modal-body">
                            <form action="{{ route('edit-con') }}" method="POST" enctype="multipart/form-data" class="modal-form">
                                @csrf @method('put')
                            <input type="hidden" name="id" value="{{ $ccon->id }}">
                            
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
        @endforeach
    @endif
</div>
</div>
<!-- PENDING -->

<!-- COMING SOON -->
<div class="ms-5 mt-4">    
    @if($cms != "")
    <h4>COMING SOON</h4>
    <div class="row g-0">
    @foreach ($cms as $ccon)
    @php
        $avatar = AuthController::imageAdapter($ccon->avatar);
    @endphp
        <div class="card mb-3 me-3 d-block" style="width: 48%;">
            <div class="row g-0">
                <div class="col-md-4 p-5">
                @if ($ccon->avatar != null) 
                    <img src="{{ asset($avatar) }}" width="125px" height="125px"
                        class="rounded-circle justify-content-center align-items-center"
                        style="height:125px; width:125px;" alt="...">
                @else
                    <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125px"
                        class="rounded-circle justify-content-center align-items-center"
                        style="height:125px; width:125px;" alt="...">
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
                <h5 class="card-title"> </h5>
                    <br>
                    <p class="card-text">Start: {{$ccon->consult_datetime}}</p>
                    <p class="card-text">End: {{$ccon->end_consult_datetime}}</p>
                    <p class="card-text rounded-pill text-white" 
                    style="background-color:dodgerblue; width:150px; text-align:center;">{{$ccon->status}}</p>
                    
                    <!-- CANCEL BUTTON -->
                    @if(Auth::user()->role == 'consultant')
                        <form action="{{ route('cancel-con') }}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="consultation_id" value="{{ $ccon->id }}">
                        <button class="btn btn-danger">Cancel</button>
                        </form>   
                    @endif
                </div>
            </div>

            </div>
        </div>
        @endforeach
    @endif
    </div>
</div>
<!-- COMING SOON -->

<!-- ONGOING -->
<div class="ms-5 mt-4">
    @if($ogs != "")
    <h4>ONGOING</h4>
    <div class="row g-0">
    @foreach ($ogs as $ccon)
    @php
        $avatar = AuthController::imageAdapter($ccon->avatar);
    @endphp
    <div class="card mb-3 me-3 d-block" style="width: 48%;">
            <div class="row g-0">
                <div class="col-md-4 p-5">
                @if ($ccon->avatar != null) 
                    <img src="{{ asset($avatar) }}" width="125px" height="125px"
                        class="rounded-circle justify-content-center align-items-center"
                        style="height:125px; width:125px;" alt="...">
                @else
                    <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125px"
                        style="height:125px; width:125px;" alt="...">
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
                    <p class="card-text">End: {{$ccon->end_consult_datetime}}</p>
                    <p class="card-text rounded-pill text-white" 
                    style="background-color:green; width:150px; text-align:center;">{{$ccon->status}}</p>
                    </div>
                </div>
            </div>
            </div>
        @endforeach
        </div>
    @endif
</div>
<!-- ONGOING -->

<!-- FINISHED -->
<div class="ms-5 mt-4">
    @if($fs != "")
    <h4>FINISHED</h4>
    <div class="row g-0">
    @foreach ($fs as $ccon)
    @php
        $avatar = AuthController::imageAdapter($ccon->avatar);
        if(Auth::user()->role == 'user') {
            if(ConsultationFeedback::where('consultation_id', $ccon->id)->exists()){
                $feedback = true;
            } else {
                $feedback = false;
            };
        } else {
            $feedback = true;
        };
    @endphp
    <div class="card mb-3 me-3 d-block" style="width: 48%;">
            <div class="row g-0">
                <div class="col-md-4 p-5">
                @if ($ccon->avatar != null) 
                    <img src="{{ asset($avatar) }}" width="125px" height="125px"
                        class="rounded-circle justify-content-center align-items-center"
                        style="height:125px; width:125px;" alt="...">
                @else
                    <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125px"
                        class="rounded-circle justify-content-center align-items-center"
                        style="height:125px; width:125px;" alt="...">
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
                        <p class="card-text">End: {{$ccon->end_consult_datetime}}</p>
                        <p class="card-text rounded-pill text-white" 
                        style="background-color:mediumslateblue; width:150px; text-align:center;">{{$ccon->status}}</p>
                        <!-- Finished Button Trigger Modal -->
                        @if(!$feedback )    
                            <a class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addfeedback-{{$ccon->id}}"
                            style="width:100px;">Feedback</a>
                        @endif
                    </div>
                </div>
            </div>
            </div>

            <!-- FEEDBACK MODAL -->
            <div class="modal fade" id="addfeedback-{{$ccon->id}}" tabindex="-1" aria-labelledby="addfeedback" aria-hidden="true">
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
                                    <input type="hidden" class="form-control" value="{{ $ccon->id }}" name="consultation_id" required autofocus/>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                </div>
                            </form> 
                    </div>

                    </div>
                </div>
            </div>
        @endforeach
    @endif
    </div>
</div>
<!-- FINISHED -->

<!-- CANCELLED -->
<div class="ms-5 mt-4">
    @if($cs != "")
    <h4>CANCELLED</h4>
    <div class="row g-0">
    @foreach ($cs as $ccon)
    @php
        $avatar = AuthController::imageAdapter($ccon->avatar);
    @endphp
    <div class="card mb-3 me-3 d-block" style="width: 48%;">
            <div class="row g-0">
                <div class="col-md-4 p-5">
                @if ($ccon->avatar != null) 
                    <img src="{{ asset($avatar) }}" width="125px" height="125px"
                        class="rounded-circle justify-content-center align-items-center"
                        style="height:125px; width:125px;" alt="...">
                @else
                    <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125px"
                        class="rounded-circle justify-content-center align-items-center"
                        style="height:125px; width:125px;" alt="...">
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
                    <p class="card-text">End: {{$ccon->end_consult_datetime}}</p>
                    <p class="card-text rounded-pill text-white" 
                    style="background-color:firebrick; width:150px; text-align:center;">{{$ccon->status}}</p>
                    </div>
                </div>
            </div>
            </div>
        @endforeach
    @endif
    </div>
</div>
<!-- CANCELLED -->

<!-- ADD CONSULTATION MODAL -->
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
                        <input type="string" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" name="name" />
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

@else
<div class="mt-3 ms-5">
    <p>Login first</p>
</div>

@endif
</x-layout>