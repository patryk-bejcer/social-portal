
<div class="panel panel-default">

    <div class="panel-body">

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
    </div>
</div>
