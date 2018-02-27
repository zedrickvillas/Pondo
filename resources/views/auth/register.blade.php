@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">

                    {!! Form::open(['route' => 'register', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'POST'] ) !!}

                        {{ csrf_field() }}


                        <div class="form-group">
                            <label for="user_role" class="col-sm-4 control-label" name="user_role">What are you:</label>
                            <div class="col-sm-6">
                              <select class="form-control" id="user_role" class="col-sm-6" name="user_role">
                                @foreach($roles as $role)
                                    <option>{{ $role->name }}</option>
                                @endforeach
                              </select>
                            </div>
                        </div>

                        <div id="businessOwnerFields">

                            <div class="form-group{{ $errors->has('business_name') ? ' has-error' : '' }}">
                                <label for="first_name" class="col-sm-4 control-label">Business Name</label>
                                <div class="col-sm-6">
                                    {!! Form::text('business_name', null, ['class' => 'form-control', 'placeholder' => 'Business Name', 'id' => 'business_name']) !!}
                                    @if ($errors->has('business_name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('business_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('business_nature') ? ' has-error' : '' }}">
                                <label for="business_nature" class="col-sm-4 control-label">Business Nature</label>
                                <div class="col-sm-6">
                                    {!! Form::text('business_nature', null, ['class' => 'form-control', 'placeholder' => 'Business Nature', 'id' => 'business_nature']) !!}
                                    @if ($errors->has('business_nature'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('business_nature') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                             <div class="form-group{{ $errors->has('business_address') ? ' has-error' : '' }}">
                                <label for="business_address" class="col-sm-4 control-label">Business Address</label>
                                <div class="col-sm-6">
                                    {!! Form::text('business_address', null, ['class' => 'form-control', 'placeholder' => 'Business Address', 'id' => 'business_address']) !!}
                                    @if ($errors->has('business_address'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('business_address') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>



                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-sm-4 control-label">Name</label>
                            <div class="col-sm-6">
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Username', 'id' => 'name', 'required', 'autofocus']) !!}
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-sm-4 control-label">First Name</label>
                            <div class="col-sm-6">
                                {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => 'First Name', 'id' => 'first_name']) !!}
                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-sm-4 control-label">Last Name</label>
                            <div class="col-sm-6">
                                {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => 'Last Name', 'id' => 'last_name']) !!}
                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-sm-4 control-label">E-Mail Address</label>
                            <div class="col-sm-6">
                                {!! Form::email('email', null, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'E-Mail Address', 'required']) !!}
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-sm-4 control-label">Password</label>
                            <div class="col-sm-6">
                                {!! Form::password('password', ['class' => 'form-control', 'id' => 'password', 'placeholder' => 'Password', 'required']) !!}
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-sm-4 control-label">Confirm Password</label>
                            <div class="col-sm-6">
                                {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' => 'password-confirm', 'placeholder' => 'Confirm Password', 'required']) !!}
                            </div>
                        </div>
                        @if(config('settings.reCaptchStatus'))
                            <div class="form-group">
                                <div class="col-sm-6 col-sm-offset-4">
                                    <div class="g-recaptcha" data-sitekey="{{ env('RE_CAP_SITE') }}"></div>
                                </div>
                            </div>
                        @endif
                        <div class="form-group margin-bottom-2">
                            <div class="col-sm-6 col-sm-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>

                        <p class="text-center margin-bottom-2">
                            Or Use Social Logins to Register
                        </p>

                        @include('partials.socials')

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_scripts')

    <script src='https://www.google.com/recaptcha/api.js'></script>


    <script>
     $(document).ready(function () {

        var user_role;

        user_role = $("#user_role").val();

       


            if (user_role == "Business Owner") {

                $("#businessOwnerFields").removeClass("hidden");

            } else {

                $("#businessOwnerFields").addClass("hidden");
            }


            $("#user_role").on("change", function(){

                user_role = $("#user_role").val();

                
                if (user_role == "Business Owner") {

                    $("#businessOwnerFields").removeClass("hidden");

                } else {

                    $("#businessOwnerFields").addClass("hidden");
                }

            });




        });
    </script>

@endsection