@extends('layout.admin')
 @section('content')
  
<div class="page-header">
<h3 style="color : brown">Change You password from this section.</h3>

</div>
<!-- The beginning of the body -->

@include('inc.message')
<div class="row-fluid">
<div class="span3"></div>
<div class="span9">
  
       
        <div class="form-inline">
         <div class="row-fluid">
         <form  method="POST" action="{{ url('admin/password/reset') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">New Password</label>
                            <div class="form-group">
                                <input id="passord1" type="password" class="form-control" name="password1" value="{{ old('password1') }}" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password2" type="password" class="form-control" name="password2" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-6"><br />
                                <button type="submit" class="btn btn-danger">
                                    Submit
                                </button>

                             
                            </div>
                        </div>
                    </form>
          </div>
        </div>
       </div>
         
       <br /><br /><br />
    
      </div>
      </div>
	
 @endsection