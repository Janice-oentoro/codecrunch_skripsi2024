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
    <div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
            @if ($udtl->avatar != null) 
                <img src="{{ asset($avatar) }}" class="img-fluid rounded-circle" alt="...">
            @else
                <img src="{{ asset('/storage/images/def-icon.png') }}" class="img-fluid rounded-circle" alt="...">
            @endif
        </div>
        <div class="col-md-8">

        <div class="card-body">
            <h2 class="card-title">{{$udtl->name}}</h2>

            @if($avgRating > 0)
                <h6 class="card-subtitle mb-2 text-muted">Rating: {{ round($avgRating, 2) }}</h6>
                <h6 class="card-subtitle mb-2 text-muted">Helped {{ $countRating }} Users</h6>
            @else
                <h6 class="card-subtitle mb-2 text-muted">No Rating</h6>
                <h6 class="card-subtitle mb-2 text-muted">No Helped Users</h6>
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
                <p class="card-text">Programmings: {{$progString}}</p>

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
                <p class="card-text">Topics: {{$topicString}}</p>

            @if(Auth::check())
            <a href="/chatify" class="btn btn-primary">Contact</a>
            @else
            <p></p>
            @endif
        </div>
        </div>
    </div>
    </div>

@else
<p>This Consultant is Suspended</p>

@endif
</x-layout>