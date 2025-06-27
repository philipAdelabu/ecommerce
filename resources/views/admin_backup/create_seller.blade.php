@extends('layout.admin')
@section('content')
   <div class="row">
    <div class="span2"></div>
	<div class="span8">
    <ul class="breadcrumb">
		<li><a href="{{ url('adminDashboard') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Registration</li>
    </ul>
	<h3>Seller Registration</h3>	 
	<div class="well">

	 <h4>Seller  Information</h4>
	{{ Form::open(['url'=>'create/seller', 'name'=>'form1', 'id'=>'form1' ]) }}
		
		
		
		<div class="control-group">
			<label class="control-label" for="inputLname">Seller Business Name <sup>*</sup></label>
			<div class="controls">
			  <input  class="input-xlarge"  required name="name" type="text" id="inputLname" placeholder="Seller Business Name"/>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="company">Business Name</label>
			<div class="controls">
			  <input  class="input-xlarge"  required name="company" type="text" id="company" placeholder="Business Name"/>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="business_type">Business Type (Optional)</label>
			<div class="controls">
			  <input  class="input-xlarge"  name="business_type" type="text" id="business_type" placeholder="e.g: LTD, PLC etc or None"/>
			</div>
		</div>
        
		<div class="control-group">
			<label class="control-label" for="person_in_charge">Name Of Person In Charge <sup>*</sup></label>
			<div class="controls">
			  <input  class="input-xlarge"  required name="person_in_charge" type="text" id="person_in_charge" placeholder="Name Of Person In Charge"/>
			</div>
		</div>

		<div class="control-group">
		<label class="control-label">Title <sup>*</sup></label>
		<div class="controls">
		<select name="title" class="span1" >
			<option value="Mr">Mr.</option>
			<option value="Mrs">Mrs</option>
			<option value="Miss">Miss</option>
		</select>
		</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="brn">Business Reg. Number (Optional) <sup></sup></label>
			<div class="controls">
			  <input  class="input-xlarge"   name="brn" type="text" id="brn" placeholder="Business Reg. Number"/>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="vat">VAT (Optional)<sup></sup></label>
			<div class="controls">
			  <input  class="input-xlarge"   name="vat" type="text" id="vat" placeholder="VAT"/>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label" for="address">Business Address<sup>*</sup></label>
			<div class="controls">
			  <input  class="input-xlarge"  required name="address" type="text" id="address" placeholder="Business Adress"/> 
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
			<input  class="input-xlarge"  required name="lga" type="text" id="lga" placeholder="City">
		
			<!--
			  <select name="lga" id="lga">
                  <option selected="selected">Select item...</option>
                </select>
				-->
			</div>
		</div>	
	 
	    <div class="control-group">
		<label class="control-label" for="input_email">Email <sup>*</sup></label>
		<div class="controls">
		  <input  class="input-xlarge"  required name="email" type="text" id="input_email" placeholder="Email">
		</div>
	  </div>
		
		
		<div class="control-group">
			<label class="control-label" for="aditionalInfo">Additional information</label>
			<div class="controls">
			  <textarea  class="input-xlarge"  name="information" id="aditionalInfo" cols="26" rows="3"></textarea>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label" for="phone">Mobile Phone </label>
			<div class="controls">
			  <input class="input-xlarge"  required type="text"  name="phone" id="mobile" placeholder="Mobile Phone"/> 
			</div>
		</div>
		<hr />
		<h4>Bank Account Details (Optional)</h4>
		<div class="control-group">
			<label class="control-label" for="account_name">Account Name</label>
			<div class="controls">
			  <input class="input-xlarge"   type="text"  name="account_name" id="account_name" placeholder="Account Name"/> 
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="phone">Bank Name </label>
			<div class="controls">
			  <input class="input-xlarge"   type="text"  name="bank_name" id="bank_name" placeholder="Bank Name"/> 
			</div>
		</div>
		<div class="control-group">
			<label class="control-label" for="phone">Account Number </label>
			<div class="controls">
			  <input class="input-xlarge"  type="text"  name="account_number" id="account_number" placeholder="Account Number"> 
			</div>
		</div>
		
	<div class="control-group">
			<div class="controls">
			     <br />
				<input class="btn btn-large btn-success" type="submit" value="Create Seller" />
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
