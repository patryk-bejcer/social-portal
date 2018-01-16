
@if(Auth::check())

    @if(! Auth::user()->likes->contains('post_id', $post->id) )
    <form method="POST" action="{{url('/likes')}}">
        {{ csrf_field() }}
        <input type="hidden" name="post_id" value="{{$post->id}}">
        <input type="hidden" name="like_type" value="post">
        <button type="submit" class="btn btn-primary btn-xs like-btn">
            <span>Lubię to </span>
            <i class="fa fa-thumbs-up" aria-hidden="true"></i>
            <span class="label label-info">{{ ($post->likes->count() == 0) ? '' : $post->likes->count() }}</span>
        </button>
    </form>

    @else

        <form method="POST" action="{{url('/likes')}}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="hidden" name="post_id" value="{{$post->id}}">
            <input type="hidden" name="like_type" value="post">
            <button type="submit" class="btn btn-primary btn-xs like-btn">
                <span>Nie lubię </span>
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                <span class="label label-info">{{ ($post->likes->count() == 0) ? '' : $post->likes->count() }}</span>
            </button>
        </form>

    @endif

@endif