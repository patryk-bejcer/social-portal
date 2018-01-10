@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row users-edit">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Edycja komentarza
                    </div>
                    <div class="panel-body">

                        <form action="{{url('/comments/' . $comment->id)}}" method="POST" >
                            {{ csrf_field() }}
                            {{ method_field('PATCH') }}

                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                                        <label for="">Zawartość komentarza</label>
                                        <input rows="7" name="content" type="text" class="form-control" value="{{$comment->content }}">

                                        @if ($errors->has('content'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('content') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <button type="submit" class="btn btn-primary btn-sm pull-right">Zapisz zmiany</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
