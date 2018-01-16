
@if(Auth::check())

    @if(! Auth::user()->likes->contains('comment_id', $comment->id) )
        <form method="POST" action="{{url('/likes')}}">
            {{ csrf_field() }}
            <input type="hidden" name="comment_id" value="{{$comment->id}}">
            <input type="hidden" name="like_type" value="comment">
            <button type="submit" class="btn btn-primary btn-xs like-btn">
                <span>Lubię to </span>
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                <span class="label label-info">{{ ($comment->likes->count() == 0) ? '' : $comment->likes->count() }}</span>
            </button>
        </form>

    @else

        <form method="POST" action="{{url('/likes')}}">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="hidden" name="comment_id" value="{{$comment->id}}">
            <input type="hidden" name="like_type" value="comment">
            <button type="submit" class="btn btn-primary btn-xs like-btn">
                <span>Nie lubię </span>
                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                <span class="label label-info">{{ ($comment->likes->count() == 0) ? '' : $comment->likes->count() }}</span>
            </button>
        </form>

    @endif

@endif