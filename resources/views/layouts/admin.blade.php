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
    <input id="user_id" type="hidden" value="{{ Auth::user()->id }}" />
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
                @if (Auth::user()->isAdmin() === false)
                    <li class="purple dropdown-modal">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <i class="ace-icon fa fa-bell icon-animated-bell"></i>
                            @if (count(Auth::user()->recipient()->notViewed()->get()) > 0)
                                <span class="badge badge-danger message-counter">{{ count(Auth::user()->recipient()->notViewed()->get()) }}</span>
                            @endif
                        </a>

                        <div class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
                            <div class="tabbable">
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a data-toggle="tab" href="#navbar-messages">
                                            Messages
                                            @if (count(Auth::user()->recipient()->notViewed()->get()) > 0)
                                                <span class="badge badge-danger message-counter">{{ count(Auth::user()->recipient()->notViewed()->get()) }}</span>
                                            @endif
                                        </a>
                                    </li>
                                </ul><!-- .nav-tabs -->

                                <div class="tab-content">
                                    <div id="navbar-messages" class="tab-pane in active">
                                        <ul class="dropdown-menu-right dropdown-navbar dropdown-menu">
                                            <li class="dropdown-content">
                                                <ul class="dropdown-menu dropdown-navbar">
                                                    @foreach(Auth::user()->recipient()->orderBy('created_at', 'desc')->take(10)->get() as $oNotif)
                                                        <input type="hidden" value="{{ $oNotif->update(['notified_at' => date('Y-m-d')]) }}"/>
                                                        <li id="{{ $oNotif->post_id }}" class="messages" style="{{ is_null($oNotif->viewed_at) === true ?  'background-color: #eee' : ''}}">
                                                            <a href="#">
                                                                <img src="{{ asset('upload/avatar/') . '/' . $oNotif->post->user->avatar }}"
                                                                     class="msg-photo" alt="oks"/>
                                                                <span class="msg-body">
                                                                    <span class="msg-title">
                                                                        <span class="blue">{{ strtoupper($oNotif->post->user->name) }}</span>
                                                                        {{ $oNotif->post->title }}
                                                                    </span>

                                                                    <span class="msg-time">
                                                                        <i class="ace-icon fa fa-clock-o"></i>
                                                                        <span>{{ $oNotif->created_at->diffForHumans() }}</span>
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                    @if (count(Auth::user()->recipient()->get()) === 0)
                                                        <li>
                                                            <a href="#">
                                                                <span class="msg-body">
                                                                    <span class="msg-title">
                                                                        No new notifications
                                                                    </span>
                                                                </span>
                                                            </a>
                                                        </li>
                                                    @endif
                                                    <li class="dropdown-footer">
                                                        <a href="{{ route('post') }}">
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
                @endif

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

    <div id="sidebar" class="sidebar responsive ace-save-state">
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

            <!--<li class="">
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
            </li>-->

            <li class="{{ $sPage === 'post' ? 'active open' : '' }}">

                <a href="#" class="dropdown-toggle">
                    <i class="menu-icon fa fa-envelope"></i>
                    <span class="menu-text">
                        Messages
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
                    @if (Auth::user()->isAdmin())
                        <li class="{{ $sSub === 'create' ? 'active' : '' }}">
                            <a href="{{ route('post.create') }}">
                                Create
                            </a>
                            <b class="arrow"></b>
                        </li>
                    @endif
                </ul>
            </li>

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
                                            <i class="menu-icon fa fa-envelope"></i>
                                            <span class="menu-text"> Messages </span>

                                            <b class="arrow fa fa-angle-down"></b>
                                        </a>

                                        <b class="arrow"></b>

                                        <ul class="submenu">
                                            <li class="hover">
                                                <a href="{{ route('post') }}">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    View
                                                </a>

                                                <b class="arrow"></b>
                                            </li>
                                            @if (Auth::user()->isAdmin() === true)
                                            <li class="hover">
                                                <a href="{{ route('post.create') }}">
                                                    <i class="menu-icon fa fa-caret-right"></i>
                                                    Create
                                                </a>

                                                <b class="arrow"></b>
                                            </li>
                                            @endif

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

