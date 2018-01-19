@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row users-show">

            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Powiadomienia
                    </div>
                    <div class="panel-body">
                        @if(Auth::user()->notifications->count() === 0)
                            <h4 class="text-center">Brak powiadomien</h4>
                        @else

                            <ul class="list-group">

                                @foreach(Auth::user()->notifications as $notification)
                                    <li class="list-group-item"  style="{{ ! is_null($notification->read_at) ? 'opacity:.5' : '' }}">
                                        {!!$notification->data['message']!!}

                                        <form action="{{url('/notifications/' . $notification->id)}}" method="POST" class="pull-right">
                                            {{ csrf_field() }}
                                            {{ method_field('PATCH') }}

                                            @if(is_null($notification->read_at))
                                            <button type="submit" class="btn btn-info btn-xs pull-right">Przeczytane</button>
                                            @endif

                                        </form>


                                    </li>
                                @endforeach

                            </ul>

                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
