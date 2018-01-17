<div class="col-md-3 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">
            Użytkownik
            @if ($user->id === Auth::id())
                <a href="{{ url('/users/') . '/' . $user->id . '/edit'  }}" class="pull-right"><small>Edytuj</small></a>
            @endif
        </div>

        <div class="panel-body text-center">
            <img class="img-responsive img-thumbnail" src="{{ url('images/user-avatar/' . $user->id) . '/200' }}" alt="">
            <a href="{{ url('/users') . '/' . $user->id }}"><h3>{{ $user->name }}</h3></a>

            <p>

            <p>
                <a href="{{url('/users/' . $user->id . '/gallery')}}">Zdjęcia ({{$user->images->count()}})</a>
            </p>

            @if( $user->sex == 'm')
                Mężczyzna
            @else
                Kobieta
            @endif
            </p>

            <p>
            {{ $user->email }}
            </p>

            <p><a href="{{ url('/users/') . '/' . $user->id . '/friends'  }}">Znajomi</a> <span class="label label-default">{{$user->friends()->count() }}</span></p>

            @if (Auth::check() && $user->id !== Auth::id())

                @if ( ! friendship($user->id)->exists && ! has_friend_invitation($user->id))

                    <form method="POST" action="{{ url('/friends/' . $user->id ) }}">
                        {{ csrf_field() }}
                        <button class="btn btn-success">Zaproś do znajomych</button>
                    </form>

                @elseif (has_friend_invitation($user->id))

                    <form method="POST" action="{{ url('/friends/' . $user->id ) }}">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <button class="btn btn-primary">Przyjmij zaproszenie</button>
                    </form>

                @elseif (friendship($user->id)->exists && ! friendship($user->id)->accepted)

                    <button class="btn btn-success disabled">Zaprosznie wysłane</button>

                @elseif (friendship($user->id)->exists && friendship($user->id)->accepted)

                    <form method="POST" action="{{ url('/friends/' . $user->id ) }}">
                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}
                        <button class="btn btn-danger">Usuń ze znajomych</button>
                    </form>

                @endif


            @endif

            @if($user->phone)
                <p>
                    {{ $user->birth }}
                </p>
            @endif

            @if($user->phone)
            <p>
                <a href="tel:{{ $user->phone }}">{{ $user->phone }}</a>
            </p>
            @endif

            @if($user->phone)
                <p>
                    {{ $user->city }}
                </p>
            @endif

            @if($user->website)
                <p>
                    {{ $user->city }}
                </p>
            @endif

        </div>
    </div>
</div>