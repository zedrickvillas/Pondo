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


/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 9999; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
}

/* Caption of Modal Image */
#caption {
    margin: auto;
    display: block;
    width: 80%;
    max-width: 700px;
    text-align: center;
    color: #ccc;
    padding: 10px 0;
    height: 150px;
}

/* Add Animation */
.modal-content, #caption {    
    -webkit-animation-name: zoom;
    -webkit-animation-duration: 0.6s;
    animation-name: zoom;
    animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
    from {-webkit-transform:scale(0)} 
    to {-webkit-transform:scale(1)}
}

@keyframes zoom {
    from {transform:scale(0)} 
    to {transform:scale(1)}
}

/* The Close Button */
.close {
    position: absolute;
    top: 15px;
    right: 35px;
    color: #f1f1f1;
    font-size: 40px;
    font-weight: bold;
    transition: 0.3s;
}

.close:hover,
.close:focus {
    color: #bbb;
    text-decoration: none;
    cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
    .modal-content {
        width: 100%;
    }
}
</style>
@endsection

@section('content')
    <div class="panel panel-body">
        <div class="panel-heading">

            @if (Auth::check())
                @if (Auth::user()->hasRole('investor'))
                    <div>
                        <favorite
                            :post={{ $post->id }}
                            :favorited={{ $post->favorited() ? 'true' : 'false'}}
                        ></favorite>
                    </div>
                @endif
            @endif               

            <div id="post-featured-image" data-src="{{ $post->image }}"   style="width: 100%; 
                                                    height: 500px; 
                                                    background-image: url({{ $post->image }});
                                                    background-size: contain;
                                                    background-repeat: no-repeat;
                                                    background-position: center;">
                
            </div>


            <!-- Image Modal -->
            <div id="myModal" class="modal">
              <span class="close">&times;</span>
              <img class="modal-content" id="img01">
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

            @if (Auth::check())
                @if (Auth::user()->hasRole('investor'))
                    <form action="{{route('cart.store')}}" method="POST">
                        {{csrf_field()}}
                        <input type="hidden" name="id" value="{{$post->id}}">
                        <input type="hidden" name="title" value="{{$post->title}}">
                        <input type="hidden" name="price" value="{{$post->price}}">
                        <button type="submit" class="button button-green"><i class="fa fa-cart-plus"></i></button>
                    </form>
                @endif
            @endif


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
                    <a href="{{ route('messages.create')  }}" class="btn btn-default"><span class="glyphicon glyphicon-envelope"></span></a></li>
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

    <script>
        // Get the modal
        var modal = document.getElementById('myModal');

        // Get the image and insert it inside the modal - use its "alt" text as a caption
        var img = document.getElementById('post-featured-image');
        var modalImg = document.getElementById("img01");
        var captionText = document.getElementById("caption");
        img.onclick = function(){
            modal.style.display = "block";
            modalImg.src = $(this).data("src");
        }

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() { 
            modal.style.display = "none";
        }

        $(document).keyup(function(e) {
            if (e.keyCode == 27) {
                modal.style.display = "none";
            }
        });
    </script>
@endsection