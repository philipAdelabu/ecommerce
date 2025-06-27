@extends('layout.admin')
@section('content')
   <div class="row">
    <div class="span2"></div>
	<div class="span8">
    <ul class="breadcrumb">
		<li><a href="{{ url('adminDashboard') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Success</li>
    </ul>
    @if(session()->exists('administrator'))
    @php $admin = session('administrator'); @endphp
    @include('inc.message')
	<h3> <span style="color : green">Admin Successfull Creation</span> <div class="pull-right">
				<a href="{{ url('admin_add_admin') }}" class="btn btn-large btn-danger" >Create Another Admin </a>
			</div></h3>	<br /> 
	<div class="well">
	 <h4>Admin personal information</h4>
    
     <table class="table table-striped table-responsive ">
        <tr><td>Username</td><td> <b >{{ $admin['username'] }} </b></td></tr>
        <tr><td>Password</td><td> <b>{{ $admin['password'] }} </b></td></tr>
        <tr><td></td><td></td></tr>
        <tr><td>Name</td><td> {{ $admin['name'] }}</td></tr>
        <tr><td></td><td></td></tr>
        <tr><td>Phone</td><td> {{ $admin['phone'] }}</td></tr>
        
     </table>

     </div>
     @endif

</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->


@endsection
