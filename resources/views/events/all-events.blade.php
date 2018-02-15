@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row users-show">

            <!-- Include layout sidebar -->
            @include('layouts.sidebar')

            <div class="col-md-7 ">
                @if(Auth::check())
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Najbliższe wydarzenia
                            <a href="{{ url('/users') . '/' . $user->id . '/gallery/create'}}" class="btn btn-success btn-sm pull-right" style="margin-top:-3px; margin-right:5px"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Dodaj nowe wydarzenie</a>
                        </div>
                        <div class="panel-body">
                            @foreach($events as $event)
                                <div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <img class="img-responsive" src="http://www.tcogflga.org/wp-content/uploads/2018/01/Univen-UpcomingEventsBanner.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-2"><span style="margin-bottom: 6px;" class="badge alert">16 LUT</span></div>
                                        <div class="col-md-7 no-padding">
                                            <b><h4 style="margin-top:2px; margin-bottom: 2px;"><b>{{$event->title}}</b></h4></b>
                                            <small>{{$event->start_date}} - {{$event->end_date}} w <b>{{$event->place}}</b></small>
                                        </div>
                                        <div class="col-md-3"><div style="margin-top:5px;" class="btn btn-default pull-right">Weź udział</div></div>
                                        <hr>
                                        <div class="col-md-12">
                                            <p style="font-size: 13px; margin-bottom: 0">{{$event->description}}</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>


        </div>
    </div>
@endsection
