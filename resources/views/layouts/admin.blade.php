<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta charset="utf-8"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Two menu - Ace Admin</title>

    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0"/>

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}"/>

    <!-- page specific plugin styles -->
    @yield('page-level-style')

<!-- text fonts -->
    <link rel="stylesheet" href="{{ asset('assets/css/fonts.googleapis.com.css') }}"/>
    <!-- ace styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/ace.min.css') }}" class="ace-main-stylesheet"
          id="main-ace-style"/>
    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{ asset('assets/css/ace-part2.min.css') }}" class="ace-main-stylesheet"/>
    <![endif]-->
    <link rel="stylesheet" href="{{ asset('assets/css/ace-skins.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('assets/css/ace-rtl.min.css') }}"/>

    <!--[if lte IE 9]>
    <link rel="stylesheet" href="{{ asset('assets/css/ace-ie.min.css') }}"/>
    <![endif]-->

    <link rel="stylesheet" href="{{ asset('css/main.css') }}"/>

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="{{ asset('assets/js/ace-extra.min.js') }}"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
    <script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
    <script src="{{ asset('assets/js/respond.min.js') }}"></script>
    <![endif]-->
</head>

<body class="no-skin">
<div id="navbar" class="navbar navbar-default    navbar-collapse       ace-save-state">
    <div class="navbar-container ace-save-state" id="navbar-container">
        <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
            <span class="sr-only">Toggle sidebar</span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>

            <span class="icon-bar"></span>
        </button>

        <div class="navbar-header pull-left">
            <a href="index.html" class="navbar-brand">
                <small>
                    <i class="fa fa-leaf"></i>
                    Ace Admin
                </small>
            </a>

            <button class="pull-right navbar-toggle navbar-toggle-img collapsed" type="button" data-toggle="collapse"
                    data-target=".navbar-buttons">
                <span class="sr-only">Toggle user menu</span>

                <img src="{{ asset('upload/avatar/') . '/' . Auth::user()->avatar }}"
                     alt="{{ Auth::user()->name }}'s Photo"/>
            </button>
        </div>

        <div class="navbar-buttons navbar-header pull-right  collapse navbar-collapse" role="navigation">
            <ul class="nav ace-nav">
                <li class="purple dropdown-modal">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                        <span class="badge badge-danger">5</span>
                    </a>

                    <div class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                        <div class="tabbable">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a data-toggle="tab" href="#navbar-messages">
                                        Messages
                                        <span class="badge badge-danger">5</span>
                                    </a>
                                </li>
                            </ul><!-- .nav-tabs -->

                            <div class="tab-content">
                                <div id="navbar-messages" class="tab-pane in active">
                                    <ul class="dropdown-menu-right dropdown-navbar dropdown-menu">
                                        <li class="dropdown-content">
                                            <ul class="dropdown-menu dropdown-navbar">
                                                <li>
                                                    <a href="#">
                                                        <img src="{{ asset('assets/images/avatars/avatar2.png') }}"
                                                             class="msg-photo"
                                                             alt="Kate's Avatar"/>
                                                        <span class="msg-body">
                                                            <span class="msg-title">
                                                                <span class="blue">Kate:</span>
                                                                Ciao sociis natoque eget urna mollis ornare ...
                                                            </span>

                                                            <span class="msg-time">
                                                                <i class="ace-icon fa fa-clock-o"></i>
                                                                <span>1:33 pm</span>
                                                            </span>
                                                        </span>
                                                    </a>
                                                </li>
                                                <li class="dropdown-footer">
                                                    <a href="inbox.html">
                                                        See all messages
                                                        <i class="ace-icon fa fa-arrow-right"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div><!-- /.tab-pane -->
                            </div><!-- /.tab-content -->
                        </div><!-- /.tabbable -->
                    </div><!-- /.dropdown-menu -->
                </li>

                <li class="light-blue dropdown-modal">
                    <a data-toggle="dropdown" href="#" class="dropdown-toggle">
                        <img class="nav-user-photo" src="/upload/avatar/{{ Auth::user()->avatar }}"
                             alt="Jason's Photo"/>
                        <span class="user-info">
                            <small><b>Welcome,</b></small>
                            {{ strtoupper(Auth::user()->name) }}
                        </span>

                        <i class="ace-icon fa fa-caret-down"></i>
                    </a>

                    <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                        <li>
                            <a href="#">
                                <i class="ace-icon fa fa-cog"></i>
                                Settings
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('profile') }}">
                                <i class="ace-icon fa fa-user"></i>
                                Profile
                            </a>
                        </li>

                        <li class="divider"></li>

                        <li>
                            <a href="#" id="logout">
                                <i class="ace-icon fa fa-power-off"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div><!-- /.navbar-container -->
</div>


