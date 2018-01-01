@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Lista znajomych <span class="label label-default">{{$user->friends()->count() }}</span></div>
                    <div class="panel-body">

                        @if($user->friends()->count() === 0)
                            <h4 class="text-center">Brak znajomych</h4>
                        @else

                            <div class="row">
                                @foreach ($user->friends() as $friend)
                                    <div class="col-sm-3 text-center">
                                        <a href="{{ url('/users/' . $friend->id) }}">
                                            <div class="thumbnail">
                                                <img class="img-responsive" src="{{ url('images/user-avatar/' . $friend->id) . '/200' }}" alt="">
                                                <h5>{{ $friend->name }}</h5>
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
