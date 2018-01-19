@extends('layouts.app')

@section('content')
    <div id="signup-box" class="signup-box widget-box no-border visible">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header green lighter bigger">
                    <i class="ace-icon fa fa-users blue"></i>
                    New User Registration
                </h4>

                <div class="space-6"></div>
                <p> Enter your details to begin: </p>

                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <fieldset>
                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right {{ $errors->has('name') ? 'has-error' : '' }}">
                                <input type="text" class="form-control" value="{{ old('name') }}"
                                       placeholder="Name" name="name" required/>
                                <i class="ace-icon fa fa-user"></i>
                            </span>
                            <div class="help-block">
                                @if ($errors->has('name'))
                                    {{'Invalid name'}}
                                @endif
                            </div>
                        </label>

                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right {{ $errors->has('name') ? 'has-error' : '' }}">
                                <select class="form-control" name="gender" required>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </span>
                            <div class="help-block">
                                @if ($errors->has('gender'))
                                    {{'Invalid gender'}}
                                @endif
                            </div>
                        </label>

                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right {{ $errors->has('email') ? 'has-error' : '' }}">
                                <input type="email" class="form-control" value="{{ old('email') }}"
                                       placeholder="Email" name="email" required/>
                                <i class="ace-icon fa fa-envelope"></i>
                            </span>
                            <div class="help-block">
                                @if ($errors->has('email'))
                                    {{'Invalid Email address'}}
                                @endif
                            </div>
                        </label>

                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right {{ $errors->has('password') || $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <input type="password" class="form-control" value="{{ old('password') }}"
                                       placeholder="Password" name="password" required/>
                                <i class="ace-icon fa fa-lock"></i>
                            </span>
                        </label>

                        <label class="block clearfix">
                            <span class="block input-icon input-icon-right {{ $errors->has('password') || $errors->has('password_confirmation') ? 'has-error' : '' }}">
                                <input type="password" class="form-control" value="{{ old('password_confirmation') }}"
                                       placeholder="Repeat password" name="password_confirmation" required/>
                                <i class="ace-icon fa fa-retweet"></i>
                            </span>
                            <div class="help-block">
                                @if ($errors->has('password') || $errors->has('password_confirmation'))
                                    {{'Check your password'}}
                                @endif
                            </div>

                        </label>

                        <label class="block clearfix">
                            <img src="/upload/avatar/default.png"
                                 style="height: 100px;width:inherit;margin-bottom:15px;"
                                 class="img-thumbnail img-responsive center-block" id="avatarImg">
                            <input type="file" accept="image/*" id="avatar" name="avatar">
                        </label>
                        <div class="space-24"></div>

                        <div class="clearfix">
                            <button type="reset" class="width-30 pull-left btn btn-sm">
                                <i class="ace-icon fa fa-refresh"></i>
                                <span class="bigger-110">Reset</span>
                            </button>

                            <button type="submit"
                                    class="width-65 pull-right btn btn-sm btn-success">
                                <span class="bigger-110">Register</span>

                                <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                            </button>
                        </div>
                    </fieldset>
                </form>
            </div>

            <div class="toolbar center">
                <a href="{{ route('login') }}" class="back-to-login-link">
                    <i class="ace-icon fa fa-arrow-left"></i>
                    Back to login
                </a>
            </div>
        </div><!-- /.widget-body -->
    </div><!-- /.signup-box -->

@endsection

@section('page-level-script')
    <script src="{{ asset('js/register.js') }}"></script>
@endsection


