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
                            <a href="{{ url('/add-event') }}" class="btn btn-success btn-sm pull-right" style="margin-top:-3px; margin-right:5px"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Dodaj nowe wydarzenie</a>
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
                                        <div class="col-md-2"><span style="margin-bottom: 6px;" class="badge alert">
                                                {{date('d M', strtotime($event->start_date)) }}
                                            </span>
                                        </div>
                                        <div class="col-md-7 no-padding">

                                            <b><h4 style="margin-top:2px; margin-bottom: 2px;"><b>{{$event->title}}</b></h4></b>
                                            <small>
                                                {{$event->start_date}} -
                                                {{$event->end_date}} w
                                                <b>{{$event->place}}</b>
                                            </small>
                                        </div>
                                        <div class="col-md-3"><div style="margin-top:5px;" class="">


                                                @if(!has_user_attendance_event($event->id))

                                                    <form action="{{url('/events/' . $event->id . '/taking-part-event')}}" method="POST" enctype="multipart/form-data">
                                                        {{ csrf_field() }}

                                                        <input name="event_id" type="hidden" value="{{$event->id}}">
                                                        <input name="user_id" type="hidden" value="{{Auth::id()}}">

                                                        <input style="margin-top:1px;" class="btn btn-default pull-right btn-sm" type="submit" value="Weź udział" >

                                                    </form>

                                                @else

                                                    <form action="{{url('/events/not-taking-part-event')}}" method="POST" enctype="multipart/form-data">
                                                        {{ csrf_field() }}

                                                        <input name="event_id" type="hidden" value="{{$event->id}}">
                                                        <input name="user_id" type="hidden" value="{{Auth::id()}}">

                                                        <input style="margin-top:1px;" class="btn btn-default pull-right btn-sm" type="submit" value="Nie wezmę udziału" >

                                                    </form>

                                                @endif



                                            </div></div>
                                        <hr>
                                        <div class="col-md-12">
                                            <p style="font-size: 13px; margin-bottom: 0">{{$event->description}}</p>
                                            <p class="pull-right">
                                                <small>Dodano przez:
                                                    <b>
                                                        <a href="{{url('/users/' . $event->user_id)}}">{{$event->user->name}} </a>
                                                    </b>
                                                </small>
                                            </p>
                                        </div>
                                        <div class="col-md-12">
                                            @if($event->attendance->count())
                                                <h6 style="margin-top:0"><b>Wezmą udział:</b></h6>
                                            @else
                                                <h6 style="margin-top:0"><b>Jeszcze nikt nie bierze udziału</b></h6>
                                            @endif
                                            @foreach($event->attendance as $attendance)
                                                <div class="col-md-1 no-padding" style="padding:3px;">
                                                    <a href="{{url('/users/' . $attendance->user->id)}}">
                                                        <img style="padding:1px" class="img-responsive" src="{{ url('images/user-avatar/' . $attendance->user->id ) . '/200' }}" alt="" title="{{$attendance->user->name}}">
                                                    </a>
                                                </div>
                                            @endforeach
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
