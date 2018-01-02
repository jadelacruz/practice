@extends('layouts.app')

@section('content')
    <div id="login-box" class="login-box visible widget-box no-border">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header blue lighter bigger">
                    <i class="ace-icon fa fa-coffee green"></i>
                    Please Enter Your Information
                </h4>

                <div class="space-6"></div>
                <form method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}
                    <fieldset>
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input type="text" class="form-control"
                                       value="{{ old('email') }}"
                                       name="email" placeholder="Email Address" required
                                       autofocus/>
                                <i class="ace-icon fa fa-user"></i>

                            </span>
                        </label>

                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right {{ $errors->has('password') || $errors->has('email') ? 'has-error' : '' }}">
                                <input type="password" class="form-control"
                                       value="{{ old('password') }}"
                                       name="password" placeholder="Password" required/>
                                <i class="ace-icon fa fa-lock"></i>
                                <div class="help-block">
                                    @if ($errors->has('email') || $errors->has('password'))
                                        {{'Invalid Credentials'}}
                                    @endif
                                </div>
                            </span>
                        </label>

                        <div class="space"></div>

                        <div class="clearfix">
                            <button type="submit" class="width-35 pull-right btn btn-sm btn-primary">
                                <i class="ace-icon fa fa-key"></i>
                                <span class="bigger-110">Login</span>
                            </button>
                        </div>

                        <div class="space-4"></div>
                    </fieldset>
                </form>

                <div class="social-or-login center">
                    <span class="bigger-110">Or Login Using</span>
                </div>

                <div class="space-6"></div>

                <div class="social-login center">
                    <a class="btn btn-primary">
                        <i class="ace-icon fa fa-facebook"></i>
                    </a>

                    <a class="btn btn-danger">
                        <i class="ace-icon fa fa-google-plus"></i>
                    </a>
                </div>
            </div><!-- /.widget-main -->

            <div class="toolbar clearfix">
                <div>
                    <a href="{{ route('password.request') }}" class="forgot-password-link">
                        <i class="ace-icon fa fa-arrow-left"></i>
                        I forgot my password
                    </a>
                </div>

                <div>
                    <a href="{{ route('register') }}" class="user-signup-link">
                        I want to register
                        <i class="ace-icon fa fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div><!-- /.widget-body -->
    </div><!-- /.login-box -->

    <div id="forgot-box" class="forgot-box widget-box no-border">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header red lighter bigger">
                    <i class="ace-icon fa fa-key"></i>
                    Retrieve Password
                </h4>

                <div class="space-6"></div>
                <p>
                    Enter your email and to receive instructions
                </p>

                <form>
                    <fieldset>
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right">
                                <input type="email" class="form-control"
                                       placeholder="Email"/>
                                <i class="ace-icon fa fa-envelope"></i>
                            </span>
                        </label>

                        <div class="clearfix">
                            <button type="button"
                                    class="width-35 pull-right btn btn-sm btn-danger">
                                <i class="ace-icon fa fa-lightbulb-o"></i>
                                <span class="bigger-110">Send Me!</span>
                            </button>
                        </div>
                    </fieldset>
                </form>
            </div><!-- /.widget-main -->

            <div class="toolbar center">
                <a href="#" data-target="#login-box" class="back-to-login-link">
                    Back to login
                    <i class="ace-icon fa fa-arrow-right"></i>
                </a>
            </div>
        </div><!-- /.widget-body -->
    </div><!-- /.forgot-box -->
@endsection
