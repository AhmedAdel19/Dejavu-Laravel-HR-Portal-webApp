<header>
    <!-- Header Start -->
    <div class="header-area">
        <div class="main-header ">

            <div class="header-bottom  header-sticky">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-1 col-md-1">
                            <div class="logo">
                                @if(!(Auth::user()->Djv_Group === 'admin' || Auth::user()->Djv_Group === 'TopManager'|| Auth::user()->Djv_Group === 'hr'))

                                <div>
                                    <a href="{{url('home')}}">
                                        <img width="100" height="70" src="{{asset('storage/logos/logo.png')}}" alt="dejavu logo">
                                    </a>
                                </div>
                                @else
                                <a href="{{url('home')}}">
                                    <img width="100" height="70" src="{{asset('storage/logos/logo.png')}}" alt="dejavu logo">
                                </a>
                                @endif
                            </div>
                        </div>
                        <div>
                            <!-- Main-menu -->
                            <div style="margin-left:-100px;" class="main-menu f-right d-none d-lg-block">
                                <nav>
                                    <ul id="navigation">
                                        @if((Auth::user()->Djv_Group === 'admin' || Auth::user()->Djv_Group === 'TopManager'|| Auth::user()->Djv_Group === 'hr'))
                                        <li><a href="{{url('home')}}">Home</a></li>
                                        {{-- @else
                                      <li><a href="{{url('home')}}">Home</a></li> --}}
                                        @endif

                                        @if((Auth::user()->Djv_Group === 'admin' || Auth::user()->Djv_Group === 'TopManager'|| Auth::user()->Djv_Group === 'hr'))
                                        <li><a href="#">Employees</a>
                                            <ul style="width: 153%" class="submenu">
                                                <li><a href="{{ url('/register') }}"><i style="font-size: 12px" class="fas fa-user-plus mr-2 ml-1"></i>Add New Employee</a></li>
                                                <li><a href="{{ url('upload') }}"><i style="font-size: 12px" class="fas fa-plus-circle mr-2 ml-1"></i>Add All</a></li>
                                                <li><a href="{{ url('employees') }}"><i style="font-size: 12px" class="fas fa-search mr-2 ml-1"></i>Search Employee</a></li>
                                            </ul>
                                        </li>
                                        {{-- @else
                                    <li><a href="blog.html">Employees</a>
                                      <ul class="submenu">
                                          <li><a href="blog.html">Blog</a></li>
                                          <li><a href="single-blog.html">Blog Details</a></li>
                                      </ul>
                                    </li> --}}
                                        @endif

                                        @if((Auth::user()->Djv_Group === 'admin' || Auth::user()->Djv_Group === 'TopManager'|| Auth::user()->Djv_Group === 'hr'))
                                        <li><a href="#">Employees Salary</a>
                                            <ul class="submenu">
                                                <li><a href="{{url('/wMessages')}}"><i style="font-size: 12px" class="fas fa-calculator mr-2"></i>Send Whats messages</a></li>
                                                <!-- <li><a href="{{url('upload_salary')}}"><i style="font-size: 12px" class="fas fa-plus-circle mr-2 ml-1"></i>Add To All</a></li> -->
                                            </ul>
                                        </li>
                                        <li><a href="#">Employees Balance</a>
                                            <ul class="submenu">
                                                <li><a href="{{url('employees_balance/search_balance')}}"><i style="font-size: 12px" class="fas fa-calculator mr-2"></i>Add New Employee Balance</a></li>
                                                <li><a href="{{url('upload_balance')}}"><i style="font-size: 12px" class="fas fa-plus-circle mr-2 ml-1"></i>Add To All</a></li>
                                            </ul>
                                        </li>
                                        {{-- @else
                                  <li><a href="blog.html">Employees Balance</a>
                                    <ul class="submenu">
                                        <li><a href="blog.html">Blog</a></li>
                                        <li><a href="single-blog.html">Blog Details</a></li>
                                    </ul>
                                  </li> --}}
                                        @endif

                                        @if((Auth::user()->Djv_Group === 'admin' || Auth::user()->Djv_Group === 'TopManager'|| Auth::user()->Djv_Group === 'hr'))
                                        <li><a href="#">Employee Notifications</a>
                                            <ul class="submenu">
                                                <li><a href="{{url('employees_notify/search_notification')}}"><i style="font-size: 12px" class="fas fa-bell mr-2 ml-1"></i>Add Employee Notification</a></li>
                                                <li><a href="{{url('employees_notify/group_notification')}}"><i style="font-size: 12px" class="fas fa-users mr-2 ml-1"></i>Add Group Notification</a></li>
                                                <li><a href="{{url('upload_note')}}"><i style="font-size: 12px" class="fas fa-plus-circle mr-2 ml-1"></i>Add To All</a></li>
                                            </ul>
                                        </li>
                                        {{-- @else
                                <li><a href="blog.html">Employee Notifications</a>
                                  <ul class="submenu">
                                      <li><a href="{{url('generaklNotifications')}}">Add General Notification</a></li>i>
                                    </ul>
                                    </li> --}}
                                    @endif

                                    @if((Auth::user()->Djv_Group === 'admin' || Auth::user()->Djv_Group === 'TopManager'|| Auth::user()->Djv_Group === 'hr'))
                                    <li><a href="#">General Notifications</a>
                                        <ul class="submenu">
                                            <li><a href="{{url('generaklNotifications')}}"><i style="font-size: 12px" class="fas fa-bell mr-2 ml-1"></i>Add General Notification</a></li>
                                        </ul>
                                    </li>


                                    {{-- @else
                              <li><a href="blog.html">Employee Notifications</a>
                                <ul class="submenu">
                                    <li><a href="blog.html">Blog</a></li>
                                    <li><a href="single-blog.html">Blog Details</a></li>
                                </ul>
                              </li> --}}
                                    @endif


                                    @if(!(Auth::user()->Djv_Group === 'admin' || Auth::user()->Djv_Group === 'TopManager'|| Auth::user()->Djv_Group === 'hr'))
                                    <li style="float: right; top: 0% ;right:100px; position: fixed" class="nav-item dropdown">

                                        <a class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="{{asset('storage/EmployeeProfileImages/'. Auth::user()->user_pp)}}" alt="user" class="rounded-circle" width="100" height="50">
                                            <span class="ml-2 user-text font-medium">{{Auth::user()->name}}</span>
                                        </a>
                                        <div class="dropdown-menu  user-dd animated flipInY">
                                            <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">

                                                {{-- <div  class="dropdown-menu dropdown-menu-right" style="left: 395% !important">
                                      <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom"> --}}
                                                <div class=""><img src="{{asset('storage/EmployeeProfileImages/'. Auth::user()->user_pp)}}" alt="user" class="rounded" width="80"></div>
                                                <div class="ml-2">
                                                    <h4 class="mb-0">{{Auth::user()->name}}</h4>
                                                    <p class=" mb-0 text-muted">{{Auth::user()->email}}</p>
                                                    <a style="padding: 20px" style="background-color: #021a47" href="{{url('profile')}}" class="btn btn-sm btn-danger text-white mt-2 btn-rounded">View Profile</a>
                                                </div>
                                            </div>

                                            <a style="padding: 10px" class="dropdown-item" href="{{url('profile')}}"><i style="font-size: 18px" class="ti-user mr-1 ml-1"></i> My Profile</a>
                                            <a style="padding: 10px" class="dropdown-item" href="{{url('employees_balance/' . Auth::user()->id) }}"><i style="font-size: 18px" class="ti-wallet mr-1 ml-1"></i> My Balance</a>
                                            <a style="padding: 10px" class="dropdown-item" href="{{url('employees_notify/' . Auth::user()->id) }}"><i style="font-size: 18px" class="fas fa-bell mr-2 ml-1"></i> My Notification</a>
                                            <a style="padding: 10px" class="dropdown-item" href="{{url('chatRoom')}}"><i style="font-size: 18px" class="fas fa-comments mr-1 ml-1"></i>Chat</a>

                                            <a style="padding: 10px" class="dropdown-item" href="{{url('complains/create')}}"><i style="font-size: 18px" class="fas fa-frown mr-1 ml-1"></i>My Complains</a>
                                            <div class="dropdown-divider"></div>
                                            <a style="padding: 10px" class="dropdown-item" href="javascript:void(0)"><i style="font-size: 18px" class="ti-settings mr-1 ml-1"></i> Account Setting</a>
                                            <div class="dropdown-divider"></div>
                                            @guest
                                    <li class="nav-item">
                                        <a style="padding: 10px" class="dropdown-item" href="{{ route('login') }}"><i class="fa fa-power-off mr-1 ml-1"></i> Login</a>
                                    </li>
                                    @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a style="padding: 10px" class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                    @endif
                                    @else
                                    @if(Auth::user()->Djv_Group === 'admin' || Auth::user()->Djv_Group === 'TopManager'|| Auth::user()->Djv_Group === 'hr')
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                 document.getElementById('logout-form').submit();">
                                        <i style="font-size: 18px" class="fa fa-power-off mr-1 ml-1"></i>
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                    @else
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
                            @else
                            <li style="float: right;top: 0% ; position: fixed" class="nav-item dropdown">
                                <a style="padding: 19px" class="nav-link dropdown-toggle waves-effect waves-dark pro-pic" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{asset('storage/EmployeeProfileImages/'. Auth::user()->user_pp)}}" alt="user" class="rounded-circle" width="100" height="60">
                                    <span class="ml-2 user-text font-medium">{{Auth::user()->name}}</span>
                                </a>
                                <div class="dropdown-menu  user-dd animated flipInY">
                                    <div class="d-flex no-block align-items-center p-3 mb-2 border-bottom">
                                        <div class=""><img src="{{asset('storage/EmployeeProfileImages/'. Auth::user()->user_pp)}}" alt="user" class="rounded" width="80"></div>
                                        <div class="ml-2">
                                            <h4 class="mb-0">{{Auth::user()->name}}</h4>
                                            <p class=" mb-0 text-muted">{{Auth::user()->email}}</p>
                                            <a style="padding: 20px" style="background-color: #021a47;padding: 10px" href="{{url('profile')}}" class="btn btn-sm btn-danger text-white mt-2 btn-rounded">View Profile</a>
                                        </div>
                                    </div>

                                    <a style="padding: 10px" class="dropdown-item" href="{{url('profile')}}"><i style="font-size: 18px" class="ti-user mr-1 ml-1"></i> My Profile</a>
                                    <a style="padding: 10px" class="dropdown-item" href="{{url('employees_balance/' . Auth::user()->id) }}"><i style="font-size: 18px" class="ti-wallet mr-1 ml-1"></i> My Balance</a>
                                    <a style="padding: 10px" class="dropdown-item" href="{{url('employees_notify/' . Auth::user()->id) }}"><i style="font-size: 18px" class="fas fa-bell mr-2 ml-1"></i> My Notifications</a>
                                    @if (Auth::user()->chat_flag == "yes")
                                    <a style="padding: 10px" class="dropdown-item" href="{{url('chatRoom')}}"><i style="font-size: 18px" class="fas fa-comments mr-1 ml-1"></i>Chat</a>
                                    @endif

                                    <a style="padding: 10px" class="dropdown-item" href="{{url('complains/')}}"><i style="font-size: 18px" class="fas fa-frown mr-1 ml-1"></i> Show Complains</a>
                                    <div class="dropdown-divider"></div>
                                    <a style="padding: 10px" class="dropdown-item" href="javascript:void(0)"><i style="font-size: 18px" class="ti-settings mr-1 ml-1"></i> Account Setting</a>
                                    <div class="dropdown-divider"></div>
                                    @guest
                            <li class="nav-item">
                                <a style="padding: 10px" class="dropdown-item" href="{{ route('login') }}"><i class="fa fa-power-off mr-1 ml-1"></i> Login</a>
                            </li>
                            @if (Route::has('register'))
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                            @endif
                            @else
                            @if(Auth::user()->Djv_Group === 'admin' || Auth::user()->Djv_Group === 'TopManager'|| Auth::user()->Djv_Group === 'hr')
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                     document.getElementById('logout-form').submit();">
                                <i style="font-size: 18px" class="fa fa-power-off mr-1 ml-1"></i>
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            @else
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
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
                        @endif

                        </ul>
                        </nav>
                    </div>
                </div>
                <!-- Mobile Menu -->
                <div class="col-12">
                    <div class="mobile_menu d-block d-lg-none"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <!-- Header End -->
</header>