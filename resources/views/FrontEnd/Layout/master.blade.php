<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
  <meta charset="utf-8">
  <title> @yield("title")</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicons -->
  <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

  <!-- Bootstrap CSS File -->
  <link href="{{ url('FrontEnd/Home/lib/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://cdn.rtlcss.com/bootstrap/v4.0.0/css/bootstrap.min.css" integrity="sha384-P4uhUIGk/q1gaD/NdgkBIl3a6QywJjlsFJFk7SPRdruoGddvRVSwv5qFnvZ73cpz" crossorigin="anonymous"> -->


  <!-- Libraries CSS Files -->
  <link href="{{ url('FrontEnd/Home/lib/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ url('FrontEnd/Home/lib/animate/animate.min.css') }}" rel="stylesheet">
  <link href="{{ url('FrontEnd/Home/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
  <link href="{{ url('FrontEnd/Home/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
  <link href="{{ url('FrontEnd/Home/lib/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
  <link href="{{ url('FrontEnd/Home/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
  <!-- Main Stylesheet File -->
  <link href="{{ url('FrontEnd/Home/css/style.css') }}" rel="stylesheet">
  <link href="{{ url('FrontEnd/Home/css/custom.css') }}" rel="stylesheet">
  
  @yield("styles")
  <!-- =======================================================
    Theme Name: Reveal
    Theme URL: https://bootstrapmade.com/reveal-bootstrap-corporate-template/
    Author: BootstrapMade.com
    License: https://bootstrapmade.com/license/
  ======================================================= -->
</head>

<body id="body">

  <!--==========================
    Top Bar
  ============================-->
  <section id="topbar" class="d-none d-lg-block">
    <div class="container clearfix">
      <div class="contact-info float-left">
       
      </div>
      <div class="social-links float-right">
      <a href="{{ url('/home') }} " class="active" > <i class="fa fa-home"></i> الصفحة الرئيسية</a> 
        <a href="{{ url('/profile').'/'.\Session::get('id') }} " class="active" > <i class="fa fa-user-circle"></i> الصفحة الشخصية</a> 
        <a href="{{ url('/lib') }}"><i class="fa fa-book"></i>   المكتبة</a>
        <a href="{{ url('/editprofile') }}"><i class="fa fa-gear"></i> الاعدادات</a>
       
        <a href="{{ url('/logout') }}"><i class="fa fa-lock"></i>  تسجيل خروج</a>
      </div>
    </div>
  </section>

  <!--==========================
    Header
  ============================-->
  <header id="header">
    <div class="container">

      <div id="logo" class="pull-left">
        <h1><a href="#body" class="scrollto">Vcs<span>us</span></a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="#body"><img src="img/logo.png" alt="" title="" /></a>-->
      </div>
    <div class="search-form" style="    width: 301px;
    padding-top: 12px;
    margin-right: 12px;">
        <form>
           <div class="inner-addon left-addon">
                <input type="text" class="form-control search_top_input" id="search_top_input"  style="    font-family: Arial, FontAwesome;
    width: 168px;
    height: 24px;
    font-size: 15px;"  placeholder="&#xf002; ابحث" />

           </div>

       </form>
</div>
      <!-- <nav id="nav-menu-container">

          
        <ul class="nav-menu">
        <li><a href="">الاعلانات</a></li>
        <li><a href="">الاعلانات</a></li>
        <li><a href="{{ url('/lib') }}">المكتبة</a></li>
        <li  @if(Route::currentRouteName()== "library")
            class="active"
            @endif><a href="">الاعلانات</a></li>
          <li  @if( $_SERVER['PHP_SELF'] == "notification")
            class="active"
            @endif class="menu-has-children"><a href="">الاشعارات</a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
              <li><a href="#">Drop Down 5</a></li>
            </ul>
          </li>
          <li 
          
            @if( $_SERVER['PHP_SELF'] == "/index.php/home")
                class="active"
            @endif

          ><a href="" ><i class="fa fa-home"></i> الرئيسية</a></li>
        </ul>
      </nav> -->
    </div>
  </header><!-- #header -->





    @yield("content")




  <!--==========================
    Footer
  ============================
  <footer id="footer">
    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong>Reveal</strong>. All Rights Reserved
      </div>
      <div class="credits">
      
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>
  </footer> #footer -->

  <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>

  <!-- JavaScript Libraries -->
  <script src="{{ url('FrontEnd/Home/lib/jquery/jquery.min.js') }}"></script>
  <script src="{{ url('FrontEnd/Home/lib/jquery/jquery-migrate.min.js') }}"></script>
  
  <script src="{{ url('FrontEnd/Home/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ url('FrontEnd/Home/lib/easing/easing.min.js') }}"></script>
  <script src="{{ url('FrontEnd/Home/lib/superfish/hoverIntent.js') }}"></script>
  <script src="{{ url('FrontEnd/Home/lib/superfish/superfish.min.js') }}"></script>
  <script src="{{ url('FrontEnd/Home/lib/wow/wow.min.js') }}"></script>
  <script src="{{ url('FrontEnd/Home/lib/owlcarousel/owl.carousel.min.js') }}"></script>
  <script src="{{ url('FrontEnd/Home/lib/magnific-popup/magnific-popup.min.js') }}"></script>
  <script src="{{ url('FrontEnd/Home/lib/sticky/sticky.js') }}"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD8HeI8o-c1NppZA-92oYlXakhDPYR7XMY"></script>
  <!-- Contact Form JavaScript File -->
  <script src="{{ url('FrontEnd/Home/contactform/contactform.js') }}"></script>
  <script src="https://cdn.rtlcss.com/bootstrap/v4.0.0/js/bootstrap.min.js" integrity="sha384-54+cucJ4QbVb99v8dcttx/0JRx4FHMmhOWi4W+xrXpKcsKQodCBwAvu3xxkZAwsH" crossorigin="anonymous"></script>

  <!-- Template Main Javascript File -->
  <script src="{{ url('FrontEnd/Home/js/main.js') }}"></script>
  <script src="{{ url('FrontEnd/Home/js/input.js') }}"></script>
  @yield("scripts")
</body>
</html>


