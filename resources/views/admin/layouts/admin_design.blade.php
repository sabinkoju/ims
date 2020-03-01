<!DOCTYPE html>
<html lang="en">
<!-- BEGIN HEAD -->

@include('admin.layouts.head')
<!-- END HEAD -->

<body
        class="page-header-fixed sidemenu-closed-hidelogo page-content-white page-md header-white white-sidebar-color logo-indigo">
<div class="page-wrapper">
    <!-- start header -->
    <div class="page-header navbar navbar-fixed-top">
        <div class="page-header-inner ">
            <!-- logo start -->
            <div class="page-logo">
                <a href="{{ route('admin.dashboard') }}">
                    <span class="logo-icon material-icons fa-rotate-45">school</span>
                    <span class="logo-default">{{ $site->short_name }}</span> </a>
            </div>
            <!-- logo end -->
            <ul class="nav navbar-nav navbar-left in">
                <li><a class="menu-toggler sidebar-toggler"><i class="icon-menu"></i></a></li>
            </ul>
      <!--      <form class="search-form-opened" action="#" method="GET">-->
      <!--          <div class="input-group">-->
      <!--              <input type="text" class="form-control" placeholder="Search..." name="query">-->
      <!--              <span class="input-group-btn">-->
						<!--	<a href="javascript:;" class="btn submit">-->
						<!--		<i class="icon-magnifier"></i>-->
						<!--	</a>-->
						<!--</span>-->
      <!--          </div>-->
      <!--      </form>-->
            <!-- start mobile menu -->
            <a href="javascript:;" class="menu-toggler responsive-toggler" data-toggle="collapse"
               data-target=".navbar-collapse">
                <span></span>
            </a>
            <!-- end mobile menu -->
            <!-- start header menu -->
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">
                    <li><a href="javascript:;" class="fullscreen-btn"><i class="fa fa-arrows-alt"></i></a></li>
                    <!-- start language menu -->

                    <!-- end language menu -->


                    <?php $current_user = auth()->user(); ?>
                    <!-- start manage user dropdown -->
                    <li class="dropdown dropdown-user">
                        <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown"
                           data-close-others="true">
                            @if($current_user->image == "NULL")
                                <img alt="" class="img-circle " src="{{ asset('public/uploads/profile/profile.png') }}" />
                            @else
                                <img alt="" class="img-circle " src="{{ asset('public/uploads/profile/'.  auth()->user()->image ) }}" />
                            @endif
                                <span class="username username-hide-on-mobile"> {{  auth()->user()->name }} </span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">
                            <li>
                                <a href="{{ route('admin.profile') }}">
                                    <i class="icon-user"></i> Profile </a>
                            </li>
                            <li>
                                <a href="{{ route('changePassword') }}">
                                    <i class="icon-settings"></i> Change Password
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('imsLogout') }}">
                                    <i class="icon-logout"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                    <!-- end manage user dropdown -->

                </ul>
            </div>
        </div>
    </div>
    <!-- end header -->

    <!-- start page container -->
    <div class="page-container">
        <!-- start sidebar menu -->
    @include('admin.layouts.sidebar')

    <!-- end sidebar menu -->
        <!-- start page content -->

        <div class="page-content-wrapper">
            @yield('content')
        </div>
        <!-- end page content -->
        <!-- start chat sidebar -->

    </div>
    <!-- end page container -->
    <!-- start footer -->

@include('admin.layouts.footer')