 <!DOCTYPE html>
<html>
  <head>
    <title> Shop Manila Admin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jszip-2.5.0/dt-1.10.16/af-2.2.2/b-1.5.1/b-colvis-1.5.1/b-flash-1.5.1/b-html5-1.5.1/b-print-1.5.1/cr-1.4.1/fc-3.2.4/fh-3.1.3/kt-2.3.2/r-2.2.1/rg-1.0.2/rr-1.2.3/sc-1.4.4/sl-1.2.5/datatables.min.css"/>
   
    <link href="https://fonts.googleapis.com/css?family=Karla|Lobster|Merriweather+Sans|Montserrat" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anonymous+Pro|Nanum+Gothic+Coding" rel="stylesheet">
  
    <!-- bootstrap theme -->
    <link href="{{asset('bootstrap/css/bootstrap-theme.css')}}" rel="stylesheet">
    <!--external css-->
    <!-- font icon -->
    <link href="{{asset('css/elegant-icons-style.css')}}" rel="stylesheet" />
    <link href="{{asset('css/font-awesome.min.css')}}" rel="stylesheet" />


    <link href="{{asset('css/widgets.css')}}" rel="stylesheet">
      <link href="{{asset('css/styles.css')}}" rel="stylesheet">
      <link href="{{asset('css/style-responsive.css')}}" rel="stylesheet" />


         <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
         <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>



  </head>
  <body>
  @include('admin.admin_header')

@yield('content')

 

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->

      <!-- bootstrap -->
      <script src="{{asset('js/bootstrap.min.js')}}"></script>
  <!-- nice scroll -->
  <script src="{{asset('js/jquery.scrollTo.min.js')}}"></script>
  <script src="{{asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>


  <!--custome script for all page-->
  <script src="{{asset('js/scripts.js')}}"></script>

  </body>
</html>