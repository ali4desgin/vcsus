<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield("title")</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
				<link rel="stylesheet" href="{{ url('FrontEnd/login/assets/bootstrap/css/bootstrap.min.css') }}">
				<link rel="stylesheet" href="{{ url('FrontEnd/login/styles/css/bootstrap-rtl.css') }}">
        <link rel="stylesheet" href="{{ url('FrontEnd/login/assets/font-awesome/css/font-awesome.min.css') }}">
		<link rel="stylesheet" href="{{ url('FrontEnd/login/assets/css/form-elements.css') }}">
		<link rel="stylesheet" href="{{ url('FrontEnd/login/styles/css/amiri.css') }}">
		<link rel="stylesheet" href="{{ url('FrontEnd/login/assets/css/style.css') }}">
        

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

        <!-- Favicon and touch icons -->
        <link rel="shortcut icon" href="{{ url('FrontEnd/assets/ico/favicon.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('FrontEnd/login/assets/ico/apple-touch-icon-144-precomposed.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ url('FrontEnd/login/assets/ico/apple-touch-icon-114-precomposed.png') }}">
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ url('FrontEnd/login/assets/ico/apple-touch-icon-72-precomposed.png') }}">
				<link rel="apple-touch-icon-precomposed" href="{{ url('FrontEnd/login/assets/ico/apple-touch-icon-57-precomposed.png') }}">
				<link rel="stylesheet" href="{{ url('FrontEnd/login/styles/css/fonts.css') }}">
				<link rel="stylesheet" href="{{ url('FrontEnd/login/styles/css/login.css') }}">
    </head>

    <body>


		<nav class="navbar navbar-default">
			<div class="container-fluid">
			  <!-- Brand and toggle get grouped for better mobile display -->
			  <div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
				  <span class="sr-only">Toggle navigation</span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				  <span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="{{ url('/') }}">Vcsus</a>
			  </div>
		  
			  <!-- Collect the nav links, forms, and other content for toggling -->
			  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
				  <li class=""><a href="{{ url('/about') }}">من نحن؟ <span class="sr-only">(current)</span></a></li>
				  <li><a href="{{ url('/privacy') }}">سياسة الاستخدام</a></li>
				  
				</ul>


				<ul class="nav navbar-nav navbar-left">
				  <!-- <li><a href="{{ url('/biss') }}">الشركاء</a></li> -->
				  
				</ul>
			  </div><!-- /.navbar-collapse -->
			</div><!-- /.container-fluid -->
		  </nav>





        @yield("content")


        <!-- Footer -->
        <footer>
        	<div class="container">
        		<div class="row">
        			
        			<div class="col-sm-8 col-sm-offset-2">
        				<div class="footer-border"></div>
        				<p>جميع الحقوق <a href="" target="_blank"><strong>2018</strong></a> 
        					محفوظة <i class="fa fa-smile-o"></i></p>
        			</div>
        			
        		</div>
        	</div>
        </footer>

        <!-- Javascript -->
        <script src="{{ url('FrontEnd/login/assets/js/jquery-1.11.1.min.js') }}"></script>
        <script src="{{ url('FrontEnd/login/assets/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ url('FrontEnd/login/assets/js/jquery.backstretch.min.js') }}"></script>
        <script src="{{ url('FrontEnd/login/assets/js/scripts.js') }}"></script>
        <script src="{{ url('FrontEnd/login/styles/js/login.js') }}"></script>
        <!--[if lt IE 10]>
            <script src="{{ url('FrontEnd/assets/js/placeholder.js') }}"></script>
        <![endif]-->



					@yield("script")
    </body>

</html>
