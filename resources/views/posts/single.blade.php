
<div class="panel panel-default{{ ($post->trashed()) ? ' trashed' : ''}}">

    <div class="panel-body">

        @if (belongs_to_auth($post->user_id) || is_admin())
            <form class="pull-right" method="POST" action="{{ url('/posts/' . $post->id ) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button onclick="return confirm('Czy na pewno chcesz usunąć post?')" style="background: transparent;margin: 0;padding: 0px;border: 0; padding-left: 5px;" class=""><a href="{{url('/posts/' . $post->id . '/edit')}}"><i class="fa fa-trash" aria-hidden="true"></i></a></button>
            </form>
            <div class="pull-right"><a href="{{url('/posts/' . $post->id . '/edit')}}"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></div>
        @endif



        <div class="clearfix">
            <img style="margin-bottom: 5px;" class="img-responsive img-thumbnail pull-left" src="{{ url('images/user-avatar/' . $post->user->id) . '/50' }}" alt="">
            <div class="pull-left" style="margin-left:8px;">
                <a href="{{url('/users/' . $post->user->id)}}">
                    <strong>{{$post->user->name}}</strong>
                </a> <br>
                <a href="{{url('/posts/' . $post->id)}}" class="text-muted">

                    <small>{{$post->created_at}}</small>
                </a>
            </div>
        </div>

        <div id="post_{{ $post->id }}">
            {{$post->content}}
        </div>

            <hr style="margin: 10px 0;">

            @if (Auth::check() && !$post->trashed())
                @include('posts.include.likes')
            @endif


    </div>

    <div class="panel-footer" style="padding-top:5px;">

        @if (Auth::check() && !$post->trashed())
            @include('comments.create')
        @endif

        @foreach($post->comments as $comment)
            @include('comments.include.single')
        @endforeach

    </div>






</div>
