@extends('layouts.app')

@section('template_linked_css')
    <link rel="stylesheet" href="{{ asset('css/rating/star-rating.min.css') }}" />


<style>

 #post-featured-image {
    border-radius: 5px;
    cursor: pointer;
    transition: 0.3s;
}

#post-featured-image:hover {opacity: 0.7;}

#gallery-images {
    white-space: nowrap;
    overflow-y: scroll;
    width: 300px;
}

.investment-gallery-image {
    width: 100%;
}

</style>
@endsection

@section('content')
    <div class="panel panel-body">
        <div class="panel-heading">

            @if (Auth::check())
                @if (Auth::user()->hasRole('investor'))
                    <div class="d-flex" style="justify-content: space-between;">
                        <favorite
                            :post={{ $post->id }}
                            :favorited={{ $post->favorited() ? 'true' : 'false'}}
                        ></favorite>

                         <form action="{{route('cart.store')}}" method="POST">
                            {{csrf_field()}}
                            <input type="hidden" name="id" value="{{$post->id}}">
                            <input type="hidden" name="title" value="{{$post->title}}">
                            <input type="hidden" name="price" value="{{$post->price}}">
                            <button type="submit" class="btn btn-success">Add to Cart<i class="fa fa-cart-plus"></i></button>
                        </form>
                    </div>
                @endif
            @endif               

            <div class="d-flex" style="height: 500px;">
                
                <a href="{{ $post->image }}" data-lightbox="featured-image" style="width: 100%">
                    <div id="post-featured-image" data-src="{{ $post->image }}"   style="width: 100%; 
                                                        height: 500px; 
                                                        background-image: url({{ $post->image }});
                                                        background-size: contain;
                                                        background-repeat: no-repeat;
                                                        background-position: center;">
                    
                    </div>
                </a>

                @if (count($post->images) > 0)
                <div class="" id="gallery-images">
                                            @foreach($post->images as $image)
                            <div class="investment-gallery-image p-2" >
                                <a href="{{ $image->image }}" data-lightbox="investment">
                                    <div class="g-image"  style="background-image: url({{ $image->image }});"></div>
                                </a>
                            </div>
                        @endforeach
                    
                </div>
                @endif

            </div>

            
            <h1>{{$post->title}}</h1>

            <div class="rating">
                    <input id="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $post->averageRating }}" data-size="xs"> 
                    <small>({{ $post->countRating() }})
                        @if ($post->countRating() > 1)
                            Ratings
                        @else
                            Rating
                        @endif
                    </small>
            </div>

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
                <p>Projected ROI per Quantity: {{$post->roi}}%</p>
                <p>Projected Return after Investment: {{($post->roi * ($post->price/100))+$post->price}}</p>

            </div>
            <hr>
            <H3> Share To</H3>
            {!! Share::page(url()->current())->facebook()!!}
            {!! Share::page(url()->current(), 'Share to TWITTER')->twitter();!!}




            @if(Auth::check())
                @if(Auth::user()->id == $post->user_id)
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>

                    {!!Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {!!Form::close()!!}
                @endif
            @endif

            <!--Messaging-->
            @if (Auth::check())
                @if(Auth::user()->hasRole('investor'))

                    <div class="d-flex" style="justify-content: flex-end;">     
                        <a href="{{ route('messages.create', ['user' => $post->user, 'investment' => $post])  }}" class="btn btn-info">
                            Message Business Owner
                            <i aria-hidden="true" class="fa fa-envelope"></i>
                        </a>
                    </div>
           
                @endif
            @endif

            <div class="comments-app">
                <h1>Reviews</h1>
                @if (Auth::check())
                    @if(Auth::User()->hasRole('investor'))
                        @if ( !$post->isRatedBy(Auth::User()->id) )
                            <div class="comment-form">
                                <div class="comment-avatar"><img src="{{ Auth::user()->profile->avatar }}"></div> 
                                <form name="form" class="form" method="POST" action="{{ route('comments.store') }}">
                                    {{ csrf_field() }}
                                    <div class="form-row">
                                        <textarea name="comment" placeholder="Add comment..." required="required" class="input"></textarea> 
                                    </div> 
                                    <div class="form-row">
                                        <div class="rating">

                                            <input id="input-1" name="rate" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="" data-size="xs">           
                                             
                                            @if ($errors->has('rate'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('rate') }}</strong>
                                                </span>
                                            @endif

                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <input placeholder="{{ Auth::user()->name }}" type="text" disabled="disabled" class="input">
                                    </div> 

                                    <input type="hidden" name="post_id" required="" value="{{ $post->id }}">

                                    <input type="hidden" name="user_id" required="" value="{{ Auth::user()->id }}">

                                    <div class="form-row">
                                        <input type="submit" value="Submit Review" class="btn btn-success">
                                    </div>

                                </form>
                            </div>
                        @endif                   
                    @endif
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
                    @if (count($post->comments) >= 1)
                        @foreach ($post->comments as $comment)
                        <div class="comment"><div class="comment-avatar"><img src="{{ $comment->user->profile->avatar }}"></div> 
                            <div class="comment-box">
                                <div class="rating">
                                    <input class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $comment->post->averageRatingForUser($comment->user_id) }}" data-size="xs">           
                                </div>
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
                    @else
                        <p>No review yet.</p>
                    @endif   

                </div>
            </div>

        </div>
    </div>
@endsection

@section('footer_scripts')
    <script src="{{ asset('js/rating/star-rating.min.js') }}"></script>
@endsection