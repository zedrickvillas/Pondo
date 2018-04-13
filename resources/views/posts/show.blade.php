@extends('layouts.app')

@section('template_linked_css')
    <link rel="stylesheet" href="{{ asset('css/rating/star-rating.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/post.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}" />
@endsection

@section('no-container-content-top')
    @include('partials.hero')
@endsection

@section('content')

    <div class="post-section top d-flex sm-flex-direction-column">


        <div class="section-item image">

            <a class="p-1" id="featured-image" href="{{ $post->image }}" data-lightbox="featured-image">
                <div id="post-featured-image" data-src="{{ $post->image }}"   style="
                                                        background-image: url({{ $post->image }});
                                                        background-size: contain;
                                                        background-repeat: no-repeat;
                                                        background-position: center;">
                    
                </div>
            </a>

            @if (count($post->images) > 0)
                <div class="" id="gallery-images">
                        @foreach($post->images as $image)
                            <div class="investment-gallery-image p-1" >
                                <a href="{{ $image->image }}" data-lightbox="investment">
                                    <div class="g-image"  style="background-image: url({{ $image->image }});"></div>
                                </a>
                            </div>
                        @endforeach

                </div>
            @endif

        </div>



        <div class="section-item info">
            <!--Title, Price , Qty ,Ratings, Likes, Cart, Share-->
            <div class="d-flex" style="justify-content: space-between;">
                <h1 class="wordwrap no-margin">{{$post->title}}</h1>
                <div id="likes">
                    <favorite
                            :post={{ $post->id }}
                            :favorited={{ $post->favorited() ? 'true' : 'false'}}
                            ></favorite>
                    <small style="margin-left: 3px">Likes: {{ $post->followersCount() }}</small>
                </div>
            </div>

            
            <span class="price-tag wordwrap"><small>₱</small> {{$post->price}}</span>
            <div class="rating" style="pointer-events: none;">
                    <input id="input-1" class="rating rating-loading" data-min="0" data-max="5" data-step="1" value="{{ $post->averageRating }}" data-size="xs"> 
                    <small>({{ $post->countRating() }})
                        @if ($post->countRating() > 1)
                            Ratings
                        @else
                            Rating
                        @endif
                    </small>
            </div>

            <div id="info-details">
                    <p>Investment Return Date: <strong>{{$post->return_date}}</strong></p>
                    <p>Projected ROI per Quantity: <strong>{{$post->roi}}%</strong></p>
                    <p>Projected Return after Investment: <strong>{{($post->roi * ($post->price/100))+$post->price}}</strong></p>
            </div>

            <form action="{{route('cart.store')}}" method="POST">
                {{csrf_field()}}
                <input type="hidden" name="id" value="{{$post->id}}">
                <input type="hidden" name="title" value="{{$post->title}}">
                <input type="hidden" name="user_id" value="{{$post->user_id}}">
                <input type="hidden" name="price" value="{{$post->price}}">
       
                
                <div>
                    <label for="sel1">Quantity:</label>
                    <select id="qty" name="quantity">
                        @for ($x = 1; $x <= $fund; $x++) 
                            <option>{{$x}}</option>
                        @endfor
                    </select>

                    <strong>
                        {{ $fund }}
                        @if ($fund > 1)
                        pieces
                        @else
                        piece
                        @endif
                         available
                    </strong>
                </div>
                
                <div class="mt-3"> 
                    <button type="submit" class="btn btn-success">Add to Cart<i class="fa fa-cart-plus"></i></button>

                    <!--Messaging-->
                    @if (Auth::check())
                        @if(Auth::user()->hasRole('investor'))

                                    
                            <a href="{{ route('messages.create', ['user' => $post->user, 'investment' => $post])  }}" class="btn btn-info">
                                Message Business Owner
                                <i aria-hidden="true" class="fa fa-envelope"></i>
                            </a>
                               
                           
                        @endif
                    @endif


                </div>
            </form>



            <div class="mt-2">
                <div id="share-links" class="d-flex">
                                <small>Share On: </small>
                                {!! Share::page(url()->current(), 'Take a look at this investment: '.$post->title)->facebook()->twitter()!!}
     
                </div>
            </div>

             @if(Auth::check())
                @if(Auth::user()->id == $post->user_id)
                    <a href="/posts/{{$post->id}}/edit" class="btn btn-default pull-right"><i class="fa fa-edit"></i> Edit</a>

                @endif
            @endif
        </div>
    </div>

    <div class="post-section bottom mt-2 mb-2">
        <ul class="section-item content-menu">
            <li class="menu active" data-menu="details">Investment Details</li>
            <li class="menu" data-menu="ratings">Ratings ({{ $post->countRating() }})</li>
        </ul>
        <div class="section-item content">
            <div class="wordwrap p-2 item active" data-item="details">
                {!! $post->body !!}

                <div id="investment-details">
                    <div class="form-group d-flex">
                        <label>Written on</label>
                        <div class="form-control">{{$post->created_at}}</div>
                    </div>

                     <div class="form-group d-flex">
                        <label>Written by:</label>
                        <div class="form-control"><a href="{{ route('business.show', ['business' => $post->user->business->id]) }}">{{ $post->user->business->name }}</a></div>
                    </div>
                </div>
            </div>
            <div class="p-2 item" data-item="ratings">
                <div class="comments-app">
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
                            <p>No ratings yet</p>
                        @endif   

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('footer_scripts')
    <script src="{{ asset('js/rating/star-rating.min.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            $(".menu").on("click", function(){
                var dataMenu = $(this).data("menu");
                var contentItem = $(".content .item[data-item="+ dataMenu +"]");
                if (!$(this).hasClass("active") && !contentItem.hasClass("active")) {
                    $(this).siblings().removeClass("active");
                    $(this).addClass("active");
                    contentItem.siblings().removeClass("active");
                    contentItem.addClass("active");
                }
            });
        });
    </script>
@endsection