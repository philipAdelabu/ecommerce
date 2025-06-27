@extends('inc.admin.login')
@section('content')

<div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="logo-pro">
                     <br /><br />
                        <span style="font-size: 36px; color : brown">{{ config('app.name') }}</span>
                        <a style="float : right" class="btn btn-danger" href="{{ url('/') }}">Go To The Main Website</a><br />
                       <!-- <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a> -->
                    </div>
                </div>
            </div>
        </div>
        
<div class="color-line"></div>
<div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <div class="logo-pro">
                    <br /><br />
                        <span style="font-size: 30px; color : brown">ADMINISTRATOR </span>
                       <!-- <a href="index.html"><img class="main-logo" src="img/logo/logo.png" alt="" /></a> -->
                    </div>
                </div>
            </div>
        </div>
<br /> 
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('adminlogin') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="username" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-6"><br />
                                <button type="submit" class="btn btn-danger">
                                    Login
                                </button>

                             
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
