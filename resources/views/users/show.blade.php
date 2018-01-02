@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row users-show">

            <!-- Include layout sidebar -->
            @include('layouts.sidebar')

            <div class="col-md-7">
                @if(Auth::check() && $user->id === Auth::id())
                <div class="panel panel-default">
                    <div class="panel-body">

                        @include('posts.create')

                    </div>
                </div>
                @endif
            </div>

            <div class="col-md-7">

                @if ($posts->count() < 1)
                    <h4>Brak postów</h4>
                    @endif

            @foreach($posts as $post)
                @include('posts.single')
            @endforeach

                {{ $posts->links() }}

            </div>

        </div>
    </div>
@endsection
