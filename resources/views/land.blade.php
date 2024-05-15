<?php
    use App\Models\ProgConsultant;
    use App\Models\TopicConsultant;
    use App\Models\Programming;
    use App\Models\Topic;
    $progs = Programming::all();    
    $topics = Topic::all();
?>
@php
    use App\Http\Controllers\AuthController;
    use Illuminate\Support\Str;
@endphp

<x-layout>
    <form action="" class="" method="GET">
        <!-- Search -->
        <div class="row">
            <div class="col-md-3">    
                <label for="search">Search</label>
                <input type="text" name="search" id="search" class="form-control" aria-describedby="helpId" value="{{$search}}">
            </div>

            <div class="col-md-3">
                <br>
                <button class="btn btn-primary">Search</button>
                <a href="/" class="btn btn-primary">Reset</a>
            </div>
        </div>
    </form>

    <form action="" class="" method="GET">
        <div class="row">
        <!-- Filter Programming -->
            <div class="col-md-3">
                <label for="filter">Programming</label>
                <select name="filterprog" id="filterprog" class="form-select">
                    <option value="">Select Programming</option>
                    @foreach($progs as $prog)
                        <option value="{{$prog->prog_name}}">{{$prog->prog_name}}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Topic -->
            <div class="col-md-3">
                <label for="filter">Topic</label>
                <select name="filtertopic" id="filtertopic" class="form-select">
                    <option value="">Select Topic</option>
                    @foreach($topics as $topic)
                        <option value="{{$topic->topic_name}}">{{$topic->topic_name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <br>
                <button class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    
    <br>
    @foreach($users as $u)
    @php
        $avatar = AuthController::imageAdapter($u->avatar);
    @endphp
    <div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
            @if($u->avatar != null)
                <img src="{{ asset($avatar) }}" class="img-fluid rounded-circle" alt="...">
            @else
                <img src="{{ asset('/storage/images/def-icon.png') }}" class="img-fluid rounded-circle" alt="...">
            @endif
        </div>
        <div class="col-md-8">
        <div class="card-body">
            <h5 class="card-title">{{$u->name}}</h5>
            <p class="card-text">Rp {{$u->price}}</p>
            <!-- Programming Skills View -->
                <?php 
                    $pcs = ProgConsultant::where('consultant_id', $u->id)
                    ->join('users', 'consultant_id', '=', 'users.id')
                    ->join('programmings', 'prog_id', '=', 'programmings.id')
                    ->get(['consultant_id', 'prog_name']);
                ?>
                
            @foreach($pcs as $p)
                <p class="card-text">{{$p->prog_name}}</p>
            @endforeach
            
            <!-- Topic Skills View -->
                <?php 
                    $tcs = TopicConsultant::where('consultant_id', $u->id)
                    ->join('users', 'consultant_id', '=', 'users.id')
                    ->join('topics', 'topic_id', '=', 'topics.id')
                    ->get(['consultant_id', 'topic_name']);
                ?>
            @foreach($tcs as $t)
                <p class="card-text">{{$t->topic_name}}</p>
            @endforeach

            <a href="/detailconsultant/{{$u->id}}" class="btn btn-warning" name="id">Detail</a>
        </div>
        </div>
    </div>
    </div>
    @endforeach
</x-layout>