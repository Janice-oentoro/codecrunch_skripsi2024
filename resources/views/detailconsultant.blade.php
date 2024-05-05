<?php
    use App\Models\ProgConsultant;
    use App\Models\TopicConsultant;
?>
@php
    use App\Http\Controllers\AuthController;
    use Illuminate\Support\Str;
@endphp
<x-layout>
@php
    $image = AuthController::imageAdapter($udtl->image);
@endphp
    <div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
            @if ($udtl->image != null) 
                <img src="{{ asset($image) }}" class="img-fluid rounded-circle" alt="...">
            @else
                <img src="{{ asset('/storage/images/def-icon.png') }}" class="img-fluid rounded-circle" alt="...">
            @endif
        </div>
        <div class="col-md-8">

        <div class="card-body">
            <h2 class="card-title">{{$udtl->name}}</h2>
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
                ?>
            @foreach($pcs as $p)
                <p class="card-text">{{$p->prog_name}}</p>
            @endforeach

            <!-- Topic Skills View -->
            <h5 class="card-text">Topic Skills</h5>
                <?php 
                    $tcs = TopicConsultant::where('consultant_id', $udtl->id)
                    ->join('users', 'consultant_id', '=', 'users.id')
                    ->join('topics', 'topic_id', '=', 'topics.id')
                    ->get(['consultant_id', 'topic_name']);
                ?>
            @foreach($tcs as $t)
                <p class="card-text">{{$t->topic_name}}</p>
            @endforeach

            @if(Auth::check())
            <a href="#Chat" class="btn btn-primary">Contact</a>
            @else
            <p></p>
            @endif
        </div>
        </div>
    </div>
    </div>
</x-layout>