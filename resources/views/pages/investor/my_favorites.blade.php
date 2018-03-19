@extends('layouts.app')

@section('template_title')
    Pondo
@endsection

@section('template_linked_css')

    <link rel="stylesheet" type="text/css" href="{{ asset('css/investment-list.css') }}">

	 <!-- Styles -->
    <style>
        .welcome-logo {
            height: 200px;
        }

        .full-height {
            height: 100vh;
        }

        .animated-logo {
            display: block;
            width: 100px;
            margin:auto;
            transform-origin: bottom;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }
        /* all other browsers */
        @keyframes grow {
            0% {
                opacity: 0.1;
                -moz-transform: scale(0.3);
                -ms-transform: scale(0.3);
                transform: scale(0.3);
            }
            50% {
                opacity: 0.9;
                -moz-transform: scale(.6);
                -ms-transform: scale(.6);
                transform: scale(.6);
            }
            100% {
                -moz-transform: scale(1);
                -ms-transform: scale(1);
                transform: scale(1);
                opacity: 1;
            }
        }

        .pondo-plant {
            -webkit-animation-name: grow;
            -webkit-animation-timing-function: linear;
            -webkit-animation-iteration-count: 1;
            -webkit-animation-duration: 2s;

            animation-name: grow;
            animation-timing-function: linear;
            animation-iteration-count: 1;
            animation-duration: 2s;

            -webkit-transform-style: preserve-3d;
            -moz-transform-style: preserve-3d;
            -ms-transform-style: preserve-3d;
            transform-style: preserve-3d;
        }

        #spinner:hover {
            -webkit-animation-play-state: paused;
            animation-play-state: paused;
        }


        body {
            background-color: #ffffff;
        }

        .form {
            width: 400px;
            margin-left: auto;
            margin-right: auto;
        }



    </style>
@endsection

@section('content')


    <h3 class="page-header">Investments</h3>

    <div id="investment-list" class="row">
            @forelse ($myFavorites as $myFavorite)
                <div class="investment-item col-sm-4">
                   
                    <div class="investment-item-header" style="background-image: url({{$myFavorite->image}})">

                        <h2><a href="/posts/{{$myFavorite->id}}">{{$myFavorite->title}}</a></h2>

                        <p>
                            <form action="{{route('cart.store')}}" method="POST">

                                                        {{csrf_field()}}
                                                        <input type="hidden" name="id" value="{{$myFavorite->id}}">
                                                        <input type="hidden" name="title" value="{{$myFavorite->title}}">
                                                        <input type="hidden" name="price" value="{{$myFavorite->price}}">
                                                        <button type="submit" class="button button-green"><i class="fa fa-cart-plus"></i></button>
                            </form>

                                                    {!!Form::close()!!}
                        </p>
                    </div>

                    <div class="investment-item-body">
                        <p><a href="{{ route('business.show', ['business' => $myFavorite->user->business]) }}" class="no-underline">{{$myFavorite->user->business->name}}</a></p>
                        <p>{{$myFavorite->price}}</p>
                        <p>{{$myFavorite->quantity}}</p>
                    </div>

                    <div class="investment-item-footer">

                        @if (Auth::check())
                            @if (Auth::user()->hasRole('investor'))
                                <favorite
                                    :post={{ $myFavorite->id }}
                                    :favorited={{ $myFavorite->favorited() ? 'true' : 'false'}}
                                ></favorite>
                            @endif
                        @endif   


                    </div>

                </div>

            @empty
                <p>No favorited investment.</p>
            @endforelse


        
 

        



    </div>

@endsection



