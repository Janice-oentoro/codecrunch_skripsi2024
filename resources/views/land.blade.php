<?php
    use App\Models\ProgConsultant;
    use App\Models\TopicConsultant;
?>
<x-layout>
    @foreach($users as $u)
    <div class="card mb-3" style="max-width: 540px;">
    <div class="row g-0">
        <div class="col-md-4">
        <img src="..." class="img-fluid rounded-start" alt="...">
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