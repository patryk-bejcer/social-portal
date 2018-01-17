@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row users-show">

            <!-- Include layout sidebar -->
            @include('layouts.sidebar')

            <div class="col-md-6 ">
                @if(Auth::check())
                    <div class="panel panel-default">
                        <div class="panel-body">

                            @include('posts.create')

                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-6 ">

                @foreach($posts as $post)
                    @include('posts.single')
                @endforeach

                <div class="text-center">{{ $posts->links() }}</div>


            </div>

        </div>
    </div>
@endsection
