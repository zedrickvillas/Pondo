@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>

    {!! Form::open(['action' => 'PostsController@store', 'method' => 'POST', 'files' => true]) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text ('title', '', ['class'=>'form-control', 'placeholder'=> 'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body', 'Description')}}
        {{Form::textarea('body', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Description here'])}}
    </div>


    <div class="form-group">
        {{Form::label('body', 'Quantity:')}}
        {{Form::text ('quantity', '' )}}
    </div>

    <div class="form-group">
        {{Form::label('body', 'Price per quantity (PHP):')}}
        {{Form::text ('price', '' )}}
    </div>
    <div class="form-group">
        {{Form::label('featured_image', 'Upload Featured Image')}}
        {{Form::file('featured_image')}}
    </div>


    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection
