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
    @if($seller)
	
	<h3>Seller Information Update</h3>	 
	<div class="well">

	 <h4>Seller personal information</h4>
	{{ Form::open(['url'=>'create/seller', 'name'=>'form1', 'id'=>'form1' ]) }}

	  <input type="hidden" name="edit" value="edit" />
	  <input type="hidden" name="id" value="{{ $seller->id }}" />
	  <div class="control-group">
		<label class="control-label" for="input_email">Email <sup>*</sup></label>
		<div class="controls">
		  <input  value="{{ $seller->email }}"  class="input-xlarge"  required name="email" type="text" id="input_email" placeholder="Email">
		</div>
	  </div>

       
	  <div class="control-group">
			<label class="control-label" for="inputLname">Seller Business Name <sup>*</sup></label>
			<div class="controls">
			  <input  class="input-xlarge"  required name="name" value="{{ $seller->name }}" type="text" id="inputLname" placeholder="Seller Business Name"/>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="company">Business Name</label>
			<div class="controls">
			  <input  class="input-xlarge"  required name="company" value="{{ $seller->company }}" type="text" id="company" placeholder="company"/>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="business_type">Business Type</label>
			<div class="controls">
			  <input  class="input-xlarge"   name="business_type" value="{{ $seller->business_type }}" type="text" id="business_type" placeholder="e.g: LTD, PLC etc or None"/>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="vat">VAT <sup></sup></label>
			<div class="controls">
			  <input  class="input-xlarge"   name="vat" value="{{ $seller->vat }}" type="text" id="vat" placeholder="VAT"/>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="brn">Business Reg. Number<sup></sup></label>
			<div class="controls">
			  <input  class="input-xlarge"   name="brn" value="{{ $seller->brn }}" type="text" id="brn" placeholder="Business Reg. Number"/>
			</div>
		</div>

		<div class="control-group">
		<label class="control-label">Title <sup>*</sup></label>
		<div class="controls">
		<select name="title" class="span1" >
		    <option value="{{ $seller->title }}">{{ $seller->title }}</option>
			<option value="Mr">Mr.</option>
			<option value="Mrs">Mrs</option>
			<option value="Miss">Miss</option>
		</select>
		</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="person_in_charge">Name Of Person In Charge <sup>*</sup></label>
			<div class="controls">
			  <input  class="input-xlarge"   name="person_in_charge" value="{{ $seller->person_in_charge }}" type="text" id="person_in_charge" placeholder="Name Of Person In Charge"/>
			</div>
		</div>


		
		<div class="control-group">
			<label class="control-label" for="address">Business Address<sup>*</sup></label>
			<div class="controls">
			  <input  class="input-xlarge"  required name="address" value="{{ $seller->address }}" type="text" id="address" placeholder="Business Adress"/> 
			</div>
		</div>
	
		<div class="control-group">
			<label class="control-label" for="state">State<sup>*</sup></label>
			<!-- name="ostate" -->
			<div class="controls">
			    @include('admin.nigeria_states')
			</div>
		</div>	

		<div class="control-group">
			<label class="control-label" for="lga">City<sup>*</sup></label>
			<div class="controls">
			<input value="{{ $seller->lga }}" class="input-xlarge"   name="lga" type="text" id="lga" placeholder="City">
		
			<!--
			  <select name="lga" id="lga">
                  <option selected="selected">Select item...</option>
                </select>
				-->
			</div>
		</div>	
	 
	    
		
		<div class="control-group">
			<label class="control-label" for="aditionalInfo">Additional information</label>
			<div class="controls">
			  <textarea  class="input-xlarge"  name="information" id="aditionalInfo" cols="26" rows="4" placeholder="Additional information">{{ $seller->information }}</textarea>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="phone">Mobile Phone </label>
			<div class="controls">
			  <input class="input-xlarge"  value="{{ $seller->phone }}"  type="text"  name="phone" id="mobile" placeholder="Mobile Phone"/> 
			</div>
		</div>
		<hr  />
		<h4>Bank Account Detail</h4>

		<div class="control-group">
			<label class="control-label" for="bank_name">Bank Name <sup>*</sup></label>
			<div class="controls">
			  <input  class="input-xlarge"   name="bank_name" value="{{ $seller->bank_name }}" type="text" id="bank_name" placeholder="Bank Name"/>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="bank_name">Account Number <sup>*</sup></label>
			<div class="controls">
			  <input  class="input-xlarge"   name="account_number" value="{{ $seller->account_number }}" type="text" id="account_number" placeholder="Account Number"/>
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="account_name">Account Name <sup>*</sup></label>
			<div class="controls">
			  <input  class="input-xlarge"   name="account_name" value="{{ $seller->account_name }}" type="text" id="account_name" placeholder="Account Name"/>
			</div>
		</div>
		
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
