<div class="left_col scroll-view">
    <div class="navbar nav_title" style="border: 0;">
        <a href="{{ route('dashboard') }}" class="site_title"><i class="fa fa-home"></i> <span>{{ env('APP_NAME')}}</span></a>
    </div>
    <div class="clearfix"></div>
    <!-- menu profile quick info -->
    <div class="profile clearfix">
        <div class="profile_pic">
            <img src="{{ asset('images/avatar.png') }}" alt="..." class="img-circle profile_img">
        </div>
        <div class="profile_info">
            <span>Welcome,</span>
            <h2>{{ ucwords(Auth::user()->name) }}</h2>
        </div>
        <div class="clearfix"></div>
    </div>
    <!-- /menu profile quick info -->
    <br />
    <!-- sidebar menu -->
    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
        <div class="menu_section">
            <h3>General</h3>
            <ul class="nav side-menu">
                
                <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Home </a></li><br>
            </ul>
            <ul>  
                <li><a href=" {{ Route('quiz.index') }}"><i class="fa fa-edit"></i> Manage Quiz </a></li>
            </ul>
        </div>
    </div>
    <!-- /sidebar menu -->
    
</div>