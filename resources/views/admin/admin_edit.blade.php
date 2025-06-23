@extends('layout.admin')
@section('content')
   <div class="row">
    <div class="span2"></div>
	<div class="span8">
    <ul class="breadcrumb">
		<li><a href="{{ url('adminDashboard') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Update</li>
    </ul>
	@include('inc.message')
    @if($admin)
	  
	<h3>Administrator Information Update Section</h3>	 
	<div class="well">

	 <h4>Administrator personal information</h4>
	{{ Form::open(['url'=>'create/admin', 'name'=>'form1', 'id'=>'form1' ]) }}

	  <input type="hidden" name="edit" value="edit" />
	  <input type="hidden" name="id" value="{{ $admin->id }}" />
	  <div class="control-group">
		<label class="control-label" for="input_email">Email <sup>*</sup></label>
		<div class="controls">
		  <input disabled value="{{ $admin->email }}"  class="input-xlarge"  required name="email" type="email" id="input_email" placeholder="Email">
		</div>
	  </div>

       
	  <div class="control-group">
			<label class="control-label" for="inputLname">Full Name <sup>*</sup></label>
			<div class="controls">
			  <input  class="input-xlarge"  required name="name" value="{{ $admin->name }}" type="text" id="inputLname" placeholder="Full Name"/>
			</div>
		</div>

		
	
	 
		
		<div class="control-group">
			<label class="control-label" for="phone">Mobile Phone </label>
			<div class="controls">
			  <input class="input-xlarge"  value="{{ $admin->phone }}" required type="text"  name="phone" id="mobile" placeholder="Mobile Phone"/> 
			</div>
		</div>
		<hr  />
	
	    <div class="control-group">
			<div class="controls">
			     <br />
				<input class="btn btn-large btn-success" type="submit" value="Update" />
			</div>
		</div>	

	{{ Form::close() }}
</div>
@endif
</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->


@endsection
