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
            @endif

            <div class="comments-app">
                <h1>Comments</h1> 
                <!--
                <div class="comment-form">
                    <div class="comment-avatar"><img src="storage/commentbox.png"></div> 
                    <form name="form" class="form">
                        <div class="form-row">
                            <textarea placeholder="Add comment..." required="required" class="input"></textarea> 
                        </div> 

                        <div class="form-row"><input placeholder="Email" type="text" disabled="disabled" class="input"></div> 

                        <div class="form-row"><input type="button" value="Add Comment" class="btn btn-success"></div>

                    </form>
                </div> 
                -->

                <div class="comments">
                    @foreach ($post->comments as $comment)
                        <div class="comment"><div class="comment-avatar"><img src="{{ $comment->user->profile->avatar }}"></div> 
                            <div class="comment-box">
                                <div class="comment-text">{{ $comment->body }}</div> 
                                <div class="comment-footer">
                                    <div class="comment-info">
                                        <span class="comment-author"><em>{{ $comment->user->name }}</em></span> 
                                        <span class="comment-date">{{ $comment->created_at->diffForHumans() }}</span>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    @endforeach    
                </div>
            </div>

        </div>
    </div>
@endsection
