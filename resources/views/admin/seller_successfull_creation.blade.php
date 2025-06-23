@extends('layout.admin')
@section('content')
   <div class="row">
    <div class="span2"></div>
	<div class="span8">
    <ul class="breadcrumb">
		<li><a href="{{ url('adminDashboard') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Success</li>
    </ul>
    @if(session()->exists('seller'))
    @php $seller = session('seller'); @endphp
    @include('inc.message')
	<h3> <span style="color : green">Seller Successfull Creation</span> <div class="pull-right">
				<a href="{{ url('admin_add_seller') }}" class="btn btn-large btn-danger" >Create Another Supplier </a>
			</div></h3>	<br /> 
	<div class="well">
	 <h4>Seller personal information</h4>
    
     <table class="table table-striped table-responsive ">
        <tr><td>Username</td><td> <b >{{ $seller['username'] }} </b></td></tr>
        <tr><td>Password</td><td> <b>{{ $seller['password'] }} </b></td></tr>
        <tr><td></td><td></td></tr>
        <tr><td>Seller Business Name</td><td> {{ $seller['name'] }}</td></tr>
        <tr><td>Business Name</td><td> {{ $seller['company'] }}</td></tr>
        <tr><td>Business Type</td><td> {{ $seller['business_type'] }}</td></tr>
        <tr><td>Business Reg. Number</td><td> {{ $seller['brn'] }}</td></tr>
        <tr><td>VAT</td><td> {{ $seller['vat'] }}</td></tr>
        <tr><td>Person In Charge</td><td> {{ $seller['person_in_charge'] }}</td></tr>
        <tr><td></td><td></td></tr>
        <tr><td>State</td><td> {{ $seller['state'] }}</td></tr>
        <tr><td>City</td><td> {{ $seller['lga'] }}</td></tr>
        <tr><td>Business Address</td><td> {{ $seller['address'] }}</td></tr>
        <tr><td>Phone</td><td> {{ $seller['phone'] }}</td></tr>
        <tr><td>Information</td><td> {{ $seller['information'] }}</td></tr>
        <tr><td></td><td></td></tr>
        <tr><td>Account Name</td><td> {{ $seller['account_name'] }}</td></tr>
        <tr><td>Account Number</td><td> {{ $seller['account_number'] }}</td></tr>
        <tr><td>Bank Name</td><td> {{ $seller['bank_name'] }}</td></tr>
     </table>

     </div>
     @endif

</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->


@endsection
