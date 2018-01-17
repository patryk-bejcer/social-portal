@extends('layouts.app')


@section('content')
    <div class="container">

        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">

                    @if (belongs_to_auth($user->id) || is_admin())

                        {{--<a href="{{ url('/users') . '/' . $user->id . '/gallery/create'}}" class="btn btn-danger pull-right"  >Usuń zaznaczone</a>--}}
                        <a href="{{ url('/users') . '/' . $user->id . '/gallery/create'}}" class="btn btn-primary pull-right" style="margin-right:5px">Dodaj zdjęcia</a>

                    @endif

                    <h4>Edycja galerii </h4><small>Aby usunąć zaznacz zdjęcia do usunięcia a następnie kliknij przycisk usuń</small>

                </div>

                <div class="panel-body text-center">

                    <div class="user-gallery">


                        @if($user->images->count() != 0)

                            <form method="POST" action="{{ url('/users/' . $user->id . '/gallery' ) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                <div class="form-group">

                                    @foreach($images as $image)
                                            <div class="col-md-2 no-padding">
                                                <label class="">
                                                    <img class="img-responsive img-check" src="{{ url('images/user-gallery/' . $user->id) . '/' . $image->id . '/350' }}" alt="">
                                                    <input type="checkbox" name="check_img[]" id="item4" value="{{$image->id}}" class="hidden" autocomplete="off">
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>

                                    <div class="clearfix"></div>
                                    <input type="submit" value="Usuń zaznaczone" class="btn btn-danger">
                            </form>

                            <script>
                                $(document).ready(function(e){
                                    $(".img-check").click(function(){
                                        $(this).toggleClass("check");
                                    });
                                });
                            </script>

                        @else

                            <h4>Aktualnie brak zdjęć</h4>

                        @endif

                    </div>

                </div>

                <div class="text-center">{{ $images->links() }}</div>

            </div>
        </div>



@endsection

