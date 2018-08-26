<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
   
    <link rel="icon" href="{{ asset('image/MJ LOGO.png') }}">
    <!-- Styles -->
   
    <link href="{{ asset('assets/css/bootstrap.css') }}" rel="stylesheet">
    <!--external css-->
    <link href="{{ asset('assets/font-awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/zabuto_calendar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/gritter/css/jquery.gritter.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/lineicons/style.css') }}">    
        
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/style-responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" >
    <link rel="stylesheet" 

        href="https://cdn.datatables.net/1.10.2/css/jquery.dataTables.min.css"></style>
    
</head>
<body class="fixed-nav sticky-footer " id="page-top">
   <section id="container" >   
    <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="{{ route('adminhome') }}" class="logo"><b>{{ config('app.name', 'Laravel') }}</b></a>
            <!--logo end-->
           
            <div class="top-menu">
                <ul class="nav pull-right top-menu">
                    <li><a class="btnlogout" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                    </li>
                </ul>
            </div>
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      
      <aside>     
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <p class="centered"><a href="{{ route('adminhome') }}"><img src="{{ asset('image/MJ LOGO.png') }}" class="img-circle" width="60"></a></p>
                  <h5 class="centered">Hello! {{ Auth::user()->name }}!</h5>
                    
                  <li class="mt">
                      <a @if (Request::is('adminhome')) class="active" href="" @elseif (Request::is('*')) href="{{ route('adminhome') }}" @endif >
                          <i class="fa fa-dashboard"></i>
                          <span>主頁</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a @if (Request::is('adminorder')) class="active" href="" @else href="{{ route('adminorder') }}" @endif >
                          <i class="fa fa-tasks"></i>
                          <span>+ 增加訂單</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a  @if (Request::is('adminorder_list')) class="active" href="" @else href="{{ route('adminorder_list') }}" @endif  >
                          <i class="fa fa-desktop"></i>
                          <span>訂單目錄</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="{{ route('adminorder_list') }}">訂單</a></li>
                          
                      </ul>
                  </li>
<!--
                  <li class="sub-menu">
                       <a  @if (Request::is('admin/events')) class="active" @endif href="javascript:;" >
                          <i class="fa fa-cogs"></i>
                          <span>Event Pages</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="calendar.html">Calendar</a></li>
                          <li><a  href="gallery.html">Gallery</a></li>
                          <li><a  href="todo_list.html">Todo List</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span>Extra Pages</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="blank.html">Blank Page</a></li>
                          <li><a  href="login.html">Login</a></li>
                          <li><a  href="lock_screen.html">Lock Screen</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-tasks"></i>
                          <span>Forms</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="form_component.html">Form Components</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-th"></i>
                          <span>Data Tables</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="basic_table.html">Basic Table</a></li>
                          <li><a  href="responsive_table.html">Responsive Table</a></li>
                      </ul>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class=" fa fa-bar-chart-o"></i>
                          <span>Charts</span>
                      </a>
                      <ul class="sub">
                          <li><a  href="morris.html">Morris</a></li>
                          <li><a  href="chartjs.html">Chartjs</a></li>
                      </ul>
                  </li>
-->
              </ul>
              <!-- sidebar menu end-->
          </div>          
      </aside>

      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->

          @yield('content')
 

      <!--main content end-->
      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2017 - MJ-Creation
              <a href="#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
      <!--footer end-->
  </section>

  <script src="{{ asset('assets/js/jquery.js') }}"></script>

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script class="include" type="text/javascript" src="{{ asset('assets/js/jquery.dcjqaccordion.2.7.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.scrollTo.min.js') }}"></script>
  
    <script src="{{ asset('assets/js/jquery.sparkline.js') }}"></script>
    <script src="{{ asset('assets/js/fancybox/jquery.fancybox.js') }}"></script>  

    <!--common script for all pages-->
    <script src="{{ asset('assets/js/common-scripts.js') }}"></script>

    
    <script type="text/javascript" src="{{ asset('assets/js/gritter/js/jquery.gritter.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/js/gritter-conf.js') }}"></script>

    <!--script for this page-->
    <script src="{{ asset('assets/js/sparkline-chart.js') }}"></script>    
    <script src="{{ asset('assets/js/zabuto_calendar.js') }}"></script>    
    <script type="text/javascript" 
        src="https://cdn.datatables.net/1.10.2/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" 
        src="https://cdn.datatables.net/plug-ins/1.10.16/sorting/numeric-comma.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
                $('#mytable').dataTable( {
                "columnDefs": [
                    { "type": "numeric-comma", targets: 0 }
                ]
            } );
        } );
         
    </script>
    
    
</body>
</html>
