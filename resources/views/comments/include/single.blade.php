

<div class="row" id="comment_{{ $comment->id }}">


    <div class="col-md-1" style="padding-right: 0;">
        <img alt="Profil" title="Profil" style="padding:1px; margin-top: 5px" class="img-responsive img-circle" src="{{ url('images/user-avatar/' . $comment->user_id . '/65') }}" alt="">
    </div>

    <div class="col-md-11" >
        @if (Auth::check() && Auth::id() === $comment->user_id || Auth::user()->role->type === 'admin')
            <form class="pull-right" method="POST" action="{{ url('/comments/' . $comment->id ) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button onclick="return confirm('Czy na pewno chcesz usunąć komentarz?')" style="background: transparent;margin: 0;padding: 0px;border: 0; padding-left: 5px;" class=""><a href="{{url('/comments/' . $comment->id . '/edit')}}"><i class="fa fa-trash" aria-hidden="true"></i></a></button>
            </form>
            <div class="pull-right"><a href="{{url('/comments/' . $comment->id . '/edit')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
        @endif
        <a href="{{url('/users/' . $comment->user->id)}}">{{$comment->user->name}}</a>
        <small>{{$comment->created_at}}</small>
        <p>{{$comment->content}}</p>
    </div>
</div>
<hr style="margin-top: 0px; margin-bottom: 8px;">