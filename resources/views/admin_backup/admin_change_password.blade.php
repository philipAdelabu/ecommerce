@extends('inc.admin.general')
@section('title')Administrator Reset Password @endsection
@section('content') 

                  @include('inc.message')

                    <form class="form-horizontal" method="POST" action="{{ url('admin_change_password') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">New Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password1" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password2" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Change Password
                                </button>
                            </div>
                        </div>
                    </form>
                
@endsection 