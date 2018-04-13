<nav class="navbar navbar-default navbar-static-top">
    <div class="container d-flex" id="header">

        <div class="header-item d-flex p-tb-2"> 
            {{-- Branding Image --}}
            <a id="top-brand" class="navbar-brand d-flex" href="{{ url('/') }}" style="font-size: 30px">
                    <img src="{{ asset('favicon.ico') }}" / id="logo-img" style="height: 70px;">
                    ondo

            </a>

            <form action="{{ route('search') }}" method="POST" class="d-flex search-form">
                {{ csrf_field() }}
                        <input type="text" name="search" placeholder="Where do you want to invest?">
                        <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>

            @if(Auth::check())     
                @if (Auth::User()->hasRole('investor'))
                    <a href="{{ route('cart.index') }}" style="position: relative; margin-right: 40px;"><i class="fa fa-shopping-cart" style="font-size: 27px; color: #fff;"></i>
                        @if (Cart::count() > 0)
                            <span id="cartCount">{{Cart::count()}}</span>
                        @endif   
                    </a>
                @endif
            @endif
            <div class="navbar-header">

                    {{-- Collapsed Hamburger --}}
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                        <span class="sr-only">{!! trans('titles.toggleNav') !!}</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
            </div>

        </div>
        <div class="header-item d-flex"> 
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

                                <div class="form-group d-flex">
                                    <label class="form-label" for="first">E-Mail Address</label>
                                    <input id="email" name="email" class="form-input" type="text"  value="{{ old('email') }}"
                                    style="
                                        @if ($errors->has('email'))
                                            box-shadow: 0 -3px 0 0 #fb0303 inset;
                                        @endif
                                    " 
                                     />
                                    
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                        </label>
                                    </div>
                                </div>

                                 <div class="form-group d-flex">
                                    <label class="form-label" for="first">Password</label>
                                    <input id="password" name="password" class="form-input" type="password"  value="{{ old('password') }}" 
                                      style="
                                        @if ($errors->has('password'))
                                            box-shadow: 0 -3px 0 0 #fb0303 inset;
                                        @endif
                                        " 
                                    />

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



                       
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="display: flex; align-items: center;">

                                    @if ((Auth::User()->profile) && Auth::user()->profile->avatar_status == 1)
                                        <img src="{{ Auth::user()->profile->avatar }}" alt="{{ Auth::user()->name }}" class="user-avatar-nav">
                                    @else
                                        <div class="user-avatar-nav"></div>
                                    @endif

                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu" role="menu">
                                    
                                    <li><a href="{{ url('/dashboard') }}"><i class="fa fa-tachometer" aria-hidden="true"></i>Dashboard</a></li>

                                     <li><a href="{{ url('/wallet') }}"><i class="fa fa-money" aria-hidden="true"></i> My Wallet</a></li>

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
     
     </div>
</nav>
<div>
    
</div>

