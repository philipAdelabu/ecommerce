@extends('layout.admin')
@section('content')
   <div class="row">
    <div class="span2"></div>
	<div class="span8">
    <ul class="breadcrumb">
		<li><a href="{{ url('adminDashboard') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Administrator</li>
    </ul>

	<h3> <span style="color : green">Administrator Information</span> <div class="pull-right">
				<a href="{{ url('admin_add_admin') }}" class="btn btn-large btn-primary" >Create Another Administrator </a>
			</div></h3>	<br /> 
    @if($admin)
	<div class="well">
	 <h4>Administrator personal information</h4>
    
     <table class="table table-striped table-responsive ">
        <tr><td> Name</td><td> <b >{{ $admin->name }} </b></td></tr>  
        <tr><td></td><td></td></tr>   
        <tr><td>Email</td><td> {{ $admin->email }}</td></tr>
        <tr><td></td><td></td></tr>
      
        <tr><td>Phone</td><td> {{ $admin->phone }}</td></tr>
        <tr><td></td><td></td></tr>
        <tr><td><b>Login Details</b></td><td></td></tr>
        <tr><td>Username</td><td> {{ $admin->email }}</td></tr>
        <tr><td>Password</td><td> {{ $password }}</td></tr>
     </table>

     </div>
    
        <div class="pull-right">
		  <a  href="{{ url('admin/admin', ['status'=>'edit', 'id' => $admin->id ]) }}" class="btn btn-large btn-danger">Edit</a>
	    </div>
    @endif
</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->

@endsection
