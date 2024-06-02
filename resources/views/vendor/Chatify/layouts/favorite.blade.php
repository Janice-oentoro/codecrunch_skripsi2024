@php
    use App\Http\Controllers\AuthController;
    use Illuminate\Support\Str;
@endphp
<div class="favorite-list-item">
    @if($user)
    @php
        $avatar = AuthController::imageAdapter($user->avatar);
    @endphp
    @if($user->avatar != null)
        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
            style="background-image: url({{url($avatar)}});">
        </div>
        @else
        <div class="avatar av-m"
        style="background-image: url({{url('storage/images/def-icon.png')}});">
        </div>
        @endif
        <p>{{ strlen($user->name) > 5 ? substr($user->name,0,6).'..' : $user->name }}</p>
    @endif
</div>
