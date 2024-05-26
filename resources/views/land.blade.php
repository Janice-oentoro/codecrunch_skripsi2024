<?php
    use App\Models\ProgConsultant;
    use App\Models\TopicConsultant;
    use App\Models\Programming;
    use App\Models\Topic;
    use App\Models\ConsultationFeedback;
    use Illuminate\Support\Arr;
    $progs = Programming::all();    
    $topics = Topic::all();
?>
@php
    use App\Http\Controllers\AuthController;
    use Illuminate\Support\Str;
@endphp

<x-layout>
<div class="ms-5">
    <div class="mt-2">
        <form action="{{ route('land') }}" class="" method="GET">
            <!-- Search -->
            <div class="row g-0">
                <div class="col-md-3">    
                    <label for="search">Search</label>
                    <input type="text" name="search" id="search" class="form-control" aria-describedby="helpId" value="{{$search}}">
                </div>

                <div class="col-md-3">
                    <br>
                    <button class="btn btn-primary mx-2">
                        <i class="fa fa-search"></i></button>
                        <a href="/" class="btn btn-primary"><i class="fa fa-rotate-left"></i></a>
                </div>
            </div>
        </form>
    </div>

    <div class="mt-3">
        <form action="{{ route('land') }}" class="" method="GET">
            <div class="row g-0">
            <!-- Filter Programming -->
                <div class="col-md-4" style="width: 25%;">
                    <label for="filter">Programming</label>
                    <select name="filterprog" id="filterprog" class="form-select">
                        <option value="">Select Programming</option>
                        @foreach($progs as $prog)
                            <option value="{{$prog->prog_name}}">{{$prog->prog_name}}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Filter Topic -->
                <div class="col-md-4 ps-5" style="width:25%;">
                    <label for="filter">Topic</label>
                    <select name="filtertopic" id="filtertopic" class="form-select">
                        <option value="">Select Topic</option>
                        @foreach($topics as $topic)
                            <option value="{{$topic->topic_name}}">{{$topic->topic_name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <br>
                    <button class="btn btn-primary mx-2"><i class="fa fa-filter"></i></button>
                </div>
            </div>
        </form>
    </div>

    <!--List of Consultants View -->
    <br>
    <div class="row g-0">

    @foreach($users as $u)
        @php
            $avatar = AuthController::imageAdapter($u->avatar);
            if(ConsultationFeedback::where('consultant_id', $u->id)->join('consultations', 'consultation_feedback.consultation_id', 'consultations.id')
            ->exists()) {
                $avgRating = ConsultationFeedback::where('consultant_id', $u->id)->join('consultations', 'consultation_feedback.consultation_id', 'consultations.id')
                ->avg('rating');            
                
                $countRating = ConsultationFeedback::where('consultant_id', $u->id)->join('consultations', 'consultation_feedback.consultation_id', 'consultations.id')
                ->count('rating');
            } else {
                $avgRating = 0;
                $countRating = 0;
            }
        @endphp
    
    <div class="card mb-3 me-5 d-block" style="width: 45%; ">
    <div class="row g-0">
        <div class="col-md-4 pt-5 ps-4">
            @if($u->avatar != null)
                <img src="{{ asset($avatar) }}" width="125px" height="125px" style="clip-path: circle();" 
                class="img-fluid rounded-circle d-flex justify-content-center align-items-center"
                style="height:125px; width:125px;" alt="...">
            @else
                <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125px" style="clip-path: circle();" 
                class="img-fluid rounded-circle d-flex justify-content-center align-items-center"
                style="height:125px; width:125px;" alt="...">
            @endif
        </div>
        <div class="col-md-8">
            <h5 class="card-title mt-3">{{$u->name}}</h5>
            <div class="card-body">
            @if($avgRating > 0)
                <h6 class="card-subtitle mb-2 text-muted">{{ round($avgRating, 2) }} <i class="fa-solid fa-star" style="color: #f5d047;"></i></h6>
                <h6 class="card-subtitle mb-2 text-muted">{{ $countRating }} <i class="fa-solid fa-user"></i></h6>
            @else
                <h6 class="card-subtitle mb-2 text-muted">No Rating</h6>
                <h6 class="card-subtitle mb-2 text-muted">No Helped Users</h6>
            @endif
            <p class="card-text">Rp {{$u->price}}</p>
            <!-- Programming Skills View -->
                <?php 
                    if(ProgConsultant::where('consultant_id', $u->id)
                    ->join('users', 'consultant_id', '=', 'users.id')
                    ->join('programmings', 'prog_id', '=', 'programmings.id')->exists()){
                        $pcs = ProgConsultant::where('consultant_id', $u->id)
                        ->join('users', 'consultant_id', '=', 'users.id')
                        ->join('programmings', 'prog_id', '=', 'programmings.id')
                        ->get(['prog_name']);
    
                        $i = 0;
                        foreach($pcs as $p){
                            $progArr[$i] = $p->prog_name;
                            $i++;
                        }
                        $progString = implode(", ", $progArr);
                    } else {
                        $progString = "";
                    }
                ?>
                <p class="card-text">Programmings: {{$progString}}</p>
            
            <!-- Topic Skills View -->
                <?php 
                    if(TopicConsultant::where('consultant_id', $u->id)
                    ->join('users', 'consultant_id', '=', 'users.id')
                    ->join('topics', 'topic_id', '=', 'topics.id')->exists()){
                        $tcs = TopicConsultant::where('consultant_id', $u->id)
                        ->join('users', 'consultant_id', '=', 'users.id')
                        ->join('topics', 'topic_id', '=', 'topics.id')
                        ->get(['consultant_id', 'topic_name']);
    
                        $i2 = 0;
                        foreach($tcs as $t){
                            $topicArr[$i2] = $t->topic_name;
                            $i2++;
                        }
                        $topicString = implode(", ", $topicArr);
                    } else {
                        $topicString = "";
                    }
                ?>
                <p class="card-text">Topics: {{$topicString}}</p>
            </div>
            
            <div class="card-body text-end">
                <a href="/detailconsultant/{{$u->id}}" class="btn btn-warning align-self-end" name="id">Detail</a>
            </div>
        </div>
    </div>
    </div>
    @endforeach    
    
</div>
    <div class="pagination">
        {{ $users->links() }}
    </div>
</div>
</x-layout>