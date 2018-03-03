@extends('layouts.app')

@section('template_title')
    Pondo
@endsection

@section('template_linked_css')
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

@section('no-container-content')
    <div id="welcome">
    	<div class="d-flex">
       		<div class="flex-g-3">
       			<img class="pondo-plant animated-logo" src="{{ asset('PondoPlant.png') }}"/>
    		    <img class="pondo-pot animated-logo" src="{{ asset('PondoPot.png') }}"/>
    			<div class="title text-center">
    				Pondo
    			</div>
    			<p class="text-center">Under Construction</p>
       		</div>

            @if (!Auth::User())
       		<div class="flex-g-1 p-1">
       				 <form class="form" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        
                        <h2>LOG IN</h2>
                         
                        <div class="mt-2 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="form-label" for="first">E-Mail Address</label>
                            <input id="email" name="email" class="form-input" type="text"  value="{{ old('email') }}" />
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                         <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="form-label" for="first">Password</label>
                            <input id="password" name="password" class="form-input" type="password"  value="{{ old('password') }}" />
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>


                        <div class="form-group">
                            <div class="text-center">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group margin-bottom-3">
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                            </div>
                            <div class="text-center">
                                <a class="btn btn-link no-underline" href="{{ route('password.request') }}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>

                        <p class="text-center margin-bottom-3">
                            Or Login with
                        </p>

                        @include('partials.socials-icons')

                        <hr />

                        <div class="text-center">
                            <a id="register-link" href="{{ route('register') }}">Create Account</a>
                        </div>

                    </form>
       		</div>		
            @endif
    	</div>
    </div>
@endsection



@section('footer_scripts')
    <script>
        $('input').focus(function(){
          $(this).parents('.form-group').addClass('focused');
        });

        $('input').blur(function(){
          var inputValue = $(this).val();
          if ( inputValue == "" ) {
            $(this).removeClass('filled');
            $(this).parents('.form-group').removeClass('focused');  
          } else {
            $(this).addClass('filled');
          }
        })  
    </script>
@endsection
