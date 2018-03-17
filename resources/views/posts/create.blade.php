@extends('layouts.app')

@section('content')
    <h1>Create Post</h1>

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


    <div class="form-group">
        {{Form::label('quantity', 'Quantity:')}}
        {{Form::text ('quantity', '' )}}
        @if ($errors->has('quantity'))
            <span class="text-danger">
                <strong>{{ $errors->first('quantity') }}</strong>
            </span>
        @endif
    </div>

    <div class="form-group">
        {{Form::label('price', 'Price per quantity (PHP):')}}
        {{Form::text ('price', '' )}}
        @if ($errors->has('price'))
            <span class="text-danger">
                <strong>{{ $errors->first('price') }}</strong>
            </span>
        @endif
    </div>
    <div class="form-group">
        {{Form::label('featured_image', 'Upload Featured Image')}}
        {{Form::file('featured_image')}}
    </div>


    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}

@endsection
