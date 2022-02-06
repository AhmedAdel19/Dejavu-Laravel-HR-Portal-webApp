<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
        
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- This page CSS -->
    <link href="{{asset('assets/libs/jquery-steps/jquery.steps.css')}}" rel="stylesheet">
    <link href="{{asset('assets/libs/jquery-steps/steps.css')}}" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{asset('dist/css/style.min.cs')}}s" rel="stylesheet">


      <link rel="manifest" href="{{asset('assets/manifest.json')}}">
      <link rel="shortcut icon" type="image/x-icon" href="{{asset('assets/img/favicon.ico')}}">

      <!-- CSS here -->
          <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
          <link rel="stylesheet" href="{{asset('assets/css/owl.carousel.min.css')}}">
          <link rel="stylesheet" href="{{asset('assets/css/gijgo.css')}}">
          <link rel="stylesheet" href="{{asset('assets/css/slicknav.cs')}}s">
          <link rel="stylesheet" href="{{asset('assets/css/animate.min.css')}}">
          <link rel="stylesheet" href="{{asset('assets/css/magnific-popup.css')}}">
          {{-- <link rel="stylesheet" href="{{asset('assets/css/fontawesome-all.min.css')}}">
          <link rel="stylesheet" href="{{asset('assets/css/themify-icons.css')}}"> --}}
          <link rel="stylesheet" href="{{asset('assets/css/slick.css')}}">
          {{-- <link rel="stylesheet" href="{{asset('assets/css/nice-select.css')}}"> --}}
          <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
          <link rel="stylesheet" href="{{asset('assets/css/responsive.css')}}">

<title>{{env('App_NAME' , 'dejavuApp')}}</title>
<style>
    .content 
    {
        text-align: center;
        margin-top: 15%;
    }
   .title
    {
        font-size: 84px;
        color: #636b6f;
        font-family: 'Raleway', sans-serif;
        font-weight: 50;
        height: 100vh;
        margin: 0;
    }
    body{
        background-color:#fff;
    }
    .li_style{
        font-size: 16px;
        color: #fff;
    }
    </style>

@include('includes.navbar')
</head>
<body>

<div class="mb-3"></div>
    <div class="container">
      @include('includes/messages/error_messages')
      @include('includes/messages/correct_messages')
         @yield('content')
    </div>


      	<!-- JS here -->
	
		<!-- All JS Custom Plugins Link Here here -->
        <script src="{{asset('assets/js/vendor/modernizr-3.5.0.min.js')}}"></script>
		
		<!-- Jquery, Popper, Bootstrap -->
		<script src="{{asset('assets/js/vendor/jquery-1.12.4.min.js')}}"></script>
        <script src="{{asset('assets/js/popper.min.js')}}"></script>
        <script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
	    <!-- Jquery Mobile Menu -->
        <script src="{{asset('assets/js/jquery.slicknav.min.js')}}"></script>

		<!-- Jquery Slick , Owl-Carousel Plugins -->
        <script src="{{asset('assets/js/owl.carousel.min.js')}}"></script>
        <script src="{{asset('assets/js/slick.min.js')}}"></script>
        <!-- Date Picker -->
        <script src="{{asset('assets/js/gijgo.min.js')}}"></script>
		<!-- One Page, Animated-HeadLin -->
        <script src="{{asset('assets/js/wow.min.js')}}"></script>
		<script src="{{asset('assets/js/animated.headline.js')}}"></script>
        <script src="{{asset('assets/js/jquery.magnific-popup.js')}}"></script>

		<!-- Scrollup, nice-select, sticky -->
        {{-- <script src="{{asset('assets/js/jquery.scrollUp.min.js')}}"></script>
        {{-- <script src="{{asset('assets/js/jquery.nice-select.min.js')}}"></script> --}}
		<script src="{{asset('assets/js/jquery.sticky.js')}}"></script>
        
        <!-- contact js -->
        <script src="{{asset('assets/js/contact.js')}}"></script>
        <script src="{{asset('assets/js/jquery.form.js')}}"></script>
        <script src="{{asset('assets/js/jquery.validate.min.js')}}"></script>
        <script src="{{asset('assets/js/mail-script.js')}}"></script>
        <script src="{{asset('assets/js/jquery.ajaxchimp.min.js')}}"></script>
        
		<!-- Jquery Plugins, main Jquery -->	
        <script src="{{asset('assets/js/plugins.js')}}"></script>
        <script src="{{asset('assets/js/main.js')}}"></script>
      <!--3/4/2020----------------------------------->

  
  
      {{-- <script src="{{asset('assets/js_templete/main.js')}}"></script> --}}
      <script>
          $('#datepicker').datepicker({
              iconsLibrary: 'fontawesome',
              icons: {
               rightIcon: '<span class="fa fa-caret-down"></span>'
           }
          });
      </script>

      <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;

            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;

            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;

            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
    @endif
    </script>

    @if (auth()->check())
    <script>
        var authuser = @JSON(auth()->user())
    </script>     
    @endif

</body>
</html>