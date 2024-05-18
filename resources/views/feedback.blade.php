<x-layout>
    <h4>Feedback Consultation Page</h4>
    @if($avgRating > 0)
        <h5>Rating          : {{ round($avgRating,2) }}</h5>
        <h5>Total Users Helped   : {{ $countRating }}</h5>
        @foreach($feedbacks as $f)
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">{{$f->user_id}}</h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{$f->title}}</h6>
                    <p class="card-text">Rating: {{$f->rating}}</p>
                    <p class="card-text">Comment: {{$f->comment}}</p>
                </div>
            </div>
        @endforeach
        <div class="pagination">
            {{ $feedbacks->links() }}
        </div>
    @else
        <p>No ratings found.</p>
    @endif
</x-layout>