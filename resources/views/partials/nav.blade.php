<nav class="navbar navbar-default navbar-static-top">
    <div class="container" id="header">
        {{-- Branding Image --}}
        <a id="top-brand" class="navbar-brand d-flex" href="{{ url('/') }}">
                <img src="{{ asset('favicon.ico') }}" / id="logo-img">
                ondo

        </a>


        <div class="navbar-header">

            {{-- Collapsed Hamburger --}}
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">{!! trans('titles.toggleNav') !!}</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            {{-- Left Side Of Navbar --}}
            <!--<ul class="nav navbar-nav">
            </ul>-->
            

            {{-- Right Side Of Navbar --}}
            <ul class="nav navbar-nav navbar-right">
                {{-- Authentication Links --}}
                @if (!Auth::check())
                        <form class="d-flex" id="navLoginForm" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group d-flex {{ $errors->has('email') ? ' has-error' : '' }}">
                            <label class="form-label" for="first">E-Mail Address</label>
                            <input id="email" name="email" class="form-input" type="text"  value="{{ old('email') }}" />
                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                </label>
                            </div>
                        </div>

                         <div class="form-group d-flex {{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="form-label" for="first">Password</label>
                            <input id="password" name="password" class="form-input" type="password"  value="{{ old('password') }}" />
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                            <a class="btn btn-link no-underline" href="{{ route('password.request') }}">
                                Forgot Your Password?
                            </a>
                        </div>


                        <div class="form-group d-flex">
                       
                            <button type="submit" class="btn btn-primary">
                                    Login
                            </button>
                            
                        </div>
                    </form>
                @else

                    
                    @if (Auth::User()->hasRole('investor'))
                        <li><a href="{{ route('cart.index') }}"><i class="fa fa-shopping-cart" style="font-size: 27px;"></i></a></li>
                    @endif


                <li><a href="{{ url('/wallet') }}">My Wallet </a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">

                            @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                                <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="user-avatar-nav">
                            @else
                                <div class="user-avatar-nav"></div>
                            @endif

                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" role="menu">
                            
                            <li><a href="{{ url('/dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a></li>

                            <li><a href="{{ route('messages') }}"><i class="fa fa-envelope" aria-hidden="true"></i>Messenger</a></li>
                            
                            @if (Auth::User()->hasRole('investor'))
                            <li>
                                <a href="{{ route('investor.favorites') }}"><i class="fa fa-heart" aria-hidden="true"></i>My Favorites</a>
                            </li>
                            @endif

                            <li><a href="{{ route('profile.show', ['profile' => Auth::User()->name]) }}"><i class="fa fa-user" aria-hidden="true"></i>My Profile</a></li>
                            <li>
                                <a href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out" aria-hidden="true"></i>Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>

     </div>
</nav>
<div>
    
</div>

