@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row users-show">
            <div class="col-md-8 col-md-offset-2">
                @include('posts.single')
            </div>
        </div>
    </div>
@endsection
