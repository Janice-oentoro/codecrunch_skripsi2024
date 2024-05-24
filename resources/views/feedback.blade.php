<x-layout>
<div class="ms-5 mt-4">
    <h4>Feedback</h4>
    @if($avgRating > 0)
        <h5 class="my-3">{{ round($avgRating,2) }} <i class="fa-solid fa-star" style="color: #f5d047;"></i></h5>
        <h5 class="mb-3">{{ $countRating }} <i class="fa-solid fa-user"></i></h5>

        <div class="row g-0">
        @foreach($feedbacks as $f)
            <div class="col-md-4 mb-3">
                <div class="card d-block" style="width: 90%;">
                    <div class="card-body">
                        <h5 class="card-title">{{$f->title}}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{$f->name}}</h6>
                        <p class="card-text">Rating: {{$f->rating}}</p>
                        <p class="card-text">Comment: {{$f->comment}}</p>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        
        <div class="mt-5 " style="position:absolute;">
            <div class="pagination">
                {{ $feedbacks->links() }}
            </div>
        </div>
    @else
        <p>No ratings found.</p>
    @endif
</div>
</x-layout>