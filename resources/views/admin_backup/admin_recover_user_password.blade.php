@extends('layouts.admin')
@section('title')Recover Password @endsection
@section('content') 

                  @include('messages.message_flash')

                    <form class="form-horizontal" method="POST" action="{{ url('admin_change_user_password') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Reg Id / Email</label>
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="username"  required autofocus>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">User Status</label>
                            <div class="col-md-6">
                               <select name="status" class="form-control" required>
                               <option value>-- Select status --</option>
                               <option value="student">Student</option>
                               <option value="staff">Teacher</option>
                               </select>
                            </div>
                        </div>

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