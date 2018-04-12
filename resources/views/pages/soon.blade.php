@extends('layouts.blank')

@section('template_title')
@endsection

@section('template_linked_css')
	 <!-- Styles -->
    <style>
    .outer {
      display: table;
      position: absolute;
      height: 100%;
      width: 100%;
    }

    .middle {
      display: table-cell;
      vertical-align: middle;
    }

    .inner {
      margin-left: auto;
      margin-right: auto;
      width: 100%;
    /*whatever width you want*/
    }

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
            font-family:Raleway, sans-serif;
        }
        p {
          font-family:Raleway, sans-serif;
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
    </style>
@endsection


    <div id="welcome" class="outer">
    	<div class="d-flex middle" >
   		<div class="flex-g-3 inner">
   			<img class="pondo-plant animated-logo" src="{{ asset('PondoPlant.png') }}"/>
		    <img class="pondo-pot animated-logo" src="{{ asset('PondoPot.png') }}"/>
			<div class="title text-center">
				Pondo
			</div>
			<p class="text-center">Under Construction</p>
   		</div>



    	</div>
    </div>
