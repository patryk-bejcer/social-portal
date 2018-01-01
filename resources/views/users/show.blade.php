@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row users-show">

            <!-- Include layout sidebar -->
            @include('layouts.sidebar')

            <div class="col-md-7">
                <div class="panel panel-default">
                    <div class="panel-body">

                        @include('posts.create')

                    </div>
                </div>
            </div>

            <div class="col-md-7">
            @foreach($posts as $post)
                @include('posts.show')
            @endforeach
            </div>

        </div>
    </div>
@endsection
