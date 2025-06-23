@extends('layout.admin')
@section('content')
   <div class="row">
    <div class="span2"></div>
	<div class="span8">
    <ul class="breadcrumb">
		<li><a href="{{ url('adminDashboard') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Seller</li>
    </ul>
    @include('inc.message')
    <p>View all the available sellers and their conresponding products, by clicking on the view sellers products.</p>
	<h3> <span style="color : green">Suppliers Products</span></h3>	<br /> 
    @if($sellers)   
	<div class="well">
	 <h4>Click View Seller product to view all the seller available product</h4>
        
     <table class="table table-striped table-responsive ">
        <tr><th>Name</th><th>Company</th><th>Phone</th><th>Email</th><th>Status</th><th>Action</th></tr>
        @foreach($sellers as $seller)
        <tr>
        <td><b>{{ $seller->name }}</b></td>
        <td>{{ $seller->company }}</td>
        <td>{{ $seller->phone }}</td>
        <td>{{ $seller->email }}</td>
        <td>
        @if($seller->status == 0)
        <span style="color : green">Active</span>
        @else 
        <span style="color : brown">Suspended</span>
        @endif
        </td>
        <td><a style="color : brown" href="{{ url('admin/seller/items', ['id'=> $seller->id]) }}">View Seller Products</a></td>
        </tr>
        @endforeach
     </table>
     
     </div>
     <hr class="soft">
     <div class="pagination">
      {{ $sellers->links() }}
     </div>
     @endif
</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->

@endsection
