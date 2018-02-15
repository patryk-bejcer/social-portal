@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row users-edit">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Nowe wydarzenie
                    </div>
                    <div class="panel-body">

                        <form action="{{url('/add-event/')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}



                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">

                                    <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                        <label for="title">Nazwa wydarzenia</label>
                                        <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>


                                        @if ($errors->has('title'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('title') }}</strong>
                                            </span>
                                        @endif

                                    </div>


                                    <div class="col-md-6 no-padding" style="padding-right: 30px;">
                                        <div class="form-group">
                                            <label for="example-datetime-local-input" class="col-2 col-form-label">Data rozpoczęcia</label>
                                            <div class="col-10">
                                                <input  name="start_date" class="form-control" type="datetime-local" value="2011-08-19T13:45:00" id="example-datetime-local-input">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 no-padding">
                                        <div class="form-group">
                                            <label for="example-datetime-local-input" class="col-2 col-form-label">Data zakończenia</label>
                                            <div class="col-10">
                                                <input name="end_date" class="form-control" type="datetime-local" value="2011-08-19T13:45:00" id="example-datetime-local-input">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 no-padding" style="padding-right: 30px;">
                                        <div class="form-group">
                                            <label for="exampleSelect1">Typ wydarzenia</label>
                                            <select name="visibility" class="form-control" id="exampleSelect1">
                                                <option value="public" default>Publiczne</option>
                                                <option value="private">Prywatne</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-8 no-padding">
                                        <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                            <label for="title">Strona WWW wydarzenia</label>
                                            <input name="website" id="title" type="url" class="form-control"  value="{{ old('website') }}" required autofocus>


                                            @if ($errors->has('website'))
                                                <span class="help-block">
                                                <strong>{{ $errors->first('website') }}</strong>
                                            </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                        <label for="place">Miejsce</label>
                                        <input id="place" type="text" class="form-control" name="place" value="{{ old('place') }}" required autofocus>


                                        @if ($errors->has('place'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('place') }}</strong>
                                            </span>
                                        @endif

                                    </div>

                                    <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                        <label for="">Zdjęcie wydarzenia</label>
                                        <input name="event_img" type="file" class="form-control" placeholder="Wybierz plik" accept=".jpg,.jpeg" multiple>

                                        @if ($errors->has('event_img'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('event_img') }}</strong>
                                            </span>
                                        @endif

                                    </div>

                                    <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                        <label for="">Opis wydarzenia</label>
                                        <textarea name="description" class="form-control" placeholder="Krótki opis wydarzenia"  style="width: 100%" name="" id="" rows="3"></textarea>


                                        @if ($errors->has('description'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif

                                    </div>


                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <button type="submit" class="btn btn-primary btn-sm pull-right">Utwórz wydarzenie</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
