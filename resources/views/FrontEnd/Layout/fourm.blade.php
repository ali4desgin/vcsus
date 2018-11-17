<!DOCTYPE HTML>
<html lang="en" dir="rtl">
<head>
	<title>@yield("fourm_title")</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">


	<!-- Font -->

	<link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet">


	<!-- Stylesheets -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

	<link href="{{ url('FrontEnd/Fourm/common-css/bootstrap.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-rtl/3.4.0/css/bootstrap-rtl.min.css" rel="stylesheet"/>
	<link href="{{ url('FrontEnd/Fourm/common-css/ionicons.css') }}" rel="stylesheet">


	<link href="{{ url('FrontEnd/Fourm/layout-1/css/styles.css') }}" rel="stylesheet">

	<link href="{{ url('FrontEnd/Fourm/layout-1/css/responsive.css') }}" rel="stylesheet">

</head>
<body >

	<header>
		<div class="container-fluid position-relative no-side-padding">

			<a href="#" class="logo"><img src="{{ url('FrontEnd/Fourm/images/logo.png') }}" alt="Logo Image"></a>

			<div class="menu-nav-icon" data-nav-menu="#main-menu"><i class="ion-navicon"></i></div>

			<ul class="main-menu visible-on-click" id="main-menu">
				<li><a href="{{ url('/home') }}"> <i class="fa fa-home"></i> الرئيسية </a></li>
				<li><a href="{{ url('/profile').'/'.\Session::get('id') }}"><i class="fa fa-user"></i> الملف الشخصي</a></li>
				<li><a href="{{ url('/notification') }}"> الاشعارات <i class="fa fa-point"></i></a></li>
			</ul><!-- main-menu -->

			<div class="src-area">
				<form>
					<button class="src-btn" type="submit"><i class="fa fa-search"></i></button>
					<input class="src-input" type="text" placeholder="بحث في المنتدى">
				</form>
			</div>

		</div><!-- conatiner -->
	</header>

	<div class="slider">
    <div class="display-table  center-text">
			<h1 class="title display-table-cell"><b style="    box-shadow: 2px 4px 47px 6px #0736ef;
    padding: 14px;    font-size: 30px;
    color: #FFF;
    font-weight: bold;">@yield("fourm_title")</b></h1>
  
    
	</div>
    </div><!-- slider -->

	<section class="blog-area section">
		<div class="container">






                @yield("talbar2")

                @yield("content")



        
		</div><!-- container -->
	</section><!-- section -->

	<!-- SCIPTS -->

	<script src="{{ url('FrontEnd/Fourm/common-js/jquery-3.1.1.min.js') }}"></script>

	<script src="{{ url('FrontEnd/Fourm/common-js/tether.min.js') }}"></script>

	<script src="{{ url('FrontEnd/Fourm/common-js/bootstrap.js') }}"></script>

	<script src="{{ url('FrontEnd/Fourm/common-js/scripts.js') }}"></script>

</body>
</html>
