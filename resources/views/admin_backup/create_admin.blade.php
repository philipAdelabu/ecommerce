@extends('layout.admin')
@section('content')
   <div class="row">
    <div class="span2"></div>
	<div class="span8">
    <ul class="breadcrumb">
		<li><a href="{{ url('adminDashboard') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Admin Registration</li>
    </ul>
	<h3>Admin Registration</h3>	 
	<div class="well">

	 <h4>Admin Information</h4>
	{{ Form::open(['url'=>'create/admin', 'name'=>'form1', 'id'=>'form1' ]) }}
		
		
		
		<div class="control-group">
			<label class="control-label" for="inputLname">Full Name <sup>*</sup></label>
			<div class="controls">
			  <input  class="input-xlarge"  required name="name" type="text" id="inputLname" placeholder="Seller Business Name"/>
			</div>
		</div>
		
	
	 
	    <div class="control-group">
		<label class="control-label" for="input_email">Email <sup>*</sup></label>
		<div class="controls">
		  <input  class="input-xlarge"  required name="email" type="text" id="input_email" placeholder="Email">
		</div>
	  </div>
		
	
		<div class="control-group">
			<label class="control-label" for="phone">Mobile Phone </label>
			<div class="controls">
			  <input class="input-xlarge"  required type="text"  name="phone" id="mobile" placeholder="Mobile Phone"/> 
			</div>
		</div>
		<hr />
		
		
	<div class="control-group">
			<div class="controls">
			     <br />
				<input class="btn btn-large btn-success" type="submit" value="Create Admin" />
			</div>
		</div>		
	{{ Form::close() }}
</div>

</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->


@endsection
