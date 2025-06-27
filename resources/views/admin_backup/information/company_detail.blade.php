@extends('layout.admin')
@section('content')
   <div class="row">
    <div class="span2"></div>
	<div class="span8">
    <ul class="breadcrumb">
		<li><a href="{{ url('adminDashboard') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Company details</li>
    </ul>
	<h3>Company Detail</h3>	 
	<div class="well">

	 <h4>Details</h4>
	{{ Form::open(['url'=>'admin/update/information', 'name'=>'form1', 'id'=>'form1' ]) }}
		
		
		
		<div class="control-group">
			<div class="controls">
			    <input  class="input-xlarge" value="{{ $company->name ?? '' }}" required name="name" type="text" id="business_name" placeholder=" Business Name"/>
			    <input  class="input-xlarge" value="{{ $company->email ?? '' }}"  name="email" type="text" id="email" placeholder="Email" />
			</div>
		</div>
		
        <div class="control-group">
			<div class="controls">
			    <input  class="input-xlarge" value="{{ $company->phone1 ?? '' }}"  name="phone1" type="text"  placeholder="Phone Number 1"/>
			    <input  class="input-xlarge" value="{{ $company->phone2 ?? '' }}" name="phone2" type="text"  placeholder="Phone Number 2" />
			</div>
		</div>


        <div class="control-group"> 
			<div class="controls">
			    <input  class="input-xlarge" value="{{ $company->address1 ?? '' }}"  name="address1" type="text"  placeholder="Headquaters Address"/>
			    <input  class="input-xlarge" value="{{ $company->address2 ?? '' }}"  name="address2" type="text"  placeholder="Branch Address" />
			</div>
		</div>

		<div class="control-group"> 
			<div class="controls">
                <br />
                <label>Location cordinates  (latitude, longitude)</label>
                 <hr style="margin: 5px 0px 10px; 0px;" />
			    <input  class="input-xlarge" value="{{ $company->latitude ?? '' }}"  name="latitude" type="text"  placeholder="Latitude cordinate"/>
			    <input  class="input-xlarge" value="{{ $company->longitude ?? '' }}"  name="longitude" type="text"  placeholder="Longitude cordinate" />
			     <hr style="margin: 0px ;" />
            </div>
		</div>
        <br />
         
	   <div class="control-group">
		   <label class="control-label" for="input_email">Whatsapp number </label>
		   <div class="controls">
		      <input  class="input-xlarge" value="{{ $company->whatsapp ?? '' }}"  name="whatsapp" type="text"  placeholder="Whatsapp number">
		   </div>
	   </div>

        <div class="control-group">
		   <label class="control-label" for="">facebook link </label>
		   <div class="controls">
		      <input  class="input-xxlarge"  value="{{ $company->facebook ?? '' }}" name="facebook" type="text"  placeholder="facebook link">
		   </div>
	   </div>

        <div class="control-group">
		   <label class="control-label" for="">twitter link </label>
		   <div class="controls">
		      <input  class="input-xxlarge" value="{{ $company->twiiter ?? '' }}"  name="twitter" type="text"  placeholder="twitter link">
		   </div>
	   </div>

     
		   
		   <div class="controls">
           <label class="control-label" for="">google link </label>
		      <input  class="input-xxlarge" value="{{ $company->google ?? '' }}" name="google" type="text"  placeholder="google link">
		   </div>
	 
       <div class="control-group">
		   <label class="control-label" for="input_email">instagram link </label>
		   <div class="controls">
		      <input  class="input-xxlarge" value="{{ $company->instagram ?? '' }}" name="instagram" type="text"  placeholder="instagram link">
		   </div>
	   </div>
	
	
		<hr />
		
	   <div class="control-group">
			<div class="controls">
				<input class="btn btn-large btn-success" type="submit" value="Update Information" />
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
