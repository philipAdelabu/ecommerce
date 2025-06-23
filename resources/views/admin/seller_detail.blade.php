@extends('layout.admin')
@section('content')
   <div class="row">
    <div class="span2"></div>
	<div class="span8">
    <ul class="breadcrumb">
		<li><a href="{{ url('adminDashboard') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Seller</li>
    </ul>

	<h3> <span style="color : green">Supplier Information</span> <div class="pull-right">
				<a href="{{ url('admin_add_seller') }}" class="btn btn-large btn-primary" >Create Another Supplier </a>
			</div></h3>	<br /> 
            @if($seller)
	<div class="well">
	 <h4>Seller personal information</h4>
    
     <table class="table table-striped table-responsive ">
        <tr><td>Business Seller Name</td><td> <b >{{ $seller->name }} </b></td></tr>
        <tr><td>Business Name</td><td> <b> {{ $seller->company }} </b></td></tr>
        <tr><td>Business Type</td><td> <b> {{ $seller->business_type }} </b></td></tr>
        <tr><td></td><td></td></tr>
        <tr><td>Title</td><td> {{ $seller->title }}</td></tr>
        <tr><td>Person In Charge</td><td> {{ $seller->person_in_charge }}</td></tr>
        <tr><td></td><td></td></tr>
        <tr><td>Business Reg. Number</td><td> {{ $seller->brn }}</td></tr>
        <tr><td>VAT</td><td> {{ $seller->vat }}</td></tr>
        <tr><td>Email</td><td> {{ $seller->email }}</td></tr>

        <tr><td></td><td></td></tr>
        <tr><td>Bank Name</td><td> {{ $seller->bank_name }}</td></tr>
        <tr><td>Account Number</td><td> {{ $seller->account_number }}</td></tr>
        <tr><td>Account Name</td><td> {{ $seller->account_name }}</td></tr>
        <tr><td></td><td></td></tr>
        
        <tr><td>State</td><td> {{ $seller->state }}</td></tr>
        <tr><td>City</td><td> {{ $seller->lga }}</td></tr>
        <tr><td>Business Address</td><td> {{ $seller->address }}</td></tr>
        <tr><td>Phone</td><td> {{ $seller->phone }}</td></tr>
        <tr><td>Information</td><td> {{ $seller->information }}</td></tr>
        <tr><td><b>Login Details</b></td><td></td></tr>
        <tr><td>Username</td><td> {{ $seller->email }}</td></tr>
        <tr><td>Password</td><td> {{ $password }}</td></tr>
         <tr><td>Created At</td><td> {{ $seller->created_at }}</td></tr>
        <tr><td>Updated At</td><td> {{ $seller->updated_at }}</td></tr>
     </table>

     </div>
    
        <div class="pull-right">
		  <a  href="{{ url('admin/supplier', ['status'=>'edit', 'id' => $seller->id ]) }}" class="btn btn-large btn-danger">Edit</a>
	    </div>
    @endif
</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->

@endsection
