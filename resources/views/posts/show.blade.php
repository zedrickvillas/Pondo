@extends('layouts.app')

@section('content')
    <div class="panel panel-body">
        <div class="panel-heading"><h1>{{$post->title}}</h1></div>
        <div class="panel-body">
            <small>Written on {{$post->created_at}}</small>
            <p>Written by: <a href="{{ route('business.show', ['business' => $post->user->business->id]) }}">{{ $post->user->business->name }}</a></p>
            <div>
                {!! $post->body!!}
            </div>
            <div>
                <p>Quantity: {{$post->quantity}} </p>
                <p>Price: {{$post->price}}</p>
            </div>


            @if(!Auth::guest())
                @if(Auth::user()->id == $post->user_id)
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>


                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}
                @endif
                    @if(Auth::user()->hasRole('investor') == $post->user_id)
                        <a href="/messages/create" class="btn btn-default"><span class="glyphicon glyphicon-envelope"></span></a></li>
                    @endif

                @endif
        </div>
    </div>
@endsection
