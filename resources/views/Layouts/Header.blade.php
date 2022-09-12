<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>H</b>S</span>
        <!-- logo for regular state and mobile devices -->
        <!-- dibawah ini kita rubah env dan panggil dengan config -->
        <span class="logo-lg">{{ config ('app.name' ) }}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image"> -->
                        <img src="{{asset('img/hendristore3.jpeg')}}" class="img-circle" alt="User Image" width="17">
                        <span class="hidden-xs">{{auth()->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <!-- <img src="{{asset('/AdminLTE-2/dist/img/user2-160x160.jpg')}}" alt="User Image"> -->
                            <img src="{{asset('img/hendristore3.jpeg')}}" class="img-circle" alt="User Image" width="150">

                            <p>
                                {{auth()->user()->name}}- {{auth()->user()->email}}
                            </p>
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="#" class="btn btn-default btn-flat" onclick="document.getElementById('logout-form').submit()">Keluar</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>

<form action="{{route('logout')}}" method="post" style="display:none" id="logout-form">
    @csrf
</form>