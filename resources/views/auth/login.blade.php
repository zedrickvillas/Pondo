@extends('layouts.app')



@section('template_linked_css')
    <style>
        body {
            background-color: #ffffff;
        }

        .form {
            width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        .logo .logo-text{
            color: #008c61;
            margin-bottom: 0;
        }

        small.text {
            font-weight: bolder;
            color: #999999f0;
        }

    </style>
@endsection

@section('content')
 <form id="loginForm" class="form mt-3 mb-3" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        
                        <a class="d-flex logo no-underline" href="{{ url('/') }}">
                            <h1 class="logo-text">Pondo</h1>
                            
                        </a>
                        <small class="text">LOG IN</small>
                         
                        <div class="mt-2 form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="form-label" for="first">E-Mail Address</label>
                            <input id="email" name="email" class="form-input" type="text"  value="{{ old('email') }}" />
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                         <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
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
                        <hr />

                        <div class="text-center">
                            <a id="register-link" href="{{ route('register') }}">Create Account</a>
                        </div>

 </form>
@endsection


@section('footer_scripts')   
    <script>
        $(document).ready(function() {
            if (!$('input').val().length == 0) {
             $('input').parents('.form-group').addClass('focused');
            }

            $('input').blur(function(){
              var inputValue = $(this).val();
              if ( inputValue == "" ) {
                $(this).removeClass('filled');
                $(this).parents('.form-group').removeClass('focused');  
              } else {
                $(this).addClass('filled');
              }
            })  
        });
    </script>
@endsection

