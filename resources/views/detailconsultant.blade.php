<?php
    use App\Models\ProgConsultant;
    use App\Models\TopicConsultant;
?>
@php
    use App\Http\Controllers\AuthController;
    use Illuminate\Support\Str;
@endphp
<x-layout>

@if($udtl->suspend == false)
@php
    $avatar = AuthController::imageAdapter($udtl->avatar);
@endphp
<div class="container d-block align-items-center justify-content-center mt-5 pt-5">
    <div class="card mb-3 d-block text-white" style="width:100%; background-color: #001D3D;">
    <div class="row g-0">
        <div class="col-md-3 pt-5 container justify-content-center align-items-center">
            <div class="row g-0">
            @if ($udtl->avatar != null) 
                <img src="{{ asset($avatar) }}" width="125px" height="125px" style="clip-path: circle();" 
                class="img-fluid rounded-circle d-flex justify-content-center align-items-center border border-white border-4"
                style="height:125px; width:125px;" alt="...">
            @else
                <img src="{{ asset('/storage/images/def-icon.png') }}" width="125px" height="125px" style="clip-path: circle();" 
                class="img-fluid rounded-circle d-flex justify-content-center align-items-center border border-white border-4"
                style="height:125px; width:125px;" alt="...">
            @endif
        </div>
        </div>

        <div class="col-md-7 pe-5 me-5">
        <div class="card-body">
            <h2 class="card-title">{{$udtl->name}}</h2>

            @if($avgRating > 0)
                <h6 class="card-subtitle mb-2">{{ round($avgRating, 2) }}<i class="fa-solid fa-star" style="color: #f5d047;"></i></h6>
                <h6 class="card-subtitle mb-2">{{ $countRating }} <i class="fa-solid fa-user"></i></h6>
            @else
                <h6 class="card-subtitle mb-2">No Rating</h6>
                <h6 class="card-subtitle mb-2">No Helped Users</h6>
            @endif

            <p class="card-text">Rp {{$udtl->price}}</p>
            <p class="card-text">No. Handphone: {{$udtl->phone}}</p>
            <p class="card-text">Email: {{$udtl->email}}</p>

            <!-- Programming Skills View -->
            <h5 class="card-text">Programming Skills</h5>
                <?php 
                    $pcs = ProgConsultant::where('consultant_id', $udtl->id)
                    ->join('users', 'consultant_id', '=', 'users.id')
                    ->join('programmings', 'prog_id', '=', 'programmings.id')
                    ->get(['consultant_id', 'prog_name']);

                    $i = 0;
                    foreach($pcs as $p){
                        $progArr[$i] = $p->prog_name;
                        $i++;
                    }
                    $progString = implode(", ", $progArr);
                ?>
                <p class="card-text">{{$progString}}</p>

            <!-- Topic Skills View -->
            <h5 class="card-text">Topic Skills</h5>
                <?php 
                    $tcs = TopicConsultant::where('consultant_id', $udtl->id)
                    ->join('users', 'consultant_id', '=', 'users.id')
                    ->join('topics', 'topic_id', '=', 'topics.id')
                    ->get(['consultant_id', 'topic_name']);
                    
                    $i2 = 0;
                    foreach($tcs as $t){
                        $topicArr[$i2] = $t->topic_name;
                        $i2++;
                    }
                    $topicString = implode(", ", $topicArr);
                ?>
                <p class="card-text">{{$topicString}}</p>

            @if(Auth::check())
            <a href="/chatify/{{$udtl->id}}" class="btn btn-primary">Contact</a>
            @else
            <p></p>
            @endif
        </div>
        </div>
    </div>
    </div>
</div>
@else
<p>This Consultant is Suspended</p>

@endif
</x-layout>