<div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
        try {
            ace.settings.loadState('main-container')
        } catch (e) {
        }

    </script>

    <div id="sidebar" class="sidebar                  responsive                    ace-save-state">
        <script type="text/javascript">
            try {
                ace.settings.loadState('sidebar')
            } catch (e) {
            }
        </script>

        <div class="sidebar-shortcuts" id="sidebar-shortcuts">
            <div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
                <button class="btn btn-success">
                    <i class="ace-icon fa fa-signal"></i>
                </button>

                <button class="btn btn-info">
                    <i class="ace-icon fa fa-pencil"></i>
                </button>

                <button class="btn btn-warning">
                    <i class="ace-icon fa fa-users"></i>
                </button>

                <button class="btn btn-danger">
                    <i class="ace-icon fa fa-cogs"></i>
                </button>
            </div>

            <div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
                <span class="btn btn-success"></span>

                <span class="btn btn-info"></span>

                <span class="btn btn-warning"></span>

                <span class="btn btn-danger"></span>
            </div>
        </div><!-- /.sidebar-shortcuts -->

        <ul class="nav nav-list">
            <li class="">
                <a href="{{ route('home') }}">
                    <i class="menu-icon fa fa-tachometer"></i>
                    <span class="menu-text"> Dashboard </span>
                </a>

                <b class="arrow"></b>
            </li>

            <li class="">
                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-desktop"></i>
                    <span class="menu-text">
                        UI &amp; Elements
                    </span>

                    <b class="arrow fa fa-angle-down"></b>
                </a>

                <b class="arrow"></b>

                <ul class="submenu">
                    <li class="active open">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-caret-right"></i>

                            Layouts
                            <b class="arrow fa fa-angle-down"></b>
                        </a>
                        <b class="arrow"></b>
                        <ul class="submenu">
                            <li class="">
                                <a href="top-menu.html">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Top Menu
                                </a>

                                <b class="arrow"></b>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="">
                <a href="widgets.html">
                    <i class="menu-icon fa fa-list-alt"></i>
                    <span class="menu-text"> Widgets </span>
                </a>

                <b class="arrow"></b>
            </li>

            @if (Auth::user()->isAdmin())
                <li class="{{ $sPage === 'post' ? 'active open' : '' }}">
                    <a href="#" class="dropdown-toggle">
                        <i class="menu-icon fa fa-desktop"></i>
                        <span class="menu-text">
                        Post
                    </span>

                        <b class="arrow fa fa-angle-down"></b>
                    </a>

                    <b class="arrow"></b>

                    <ul class="submenu">
                        <li class="{{ $sSub === 'view' ? 'active' : '' }}">
                            <a href="{{ route('post') }}">
                                View
                            </a>
                            <b class="arrow"></b>
                        </li>
                        <li class="{{ $sSub === 'create' ? 'active' : '' }}">
                            <a href="{{ route('post.create') }}">
                                Create
                            </a>
                            <b class="arrow"></b>
                        </li>
                    </ul>
                </li>
            @endif

        </ul><!-- /.nav-list -->

        <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
            <i id="sidebar-toggle-icon" class="ace-icon fa fa-angle-double-left ace-save-state"
               data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
        </div>
    </div>

    <div class="main-content">
        <div class="main-content-inner">
            <div class="page-content">
                <div class="ace-settings-container" id="ace-settings-container">
                    <div class="btn btn-app btn-xs btn-warning ace-settings-btn" id="ace-settings-btn">
                        <i class="ace-icon fa fa-cog bigger-130"></i>
                    </div>

                    <div class="ace-settings-box clearfix" id="ace-settings-box">
                        <div class="pull-left width-50">
                            <div class="ace-settings-item">
                                <div class="pull-left">
                                    <select id="skin-colorpicker" class="hide">
                                        <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                        <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                        <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                        <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                    </select>
                                </div>
                                <span>&nbsp; Choose Skin</span>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state"
                                       id="ace-settings-navbar" autocomplete="off"/>
                                <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state"
                                       id="ace-settings-sidebar" autocomplete="off"/>
                                <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state"
                                       id="ace-settings-breadcrumbs" autocomplete="off"/>
                                <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl"
                                       autocomplete="off"/>
                                <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2 ace-save-state"
                                       id="ace-settings-add-container" autocomplete="off"/>
                                <label class="lbl" for="ace-settings-add-container">
                                    Inside
                                    <b>.container</b>
                                </label>
                            </div>
                        </div><!-- /.pull-left -->

                        <div class="pull-left width-50">
                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover"
                                       autocomplete="off"/>
                                <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact"
                                       autocomplete="off"/>
                                <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                            </div>

                            <div class="ace-settings-item">
                                <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight"
                                       autocomplete="off"/>
                                <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                            </div>
                        </div><!-- /.pull-left -->
                    </div><!-- /.ace-settings-box -->
                </div><!-- /.ace-settings-container -->

                <div class="row">
                    <div class="col-xs-12">
                        <!-- PAGE CONTENT BEGINS -->
                        <div class="invisible">
                            <button data-target="#sidebar2" data-toggle="collapse" type="button"
                                    class="pull-left navbar-toggle collapsed">
                                <span class="sr-only">Toggle sidebar</span>

                                <i class="ace-icon fa fa-dashboard white bigger-125"></i>
                            </button>

                            <div id="sidebar2" class="sidebar h-sidebar navbar-collapse collapse ace-save-state">
                                <ul class="nav nav-list">
                                    <li class="hover">
                                        <a href="#">
                                            <i class="menu-icon fa fa-tachometer"></i>
                                            <span class="menu-text"> Dashboard </span>
                                        </a>

                                        <b class="arrow"></b>
                                    </li>

                                    <li class="hover">
                                        <a class="dropdown-toggle" href="#">
                                            <i class="menu-icon fa fa-tag"></i>
                                            <span class="menu-text"> More Pages </span>

                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>

                                        <b class="arrow"></b>

                                        <ul class="submenu">
                                            <li class="hover">
                                                <a href="#">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    User Profile
                                                </a>

                                                <b class="arrow"></b>
                                            </li>

                                            <li class="hover">
                                                <a href="#">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Inbox
                                                </a>

                                                <b class="arrow"></b>
                                            </li>

                                            <li class="hover">
                                                <a href="#">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Pricing Tables
                                                </a>

                                                <b class="arrow"></b>
                                            </li>

                                            <li class="hover">
                                                <a href="#">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Invoice
                                                </a>

                                                <b class="arrow"></b>
                                            </li>

                                            <li class="hover">
                                                <a href="#">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Timeline
                                                </a>

                                                <b class="arrow"></b>
                                            </li>

                                            <li class="hover">
                                                <a href="#">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Email Templates
                                                </a>

                                                <b class="arrow"></b>
                                            </li>

                                            <li class="hover">
                                                <a href="#">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Login &amp; Register
                                                </a>

                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="hover">
                                        <a class="dropdown-toggle" href="#">
                                            <i class="menu-icon fa fa-file-o"></i>

                                            <span class="menu-text">
                                                Other Pages
                                                <span class="badge badge-primary">5</span>
                                            </span>

                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>

                                        <b class="arrow"></b>

                                        <ul class="submenu">
                                            <li class="hover">
                                                <a href="#">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    FAQ
                                                </a>

                                                <b class="arrow"></b>
                                            </li>

                                            <li class="hover">
                                                <a href="#">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Error 404
                                                </a>

                                                <b class="arrow"></b>
                                            </li>

                                            <li class="hover">
                                                <a href="#">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Error 500
                                                </a>

                                                <b class="arrow"></b>
                                            </li>

                                            <li class="hover">
                                                <a href="#">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Grid
                                                </a>

                                                <b class="arrow"></b>
                                            </li>

                                            <li class="hover">
                                                <a href="#">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Blank Page
                                                </a>

                                                <b class="arrow"></b>
                                            </li>
                                        </ul>
                                    </li>
                                </ul><!-- /.nav-list -->
                            </div><!-- .sidebar -->
                        </div>

                        <div class="row">
                            <div class="col-xs-12">
                                @yield('content')
                            </div>
                        </div>

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->

    <div class="footer">
        <div class="footer-inner">
            <div class="footer-content">
                <span class="bigger-120">
                    <span class="blue bolder">Ace</span>
                    Application &copy; 2013-2014
                </span>

                &nbsp; &nbsp;
                <span class="action-buttons">
                    <a href="#">
                        <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                    </a>

                    <a href="#">
                        <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                    </a>
                </span>
            </div>
        </div>
    </div>
    <form id="logout-form" method="POST" action="{{ route('logout') }}" hidden="hidden">
        {{ csrf_field() }}
    </form>
    <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
        <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
    </a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="{{ asset('assets/js/jquery-2.1.4.min.js') }}"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
