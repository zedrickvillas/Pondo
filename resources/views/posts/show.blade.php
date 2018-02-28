@extends('layouts.app')

@section('content')
    <h1>{{$post->title}}</h1>
    <small>written on {{$post->created_at}}</small>
    <div>
        {!! $post->body!!}
    </div>
    <div>
        <p>Items left: {{$post->quantity}} </p>
        <p>Item Price: {{$post->price}}</p>
    </div>
@endsection
