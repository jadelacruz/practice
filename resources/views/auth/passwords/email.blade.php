@extends('layouts.app')

@section('content')
    <div id="signup-box" class="signup-box visible widget-box no-border">
        <div class="widget-body">
            <div class="widget-main">
                <h4 class="header blue lighter bigger">
                    <i class="ace-icon fa fa-coffee green"></i>
                    Please enter your Email Address
                </h4>

                <div class="space-6"></div>

                <form method="POST" action="{{ route('password.email') }}">
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

                        <div class="clearfix">
                            <button type="submit"
                                    class="pull-right btn btn-sm btn-success">
                                <span class="bigger-110">Send</span>

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
        </div>
    </div>

@endsection
