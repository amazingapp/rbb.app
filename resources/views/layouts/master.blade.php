<!DOCTYPE html>
<html lang="en" id="rbb-app">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title or 'Rastriya Banijya Bank - Social App'}}</title>
	<link href="/css/main.css" rel="stylesheet">
	<!-- Fonts -->
	{{-- <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'> --}}
    <!--[if lt IE 8]>
        <link href="/css/ie7-fix.css" rel="stylesheet">
    <![endif]-->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
    <script src="/js/html5.js"></script>
    <script src="/js/respond.js"></script>
	<![endif]-->
    <!-- Spark Globals -->
    @include('scripts.globals')
</head>
<body>
    <div id="wrapper">
    <nav class="navbar navbar-default navbar-fixed-top">
         <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
        <div id="navbar" class="navbar-collapse collapse navbar-ex1-collapse">
              <div class="container">
                @if($authUser)
                <ul class="nav navbar-nav">
                  <li role="presentation"><a href="/home">Home</a></li>
              <!--<li role="presentation"><a href="/notifications">Notifications <span class="badge"></span></a></li>-->
              <!--<li><a href="/conversations">Messages</a></li>-->
                  <li role="presentation"><a href="/friends">Friends</a></li>
                  @if($friendRequests)
                    <li role="presentation">
                        <a href="/friends/requests">Friend Requests <span class="badge">{{$friendRequests}}</span></a>
                    </li>
                  @endif
                </ul>
                  @else
                    <ul class="nav navbar-nav navbar">
                        <li><a href="/">Rastriya Banijya Bank</a></li>
                    </ul>
                  @endif
                 <ul class="nav navbar-nav navbar-right">
                                @if (Auth::guest())
                                    <li><a href="/login">Login</a></li>
                                @else
                                    <li class="dropdown menu-right">
                                        <a href="#" id="user-menu" class="dropdown-toggle" data-toggle="dropdown">
                                            {{ Auth::user()->name }}&nbsp;
                                            <span class="caret"></span>
                                            <img src="/{{$authAavatar->icon_path}}" style="width:32px;height:32px;">
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="/settings/account?tab=profile">Edit Profile</a>
                                            <li><a href="/settings/account?tab=password">Change Password</a></li>
                                            <li><a href="/settings/account?tab=image">Change Profile Image</a></li>
                                            <li class="divider"></li>
                                            <li><a href="/logout">Logout</a></li>
                                        </ul>
                                    </li>
                                @endif
                            </ul>
                @if($authUser)
                    <form class="navbar-form navbar-right" method="GET" role="search" action="/search">
                        <div class="form-group">
                           <input type="text"
                           name="q"
                           value="{{ Input::get('q') }}"
                           class="form-control"
                           placeholder="Search Name, Employee Id, Branch">
                        </div>
                    </form>
                @endif
          </div>
        </div>
    </nav>

        <div class="container main">
            @yield('content')
        </div>
      </div>
	<footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h4 class="log">
                        Social App
                    </h4>
                </div>
                <div class="col-md-2">
                    <ul>
                        <li><a href="//rbb.com.np" target="_blank">rbb.com.np</a></li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul>
                        <li><a href="//ebanking.rbb.com.np" target="_blank">Ebanking</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul>
                        <li><a href="#"></a></li>
                    </ul>
                </div>
            </div>
            <div class="footer__bottom">
                <p class="pull-left">
                    &copy; @if(date('Y') > $buildYear = 2015) {{$buildYear}} - @endif {{date('Y')}}
                    Rastriya Banijya Bank Limited.
                </p>
            </div>
        </div>
	</footer>
@include('layouts.partials.script')
    <!-- Scripts -->
<script src="{{elixir('js/all.js')}}"></script>
@yield('footer')
<script>

</script>
@yield('scripts','')
</body>
</html>