<div id="modal-wizard" class="modal">
    <div class="modal-dialog modal-width-90">
        <div class="modal-content">
            <div id="modal-wizard-container">
                <div class="modal-header center">

                </div>

                <div class="modal-body">
                    <ul class="steps">
                    </ul>
                    <hr/>
                    <table id="simple-table" class="table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th class="center">&nbsp;</th>
                            <th>Recipient Name</th>
                            <th>Received Date</th>
                            <th>Confirmation Date</th>
                            <th class="hidden-480">Date Forwarded</th>
                            <th>Status</th>
                        </tr>
                        </thead>

                        <tbody>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="modal-footer wizard-actions">

            </div>
        </div>
    </div>
</div>

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
    var iUserId = parseInt($('#user_id').val(), 10);

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

    function setRecipientStatus(iRecipientUserId, sStatus) {
        var aStatus = ['viewed', 'received', 'confirmed', 'forwarded'];
        if (aStatus.indexOf(sStatus) === -1) {
            return 'Status does not exists';
        }

        $.ajax({
            method: 'GET',
            url: '/recipient/' + sStatus + '/' + iRecipientUserId,
            dataType: 'json'
        }).done(function (resolve) {

        });
    }

    function generateRecipientTableData(oPost) {
        var sTable = '';
        var sRecipient = '';
        var bCurrentRecipient = false;
        var bReceived = false;
        var bConfirmed = false;
        var bForwarded = false;
        var iRecipientId = 0;
        if (typeof(oPost) === 'object') {
            oPost.recipient.map(function (recipient, index) {
                var iRecipientUserId = oPost.recipient[index].user_id;
                var oRecipient = oPost.recipient[index];
                var sAction = '';
                if (index === 0 && iUserId === iRecipientUserId && recipient.forwarded_at === null) {
                    bCurrentRecipient = true;
                    bReceived = (typeof(oRecipient.received_at) === 'string');
                    bConfirmed = (typeof(oRecipient.confirmed_at) === 'string');
                    bForwarded= (typeof(oRecipient.forwarded_at) === 'string');
                    iRecipientId = recipient.id;
                } else if (index > 0 && iUserId === iRecipientUserId) {
                    var mDateForwarded = oPost.recipient[index-1].forwarded_at;
                    if (typeof(mDateForwarded) === 'string') {
                        bCurrentRecipient = true;
                        bReceived = (typeof(oRecipient.received_at) === 'string');
                        bConfirmed = (typeof(oRecipient.confirmed_at) === 'string');
                        bForwarded= (typeof(oRecipient.forwarded_at) === 'string');
                        iRecipientId = recipient.id;
                    }
                }

                if (iUserId === recipient.user_id) {
                    setRecipientStatus(recipient.id, 'viewed');
                }

                var sStatus = 'pending';

                if (recipient.received_at !== null) {
                    sStatus = 'received';
                }

                if (recipient.confirmed_at !== null) {
                    sStatus = 'confirmed';
                }

                if (recipient.forwarded_at !== null) {
                    sStatus = 'forwarded';
                }

                if (bCurrentRecipient === true && iUserId === recipient.user_id) {
                    if (bReceived !== true) {
                        sAction = '<td class="td-width-1"><div class="hidden-sm hidden-xs action-buttons">' +
                            '<button class="btn btn-sm btn-warning btn-received"><i class="ace-icon fa fa-arrow-down"></i>Received</button>' +
                            '</div></td>';
                    }

                    if (bConfirmed !== true) {
                        if (bReceived === true) {
                            sAction = '<td class="td-width-1"><div class="hidden-sm hidden-xs action-buttons">' +
                                '<button class="btn btn-sm btn-primary btn-confirmed"><i class="ace-icon fa fa-arrow-down"></i>Confirmed/Signed</button>' +
                                '</div></td>';
                        }
                    }

                    if (bForwarded !== true) {
                        if (bReceived === true && bConfirmed === true) {
                            sAction = '<td class="td-width-1"><div class="hidden-sm hidden-xs action-buttons">' +
                                '<button class="btn btn-sm btn-next btn-forwarded"><i class="ace-icon fa fa-arrow-down"></i>Forwarded</button>' +
                                '</div></td>';
                        }
                    }

                }

                var sSelected = (sStatus === 'forwarded') ? 'forwarded' : '';
                sTable += '<tr class="' + sSelected + '" id="' + oRecipient.id + '">' +
                    '<td class="center">' +
                    '<label class="pos-rel">' +
                    '<input type="checkbox" class="ace" onclick="return false;"' + ((sStatus === 'forwarded') ? 'checked="checked"' : '') + '/>' +
                    '<span class="lbl"></span>' +
                    '</label>' +
                    '</td>' +
                    '<td>' + recipient.user.name + '</td>' +
                    '<td>' + (recipient.received_at || 'N/A') + '</td>' +
                    '<td>' + (recipient.confirmed_at || 'N/A') + '</td>' +
                    '<td>' + (recipient.forwarded_at || 'N/A') + '</td>' +
                    '<td>' + sStatus.toUpperCase() + '</td>' + sAction
                    '</tr>';
                if (oPost.recipient.length > 1)
                sRecipient += '<li data-step="1" class="' + sStatus + '" title="' + sStatus.toUpperCase() + '">' +
                    '<span class="step">' + (index + 1) + '</span>' +
                    '<span class="title">' + recipient.user.name + '</span>' +
                    '</li>'
            });
        }

        $('.wizard-actions').empty().append('' +
            '<button class="btn btn-danger btn-sm pull-left" data-dismiss="modal">' +
            '<i class="ace-icon fa fa-times"></i>' +
            'Cancel' +
            '</button>');

        $('#simple-table').find('tbody').empty().append(sTable);
        $('#modal-wizard').find('.modal-header').html('<h4>' + oPost.title.toUpperCase() + '</h4>');
        $('.steps').empty().append(sRecipient);
    };

    $('#modal-wizard').on('click', '.btn-received', function() {
        var sId = $(this).closest('tr').attr('id');
        setRecipientStatus(sId, 'received');
    });

    $('#modal-wizard').on('click', '.btn-confirmed', function() {
        var sId = $(this).closest('tr').attr('id');
        setRecipientStatus(sId, 'confirmed');
    });

    $('#modal-wizard').on('click', '.btn-forwarded', function() {
        var sId = $(this).closest('tr').attr('id');
        setRecipientStatus(sId, 'forwarded');
    });

    $('#navbar-messages').on('click', '.messages', function(e) {
        var oLi = $(this).closest('li');

        var sId = oLi.attr('id');
        $.ajax({
            method: 'GET',
            url: '/post/recipient/' + sId,
            dataType: 'json'
        }).done(function (response) {
            var oBadge = $('.message-counter');
            var iNotifCount = parseInt(oBadge.html(), 10);
            oBadge.html(iNotifCount - 1);
            if ((iNotifCount - 1) === 0) {
                oBadge.hide();
                oLi.closest('ul').prepend('<li><a href="#"><span class="msg-body"><span class="msg-title">No new notifications</span></span></a></li>');
            }
            generateRecipientTableData(response);
            $('#modal-wizard').fadeToggle('slow', 'linear').modal('show');
            oLi.css('background-color', '');
        });
    });

    $('#logout').click(function () {
        $('#logout-form').submit();
    });

    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'GET',
        url: '/recipient/userNotViewedNotification',
        dataType: 'json'
    }).done(function (response) {
        if (response.length === 1) {
            showNotification('my title', 'my body', '/upload/avatar/' + response[0]['post']['user']['avatar']);
        }
    });

    function showNotification(sTitle, sBody, sIcon, iTimeOut) {
        iTimeOut = iTimeOut || 3000;
        if (window.Notification && Notification.permission !== "denied") {
            Notification.requestPermission(function (status) {  // status is "granted", if accepted by user
                var n = new Notification(sTitle, {
                    body: sBody,
                    icon: sIcon
                });
                setTimeout(function () {
                    n.close()
                }, iTimeOut)
            });
        }
    }
</script>
</body>
</html>