<![endif]-->
<script type="text/javascript">
    if ('ontouchstart' in document.documentElement) document.write("<script src='{{ asset('assets/js/jquery.mobile.custom.min.js') }}'>" + "<" + "/script>");
</script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

<!-- page specific plugin scripts -->

<!-- ace scripts -->
<script src="{{ asset('assets/js/ace-elements.min.js') }}"></script>
<script src="{{ asset('assets/js/ace.min.js') }}"></script>


<!-- Page Level Script -->
@yield('page-level-script')

<!-- inline scripts related to this page -->
<script type="text/javascript">
    jQuery(function ($) {
        $('#sidebar2').insertBefore('.page-content');

        $('.navbar-toggle[data-target="#sidebar2"]').insertAfter('#menu-toggler');


        $(document).on('settings.ace.two_menu', function (e, event_name, event_val) {
            if (event_name == 'sidebar_fixed') {
                if ($('#sidebar').hasClass('sidebar-fixed')) {
                    $('#sidebar2').addClass('sidebar-fixed');
                    $('#navbar').addClass('h-navbar');
                }
                else {
                    $('#sidebar2').removeClass('sidebar-fixed')
                    $('#navbar').removeClass('h-navbar');
                }
            }
        }).triggerHandler('settings.ace.two_menu', ['sidebar_fixed', $('#sidebar').hasClass('sidebar-fixed')]);
    });
    $('#logout').click(function () {
        console.log('clicked');
        $('#logout-form').submit();
    });
</script>
</body>
</html>


