@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row users-edit">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Dodawanie zdjęć do galerii
                    </div>
                    <div class="panel-body">

                        <form action="{{url('/users/'. $user->id .'/gallery/')}}" method="POST" enctype="multipart/form-data">
                            {{ csrf_field() }}


                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <div class="form-group{{ $errors->has('avatar') ? ' has-error' : '' }}">
                                        <label for="">Zdjęcia</label>
                                        <input name="images[]" type="file" class="form-control" placeholder="Wybierz plik" accept=".jpg,.jpeg" multiple>

                                        @if ($errors->has('primaryImage'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('primaryImage') }}</strong>
                                            </span>
                                        @endif

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <button type="submit" class="btn btn-primary btn-sm pull-right">Dodaj</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
