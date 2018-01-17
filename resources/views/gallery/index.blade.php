@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading">

                    @if (belongs_to_auth($user->id) || is_admin())
                    <a href="{{ url('/users') . '/' . $user->id . '/gallery/create'}}" class="btn btn-primary pull-right">Dodaj zdjęcia</a>
                    @endif

                    <h4>Galeria użytkownika <a href="{{ url('/users') . '/' . $user->id }}">{{$user->name}}</a> ({{$user->images->count()}})</h4>



                </div>

                <div class="panel-body text-center">

                    <div class="user-gallery">

                    @if($user->images->count() != 0)

                        @foreach($user->images as $image)

                            <div class="col-md-2 no-padding">
                                <a href="{{ url('images/user-gallery/' . $user->id) . '/' . $image->id . '/1000' }}">
                                    <img class="img-responsive" src="{{ url('images/user-gallery/' . $user->id) . '/' . $image->id . '/150' }}" alt="">
                                </a>
                            </div>

                        @endforeach

                    @else

                        <h4>Aktualnie brak zdjęć</h4>

                    @endif

                    </div>

                </div>
            </div>
        </div>






@endsection

