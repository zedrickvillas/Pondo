@extends('layouts.app')

@section('content')

<div class="row">
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}  
    <div class="panel panel-default">
        <div class="panel-heading">
            <h1>Edit Invesment</h1>
        </div>
        <div class="panel-body">

            <div class="col-md-8">
                
                    <div class="form-group">
                        {{Form::label('title', 'Title')}}
                        {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
                    </div>
                    <div class="form-group">
                        {{Form::label('body', 'Body')}}
                        {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
                    </div>

                    <div class="d-flex" style="justify-content: space-between;">
                        <div class="form-group" style="flex: 1; margin-right: 5px;">
                            {{Form::label('quantity', 'Quantity:')}}
                            {{Form::text ('quantity', $post->quantity , ["class" => "form-control"])}}
                        </div>

                        <div class="form-group" style="flex: 1;">
                            {{Form::label('price', 'Price per quantity (PHP):')}}
                            {{Form::text ('price', $post->price, ["class" => "form-control"])}}
                        </div>
                    </div>

                    

                    {{ Form::label('featured_image' , 'Update Featured Image:') }}
                    {{ Form::file('featured_image') }}

                    <div id="post-featured-image" data-src="{{ $post->image }}"   style="width: 100%; 
                                                            height: 500px; 
                                                            background-image: url({{ $post->image }});
                                                            background-size: contain;
                                                            background-repeat: no-repeat;
                                                            background-position: center;">
                        
                    </div>

                    

          
            </div>
            <div class="col-md-4">

                <div class="form-group">
                        {{Form::label('update_msg', 'Update Message:')}}
                        {{Form::textarea ('update_msg', '', ['class' => 'form-control', 'placeholder' => "What's New?"] )}}
                </div>

                <div class="well">
                    <div class="form-group">
                        <label class="form-label">Created At:</label>
                        <div class="form-control" disabled>{{ date('M j, Y h:ia', strtotime( $post->created_at )) }}</div>
                    </div>
                        
                    <div class="form-group">
                        <label class="form-label">Last Updated:</label>
                        <div class="form-control" disabled>{{ date('M j, Y h:ia', strtotime( $post->updated_at )) }}</div>
                    </div>

                    
                    <hr>
                    <div class="d-flex" style="justify-content: space-between;">
                        <input type="button" value="Cancel" class="btn btn-danger" onclick="window.history.back()" /> 
                        {{Form::submit('Save Changes', ['class'=>'btn btn-success'])}}
                    </div>
                   
                </div>
            </div>

        </div>
    </div>

    {{Form::hidden('_method','PUT')}}
    {!! Form::close() !!}     
</div>

@endsection

@section("footer_scripts")
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#post-featured-image').css("background-image", "url("+e.target.result+")");
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#featured_image").change(function(){
        readURL(this);
    });
</script>
@endsection