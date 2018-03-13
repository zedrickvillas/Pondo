@extends('layouts.app')

@section('template_linked_css')
    <link rel="stylesheet" href="{{ asset('css/rating/star-rating.min.css') }}" />
@endsection

@section('content')
    <div class="panel panel-body">
        <div class="panel-heading"><h1>{{$post->title}}</h1>

            <form action="{{ route('rate.post') }}" method="POST">

                {{ csrf_field() }}

                <div class="rating">

                    <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $post->averageRating }}" data-size="xs"> 
                    <small>{{ $post->countRating() }}
                        @if ($post->countRating() > 1)
                            raters
                        @else
                            rater
                        @endif
                    <br/>

                    <input type="hidden" name="business_id" required="" value="{{ $post->id }}">
                    
                                        
                    @if (Auth::User())

                        @if ( !$post->isRatedBy(Auth::User()->id) )
                            <button class="btn btn-success">Submit Rate</button>
                        @endif

                    @endif
                                        

                </div>

            </form>
        </div>
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
                @if(!Auth::guest())
                    <div class="comment-form">
                        <div class="comment-avatar"><img src="{{ Auth::user()->profile->avatar }}"></div> 
                        <form name="form" class="form" method="POST" action="{{ route('comments.store') }}">
                            {{ csrf_field() }}
                            <div class="form-row">
                                <textarea name="comment" placeholder="Add comment..." required="required" class="input"></textarea> 
                            </div> 

                            <div class="form-row">
                                <input placeholder="{{ Auth::user()->name }}" type="text" disabled="disabled" class="input">
                            </div> 

                            <input type="hidden" name="post_id" required="" value="{{ $post->id }}">

                            <input type="hidden" name="user_id" required="" value="{{ Auth::user()->id }}">

                            <div class="form-row">
                                <input type="submit" value="Add Comment" class="btn btn-success">
                            </div>

                        </form>
                    </div>

                @else
                    <div class="comment-form">
                        <div class="comment-avatar"><img src="{{ asset('images/smile.png') }}"></div> 
                        <form name="form" class="form">
                            <div class="form-row">
                                <a href="{{ route('login') }}">
                                    <textarea name="comment" placeholder="Add comment..." required="required" class="input"></textarea> 
                                </a>
                            </div> 
                        </form>
                    </div>

                @endif

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

                                    @if(!Auth::guest())
                                        @if(Auth::user()->id == $comment->user_id)                    
                                            {!!Form::open(['action' => ['CommentController@destroy', $comment->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                                            {{Form::hidden('_method', 'DELETE')}}
                                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                                            {!!Form::close()!!}
                                        @endif
                                    @endif

                                </div>
                            </div>
                        </div>
                    @endforeach    
                </div>
            </div>

        </div>
    </div>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/rating/star-rating.min.js') }}"></script>
@endsection