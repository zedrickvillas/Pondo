@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    {!! Form::open(['action' => ['PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group">
            {{Form::label('title', 'Title')}}
            {{Form::text('title', $post->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
        </div>
        <div class="form-group">
            {{Form::label('body', 'Body')}}
            {{Form::textarea('body', $post->body, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Body Text'])}}
        </div>

        <div class="form-group">
            {{Form::label('quantity', 'Quantity:')}}
            {{Form::text ('quantity', $post->quantity )}}
        </div>

        <div class="form-group">
            {{Form::label('price', 'Price per quantity (PHP):')}}
            {{Form::text ('price', $post->price )}}
        </div>

        <div class="form-group">
            {{Form::label('update_msg', 'Update Message:')}}
            {{Form::textarea ('update_msg', '', ['class' => 'form-control', 'placeholder' => "What's New?"] )}}
        </div>


        {{Form::hidden('_method','PUT')}}
        {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection