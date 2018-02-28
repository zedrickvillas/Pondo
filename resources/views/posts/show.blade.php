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


    @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
            <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

            {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!!Form::close()!!}
        @endif
    @endif
@endsection
