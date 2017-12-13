@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row users-show">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Wyniki wyszukiwania:
                    </div>
                    <div class="panel-body">
                        @if($search_results->count() === 0)
                            <h4 class="text-center">Brak wyników</h4>
                        @else

                            <div class="row">

                            @foreach($search_results as $user)
                                <div class="col-sm-3 text-center">
                                    <a href="{{url('/users/' . $user->id )}}">
                                        <div class="thumbnail">
                                            <img class="img-responsive img-thumbnail" src="{{ url('images/user-avatar/' . $user->id) . '/200' }}" alt="">
                                            <h6>{{$user->name}}</h6>
                                        </div>
                                    </a>
                                </div>
                            @endforeach

                            </div>

                                <div class="text-center">
                                    {{ $search_results->links() }}
                                </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
