<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title or 'Rastriya Banijya Bank - Social App'}}</title>
	<link href="/css/main.css" rel="stylesheet">
	<!-- Fonts -->
	{{--<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>--}}
    <!--[if lt IE 8]>
        <link href="/css/ie7-fix.css" rel="stylesheet">
    <![endif]-->
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
    <script src="/js/html5.js"></script>
    <script src="/js/respond.js"></script>
	<![endif]-->
    <style type="text/css">
        .row {
            zoom: 1;
        }
</style>
</head>
<body>
    <div id="wrapper">
    	<nav class="navbar navbar-default">
    		<div class="container">
    			<div class="navbar-header">
    				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-collapse-open">
    					<span class="sr-only">Toggle Navigation</span>
    					<span class="icon-bar"></span>
    					<span class="icon-bar"></span>
    					<span class="icon-bar"></span>
    				</button>
    			</div>

    			<div class="collapse navbar-collapse" id="nav-collapse-open">
    				@if( Auth::check() )
                        <ul class="nav navbar-nav">
                            <li><a href="/home">Home</a></li>
                        </ul>
                        <form class="navbar-form navbar-left" role="search" action="/search">
                            <div class="form-group">
                               <input type="text" name="q" value="{{ Input::get('q') }}" class="form-control" placeholder="Search a Friend">
                            </div>
                        </form>
                    @endif
                    <ul class="nav navbar-nav pull-right">
    					@if (Auth::guest())
    						<li><a href="/login">Login</a></li>
    						{{-- <li><a href="{{ url('/auth/register') }}">Register</a></li> --}}
    					@else
                            <li><a href="/notifications">Notifications</a></li>
                            {{-- <li><a href="/conversations">Messages</a></li> --}}
                            <li><a href="/friends">Friends</a></li>
    						<li class="dropdown">
    							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
    							<ul class="dropdown-menu" role="menu">
                                    <li><a href="/settings/profile">Edit Profile</a>
                                    <li><a href="/settings">Settings</a></li>
                                    <li><a href="/help">Help</a></li>
                                    <li><a href="/auth/logout">Logout</a></li>
    							</ul>
    						</li>
    					@endif
    				</ul>
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
                        <li>UseFul links</li>
                        <li>UseFul links</li>
                        <li>UseFul links</li>
                        <li>UseFul links</li>
                        <li>UseFul links</li>
                    </ul>
                </div>
                <div class="col-md-2">
                    <ul>
                        <li>UseFul links</li>
                        <li>UseFul links</li>
                        <li>UseFul links</li>
                        <li>UseFul links</li>
                        <li>UseFul links</li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul>
                        <li>UseFul links</li>
                        <li>UseFul links</li>
                        <li>UseFul links</li>
                        <li>UseFul links</li>
                        <li>UseFul links</li>
                    </ul>
                </div>
            </div>
            <div class="footer__bottom">
                <p class="pull-left">
                    &copy; @if(date('Y') > $buildYear = 2015) $buildYear - @endif {{date('Y')}}
                    Rastriya Banijya Bank Limited.
                </p>
            </div>
        </div>
	</footer>
@include('layouts.partials.script')
@yield('footer')
	<!-- Scripts -->
<script src="{{elixir('js/all.js')}}"></script>
<script src="/js/vue.min.js"></script>
@yield('scripts')
</body>
</html>
