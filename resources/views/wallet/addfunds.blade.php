@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <h3>500</h3>
                    <p>Lorem ipsum dolor..</p>
                    {{Form::submit('Add Funds', ['class'=>'btn btn-success mt-3'])}}
                    {!! Form::close() !!}
                </div>
                <div class="col-sm-4">
                    <h3>1000</h3>
                    <p>Lorem ipsum dolor..</p>
                    {{Form::submit('Add Funds', ['class'=>'btn btn-success mt-3'])}}
                    {!! Form::close() !!}
                </div>
                <div class="col-sm-4">
                    <h3>5000</h3>
                    <p>Lorem ipsum dolor..</p>
                    {{Form::submit('Add Funds', ['class'=>'btn btn-success mt-3'])}}
                    {!! Form::close() !!}
                </div>

            </div>

        </div>

        <hr>
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <div class="form-group">
                        {{Form::label('title', 'Other Denomination')}}
                        {{Form::text ('title', '', ['class'=>'form-control', 'placeholder'=> 'Amount'])}}
                        @if ($errors->has('title'))
                            <span class="text-danger">
                                    <strong>{{ $errors->first('title') }}</strong>
                                </span>
                        @endif
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


@section("footer_scripts")
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#post-featured-image').css({
                        "height" : "500px",
                        "background-image" : "url("+e.target.result+")",
                    });
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#featured_image").change(function(){
            readURL(this);
        });
    </script>
@endsection