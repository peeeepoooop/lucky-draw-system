@extends('adminlte::page')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h3>Lucky Draw System</h3>
            <hr>
            <div class="form-group">
                    {!! Form::token() !!}
                    {!! Form::label('prize_types', 'Prize Types:', ['class' => 'col-md-6', 'required']) !!}
                    {!! Form::select('prize_types', [
                        '' => 'please select',
                        '3rd1' => 'third prize - 1st winner',
                        '3rd2' => 'third prize - 2nd winner',
                        '3rd3' => 'third prize - 3rd winner',
                        '2nd1' => 'second prize - 1st winner',
                        '2nd2' => 'second prize - 2nd winner',
                        '1st' => 'first prize',
                        ], '', ['class' => 'form-control', 'id' => 'prize_types', 'required']) !!}

                    {!! Form::label('random_gen', 'Generate Randomly:', ['class' => 'col-md-6']) !!}
                    {!! Form::select('random_gen', [
                        'N' => 'no',
                        'Y' => 'yes',
                        ], 'N', ['class' => 'form-control', 'id' => 'random_gen', 'disabled']) !!}

                    {!! Form::label('lucky_number', 'Winning Number:', ['class' => 'col-md-6', 'required']) !!}
                    {!! Form::text('lucky_number', null, ['class' => 'form-control', 'id' => 'lucky_number']) !!}

                    {!! Form::submit('Draw', ['id' => 'draw']) !!}
            </div>
        </div>
    </div>
@stop
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $('#prize_types').on('change', function () {
            var type = $('#prize_types').val();

            if(type != '1st'){
                $('#random_gen').val('Y');
                $('#random_gen').attr('disabled', true);
            }else{
                $('#random_gen').val('N');
                $('#random_gen').attr('disabled', false);
            }
        })
        $('#draw').on('click', function () {
            var type = $('#prize_types').val();

            $.ajax({
                url: 'machine/draw/',
                type: 'get',
                data: {type: type},
                success: function (data) {
                    $('#lucky_number').val(data);
                    $('#lucky_number').attr("disabled", true);
                }
            })
        });
    });
</script>

