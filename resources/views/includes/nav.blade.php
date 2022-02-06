<header> 
    <nav class="navbar navbar-expand-md" >

        <div  class="header-area">

            <div id="sticky-header" class="main-header-area">
                <div class="container-fluid">
                    <div class="header_bottom_border">
                        <!--start logo handle-->
                        <div class="row align-items-center">
                            @if(!(Auth::user()->Djv_Group === 'admin' || Auth::user()->Djv_Group === 'TopManager'|| Auth::user()->Djv_Group === 'hr'))

                            <div >
                                <div style="margin-left:600%" class="logo">
                                    <a href="{{url("home")}}">
                                        <img width="100" height="70" src="{{asset('storage/logos/logo.png')}}" alt="dejavu logo">
                                    </a>
                                </div>
                            </div>
                            @else    
                            <div class="col-xl-1 ml-2">
                                <div class="logo">
                                    <a href="{{url("home")}}">
                                        <img width="100" height="70" src="{{asset('storage/logos/logo.png')}}" alt="dejavu logo">
                                    </a>
                                </div>
                            </div>
                            @endif

                            <!--end logo handle-->
                            <div class="col-xl-5 col-lg-6 ml-3 mt-3">
                                <div class="main-menu  d-none d-lg-block ">
                                        <ul style="width: 1200px" id="navigation">


                                            <!--start home handle-->
                                            @if((Auth::user()->Djv_Group === 'admin' || Auth::user()->Djv_Group === 'TopManager'|| Auth::user()->Djv_Group === 'hr'))
                                            <li><a style="font-size: 17px; font-weight: bold ;font-family: Arial" class="active" href="{{url("home")}}">home</a></li>
                                            {{-- @else
                                            <li><a style="font-size: 17px; font-weight: bold ;font-family: Arial" class="active" href="{{url("home")}}">home</a></li>      --}}
                                            @endif
                                            <!--end home handle-->

                                            <!--start navbar control-->
                                            @if(Auth::user()->Djv_Group === 'admin' || Auth::user()->Djv_Group === 'TopManager'|| Auth::user()->Djv_Group === 'hr')
                                            <li><a style="font-size: 17px; font-weight: bold ;font-family: Arial" href="#">Employees <i class="ti-angle-down"></i></a>
                                                <ul style="width: 250px" class="submenu">
                                                        <li><a style="font-size: 17px; font-weight: bold ;font-family: Arial" href="{{ url('/register') }}"><i style="font-size: 12px" class="fas fa-user-plus mr-2 ml-1"></i>Add New Employee</a></li>
                                                        <li><a style="font-size: 17px; font-weight: bold ;font-family: Arial" href="{{ url('upload') }}"><i style="font-size: 12px" class="fas fa-plus-circle mr-2 ml-1"></i>Add All</a></li>
                                                        <li><a style="font-size: 17px; font-weight: bold ;font-family: Arial" href="{{ url('employees') }}"><i style="font-size: 12px" class="fas fa-search mr-2 ml-1"></i>Search Employee</a></li>
                                                </ul>
                                            </li>
                                            <li><a style="font-size: 17px; font-weight: bold ;font-family: Arial" href="#">Employees Balance <i class="ti-angle-down"></i></a>
                                                <ul style="width: 310px" class="submenu">
                                                        <li><a style="font-size: 17px; font-weight: bold ;font-family: Arial" href="{{url("employees_balance/search_balance")}}"><i style="font-size: 12px" class="fas fa-calculator mr-2"></i>Add New Employee Balance</a></li>
                                                        <li><a style="font-size: 17px; font-weight: bold ;font-family: Arial" href="{{url("upload_balance")}}"><i style="font-size: 12px" class="fas fa-plus-circle mr-2 ml-1"></i>Add To All</a></li>
                                                </ul>
                                            </li>
                                            <li><a style="font-size: 17px; font-weight: bold ;font-family: Arial" href="#">Employee Notifications <i class="ti-angle-down"></i></a>
                                                <ul style="width: 310px" class="submenu">
                                                        <li><a style="font-size: 17px; font-weight: bold ;font-family: Arial" href="{{url("employees_notify/search_notification")}}"><i style="font-size: 12px" class="fas fa-bell mr-2 ml-1"></i>Add Employee Notification</a></li>
                                                        <li><a style="font-size: 17px; font-weight: bold ;font-family: Arial" href="{{url("employees_notify/group_notification")}}"><i style="font-size: 12px" class="fas fa-users mr-2 ml-1"></i>Add Group Notification</a></li>
                                                        <li><a style="font-size: 17px; font-weight: bold ;font-family: Arial" href="{{url("upload_note")}}"><i style="font-size: 12px" class="fas fa-plus-circle mr-2 ml-1"></i>Add To All</a></li>
                                                </ul>
                                            </li>

                                            <li><a style="font-size: 17px; font-weight: bold ;font-family: Arial" href="#">Employee Notifications <i class="ti-angle-down"></i></a>
                                                <ul style="width: 290px" class="submenu">
                                                        <li><a style="font-size: 17px; font-weight: bold ;font-family: Arial" href="{{url("generaklNotifications")}}"><i style="font-size: 12px" class="fas fa-bell mr-2 ml-1"></i>Add General Notification</a></li>
                                                </ul>
                                            </li>
                                        
                                        @endif

                                         <!-- User profile and search -->
                    <!-- ============================================================== -->
                    @if(!(Auth::user()->Djv_Group === 'admin' || Auth::user()->Djv_Group === 'TopManager'|| Auth::user()->Djv_Group === 'hr'))
                    <li style="float: right; margin-bottom: 20px" class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="index.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{asset('storage/EmployeeProfileImages/'. Auth::user()->user_pp)}}" alt="user" class="rounded-circle" width="100" height="50">
                        <span class="ml-2 user-text font-medium">{{Auth::user()->name}}</span>
                        </a>
                        <div  class="dropdown-menu dropdown-menu-right user-dd animated flipInY">
                            <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                                <div class=""><img src="{{asset('storage/EmployeeProfileImages/'. Auth::user()->user_pp)}}" alt="user" class="rounded" width="80"></div>
                                <div class="ml-2">
                                    <h4 class="mb-0">{{Auth::user()->name}}</h4>
                                    <p class=" mb-0 text-muted">{{Auth::user()->email}}</p>
                                    <a href="{{url('profile')}}" class="btn btn-sm btn-danger text-white mt-2 btn-rounded">View Profile</a>
                                </div>
                            </div>

                            <a class="dropdown-item" href="{{url("profile")}}"><i style="font-size: 18px" class="ti-user mr-1 ml-1"></i> My Profile</a>
                            <a class="dropdown-item" href="{{url('employees_balance/' . Auth::user()->id) }}"><i style="font-size: 18px" class="ti-wallet mr-1 ml-1"></i> My Balance</a>
                            <a class="dropdown-item" href="{{url('employees_notify/' . Auth::user()->id) }}"><i style="font-size: 18px" class="fas fa-bell mr-2 ml-1"></i> My Notification</a>

                            <a class="dropdown-item" href="{{url("complains/create")}}"><i style="font-size: 18px" class="fas fa-frown mr-1 ml-1"></i>Send Complain</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i style="font-size: 18px" class="ti-settings mr-1 ml-1"></i> Account Setting</a>
                            <div class="dropdown-divider"></div>
                            @guest
                            <li class="nav-item">
                                <a class="dropdown-item" href="{{ route('login') }}"><i class="fa fa-power-off mr-1 ml-1"></i> Login</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">  
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            @else
                            @if(Auth::user()->Djv_Group === 'admin' || Auth::user()->Djv_Group === 'TopManager'|| Auth::user()->Djv_Group === 'hr')
                                   <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault();
                                                       document.getElementById('logout-form').submit();">
                                                       <i style="font-size: 18px" class="fa fa-power-off mr-1 ml-1"></i>
                                          {{ __('Logout') }}
                                      </a>
                       
                                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                          @csrf
                                      </form>
                              @else                     
                                 <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                     <i style="font-size: 18px" class="fa fa-power-off mr-1 ml-1"></i>
                                        {{ __('Logout') }}
                                    </a>
                     
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                               @endif
                          @endguest
                        </div>
                    </li>
                    </ul>
                    @else
                    <ul class="navbar-nav float-right">
                        <li style="float: right" class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="index.html" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{asset('storage/EmployeeProfileImages/'. Auth::user()->user_pp)}}" alt="user" class="rounded-circle" width="100" height="60">
                            <span class="ml-2 user-text font-medium">{{Auth::user()->name}}</span>
                            </a>
                            <div  class="dropdown-menu  user-dd animated flipInY">
                                <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                                    <div class=""><img src="{{asset('storage/EmployeeProfileImages/'. Auth::user()->user_pp)}}" alt="user" class="rounded" width="80"></div>
                                    <div class="ml-2">
                                        <h4 class="mb-0">{{Auth::user()->name}}</h4>
                                        <p class=" mb-0 text-muted">{{Auth::user()->email}}</p>
                                        <a href="{{url("profile")}}" class="btn btn-sm btn-danger text-white mt-2 btn-rounded">View Profile</a>
                                    </div>
                                </div>
    
                                <a class="dropdown-item" href="{{url("profile")}}"><i style="font-size: 18px" class="ti-user mr-1 ml-1"></i> My Profile</a>
                                <a class="dropdown-item" href="{{url('employees_balance/' . Auth::user()->id) }}"><i style="font-size: 18px" class="ti-wallet mr-1 ml-1"></i> My Balance</a>
                                <a class="dropdown-item" href="{{url('employees_notify/' . Auth::user()->id) }}"><i style="font-size: 18px" class="fas fa-bell mr-2 ml-1"></i> My Notifications</a>

                                <a class="dropdown-item" href="{{url("complains/")}}"><i style="font-size: 18px" class="fas fa-frown mr-1 ml-1"></i> Show Complains</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="javascript:void(0)"><i style="font-size: 18px" class="ti-settings mr-1 ml-1"></i> Account Setting</a>
                                <div class="dropdown-divider"></div>
                                @guest
                                <li class="nav-item">
                                    <a class="dropdown-item" href="{{ route('login') }}"><i class="fa fa-power-off mr-1 ml-1"></i> Login</a>
                                </li>
                                @if (Route::has('register'))
                                    <li class="nav-item">  
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                @endif
                                @else
                                @if(Auth::user()->Djv_Group === 'admin' || Auth::user()->Djv_Group === 'TopManager'|| Auth::user()->Djv_Group === 'hr')
                                       <a class="dropdown-item" href="{{ route('logout') }}"
                                             onclick="event.preventDefault();
                                                           document.getElementById('logout-form').submit();">
                                                           <i style="font-size: 18px" class="fa fa-power-off mr-1 ml-1"></i>
                                              {{ __('Logout') }}
                                          </a>
                           
                                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                              @csrf
                                          </form>
                                  @else                     
                                     <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                                         <i style="font-size: 18px" class="fa fa-power-off mr-1 ml-1"></i>
                                            {{ __('Logout') }}
                                        </a>
                         
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                   @endif
                              @endguest
                            </div>
                        </li>
                        </ul>
                    @endif
                    <!-- ============================================================== -->
                    <!-- User profile and search -->
                    <!-- ============================================================== -->
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </nav>
    </header>
    <hr/>.

