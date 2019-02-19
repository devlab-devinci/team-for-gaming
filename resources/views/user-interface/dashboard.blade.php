@extends('layouts.navbar')

@section('content')
    <div class="row no-gutters">
        <div class="col-12 col-md-10 dashboard-container offset-md-1">
            <div class="card" style="width: 18rem;">
                <div class="card-body dashboard-title">
                    <h5 class="card-title">Mes jeux</h5>
                    <span></span>
                </div>
            </div>
            <div class="row no-gutters">
                @foreach ($userGames as $game)
                    <div class="col-3 user-games" style="text-align: center">
                        <div class="game-icon">
                            <img src="https://cdn.vox-cdn.com/thumbor/B_HpTPdu76tmq2_5YPKqts8XUfY=/75x0:885x540/920x613/filters:focal(75x0:885x540):format(webp)/cdn.vox-cdn.com/uploads/chorus_image/image/34252919/LoL.0.jpg" alt="Mario">
                        </div>
                        <div class="game-title">
                            {{ $game-> name }}
                        </div>
                    </div>
                @endforeach
                <div class="col-1">
                    <button type="button"
                            class="add-game"
                            data-toggle="modal"
                            data-target="#modal"
                            id="open">
                        <i class="fa fa-plus"></i>
                    </button>
                </div>
            </div>
            <div class="modal fade" id="modal"
                 tabindex="-1" role="dialog"
                 aria-labelledby="modalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form action="/create" method="POST" class="form-horizontal">
                            @csrf
                            {{ csrf_field() }}
                            <div class="modal-header">
                                <button type="button" class="close"
                                        data-dismiss="modal"
                                        aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="game">Jeu</label>
                                    <select name="game" class="form-control" id="game" data-dependent="game-level">
                                        <option value="">Sélectionnez un jeu</option>
                                        @foreach ($games as $game)
                                            <option value="{{ $game-> id }}">{{ $game-> name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="pseudo">Pseudo</label>
                                    <input name="pseudo" type="email" class="form-control" id="pseudo" placeholder="Pseudo">
                                </div>
                                <div class="form-group">
                                    <label for="game-level">Niveau de jeu</label>
                                    <select name="game-level" class="form-control" id="game-level" data-dependent="state">
                                        <option>Sélectionnez votre niveau de jeux</option>
                                    </select>
                                </div>
                                <div class="alert alert-danger" style="display:none"></div>
                            </div>
                            <div class="modal-footer">
                        <span class="pull-right">
                          <button id="submit" type="button" class="btn btn-primary">
                            Créer
                          </button>
                        </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {!! $calendar->calendar() !!}
        </div>
    </div>
    <script>
        $(document).ready(function(){
            let game = $('#game');
            let pseudo = $('#pseudo');
            let gameLevel = $('#game-level');
            let submit = $('#submit');

            game.change(function(){
                if($(this).val() != '')
                {
                    let select = $(this).attr("id");
                    let value = $(this).val();
                    let dependent = $(this).data('dependent');
                    let _token = $('input[name="_token"]').val();
                    console.log(select, value, dependent, _token);
                    $.ajax({
                        url:"{{ route('home.game.fetch-game-level') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        method:"POST",
                        data:{ value:value },
                        success:function(result)
                        {
                            $('#game-level').html(result);
                        }
                    })
                }
            });

            game.change(function(){
                $('#game-level').val('');
            });

            submit.click(
                function(e){
                    console.log(game, game.val());
                    e.preventDefault();
                    $.ajax({
                        url: "{{ route('home.game.create') }}",
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            game: game.val(),
                            pseudo: pseudo.val(),
                            gameLevel: gameLevel.val()
                        },
                        success:function(result){
                            if(result.errors)
                            {
                                $('.alert-danger').html('');

                                $.each(result.errors, function(key, value){
                                    jQuery('.alert-danger').show();
                                    jQuery('.alert-danger').append('<li>'+value+'</li>');
                                });
                            }
                            else
                            {
                                jQuery('.alert-danger').hide();
                                $('#open').hide();
                                $('#modal').modal('hide');
                            }
                        }});
                }
            )


        });
    </script>
    {!! $calendar->script() !!}
@endsection