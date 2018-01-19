@extends('layouts.app')


@section('content')
    <div class="container">

        <div class="col-md-12">
            <div class="panel panel-default">

                <div class="panel-heading">

                    <script>
                        $(document).ready(function(e){
                            $(".img-check").click(function(){
                                $(this).toggleClass("check");
                                if($( ".img-check" ).hasClass( "check" )){
                                    $(".remove-selected-btn").addClass("display-block");
                                }
                            });
                        });

                        $(document).on('click', '.remove-selected-btn', function(e) {
                            $("#submit-btn").trigger('click');
                        });
                    </script>

                    @if (belongs_to_auth($user->id) || is_admin())

                        <button class="btn btn-danger pull-right remove-selected-btn">
                            <i class="fa fa-trash mr-2" aria-hidden="true"></i>
                            Usuń zaznaczone</button>
                        <a href="{{ url('/users') . '/' . $user->id . '/gallery/create'}}" class="btn btn-success pull-right" style="margin-right:5px"><i class="fa fa-plus mr-2" aria-hidden="true"></i>Dodaj zdjęcia</a>
                        <a href="{{ url('/users') . '/' . $user->id . '/gallery'}}" class="btn btn-primary pull-right mr-1"><i class="fa fa-chevron-left mr-2" aria-hidden="true"></i>Powrót do galerii</a>

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
                                                    <input type="checkbox" name="check_img[]" id="check_img" value="{{$image->id}}" class="hidden" autocomplete="off">
                                                </label>
                                            </div>
                                        @endforeach

                                    </div>

                                    <div class="clearfix"></div>
                                <button style="display: none;" type="submit" id="submit-btn" class="btn btn-danger"><i class="fa fa-trash mr-2" aria-hidden="true"></i>
                                    Usuń zaznaczone</button>
                            </form>
                        @else

                            <h4>Aktualnie brak zdjęć</h4>

                        @endif

                    </div>

                </div>

                <div class="text-center">{{ $images->links() }}</div>

            </div>
        </div>



@endsection

