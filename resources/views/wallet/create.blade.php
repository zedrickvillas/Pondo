@extends('layouts.app')

@section('content')
    {!! Form::open(['action' => 'WalletController@store', 'method' => 'POST']) !!}
    <div class="panel panel-default">
        <div class="container">
            <p></p>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        {{Form::label('title', 'Desired Denomination')}}
                        {{Form::text ('denomination', '', ['class'=>'form-control', 'placeholder'=> 'Amount'])}}
                    </div>
                </div>

                <div class="col-sm-2">
                    {{Form::submit('Add Funds', ['class'=>'btn btn-success mt-3'])}}
    {!! Form::close() !!}

                </div>
            </div>
        </div>


    </div>



@endsection


