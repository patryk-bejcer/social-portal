@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row users-show">
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
                        @if( $user->sex == 'm')
                            Mężczyzna
                        @else
                            Kobieta
                        @endif

                        {{ $user->email }}
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-body">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam autem, deserunt dolorum explicabo illo libero quidem. Facilis inventore mollitia sequi! Eveniet exercitationem fugit laudantium magni minus nulla porro similique sunt. Accusantium animi cum in laborum maiores numquam temporibus, totam voluptate.
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
