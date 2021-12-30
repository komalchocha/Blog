<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Classic - Responsive Bootstrap 4.0 Template</title>
<!--
Classic Template
http://www.templatemo.com/tm-488-classic
-->
    <!-- load stylesheets -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400">  <!-- Google web font "Open Sans" -->
    <link rel="stylesheet" href="{{ asset('blog/assets/css/bootstrap.min.css')}}">
                                   <!-- Bootstrap style -->
    <!-- <link rel="stylesheet" href="{{ asset('blog/assets/css/templatemo-style.css')}}">                                   Templatemo style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('blog/assets/css/style.css')}}">   
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
          <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
     
          <![endif]-->
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.min.css">   

          @stack('css')
</head>

    <body>

    <body>
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->
    @include('user.user_layout.headerblog')
   
    <div class="main-banner header-text">
        <div class="container-fluid">
            <div class="owl-banner owl-carousel">
                <div class="item">

                </div>
            </div>
        </div>
    </div>
    <section class="blog-posts">
        <div class="container">
           
            @yield('content')
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.2.0/sweetalert2.all.min.js"></script>
    <script src="{{ asset('blog/assets/js/jquery-1.11.3.min.js')}}"></script>             <!-- jQuery (https://jquery.com/download/) -->
        <script src="https://www.atlasestateagents.co.uk/javascript/tether.min.js"></script> <!-- Tether for Bootstrap, http://stackoverflow.com/questions/34567939/how-to-fix-the-error-error-bootstrap-tooltips-require-tether-http-github-h --> 
        <script src="{{ asset('blog/assets/js/bootstrap.min.js')}}"></script>                 <!-- Bootstrap (http://v4-alpha.getbootstrap.com/) -->
</body>
</html>