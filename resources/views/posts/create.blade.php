@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Create Invesment</h1>
        </div>
        <div class="panel-body"> 

            {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'files' => true]) !!}
            <div class="form-group">
                {{Form::label('title', 'Title')}}
                {{Form::text ('title', '', ['class'=>'form-control', 'placeholder'=> 'Title'])}}
                @if ($errors->has('title'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                {{Form::label('body', 'Description')}}
                {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Description here'])}}
                @if ($errors->has('body'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
            </div>

            <div class="d-flex" style="justify-content: space-between;">
                <div class="form-group" style="flex: 1; margin-right: 5px;">
                    {{Form::label('quantity', 'Quantity:')}}
                    {{Form::text ('quantity', '' , ["class" => "form-control"])}}
                    @if ($errors->has('quantity'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('quantity') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group" style="flex: 1; margin-right: 5px;">
                    {{Form::label('price', 'Price per quantity (PHP):')}}
                    {{Form::text ('price', '' , ["class" => "form-control"])}}
                    @if ($errors->has('price'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('price') }}</strong>
                        </span>
                    @endif
                </div>



                <div class="form-group" style="flex: 1;">
                    {{Form::label('roi', 'Projected ROI per Quantity(%):')}}
                    {{Form::text ('roi', '' , ["class" => "form-control"] )}}
                    @if ($errors->has('roi'))
                        <span class="text-danger">
                            <strong>{{ $errors->first('roi') }}</strong>
                        </span>
                    @endif
                </div>

            </div>
            <div class="form-group">
                {{Form::label('featured_image', 'Upload Featured Image')}}
                {{Form::file('featured_image')}}
                @if ($errors->has('featured_image'))
                    <span class="text-danger">
                        <strong>{{ $errors->first('featured_image') }}</strong>
                    </span>
                @endif
            </div>



            <div id="post-featured-image"  style="width: 100%; 
                                                            background-size: contain;
                                                            background-repeat: no-repeat;
                                                            background-position: center;">
                        
            </div>


            {{Form::submit('Create Invesment', ['class'=>'btn btn-primary mt-2'])}}
            {!! Form::close() !!}

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