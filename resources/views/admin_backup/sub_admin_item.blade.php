@extends('layout.admin')
@section('content')
   <div class="row">
    <div class="span2"></div>
	<div class="span8">
    <ul class="breadcrumb">
		<li><a href="{{ url('adminDashboard') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Admin</li>
    </ul>
    @include('inc.message')
    <p>View all the available admins and their conresponding items, by clicking on the view admin products.</p>
	<h3> <span style="color : green">Suppliers Products</span></h3>	<br /> 
    @if($admins)   
	<div class="well">
	 <h4>Click View Admin Items to view all the admin available product</h4>
        
     <table class="table table-striped table-responsive ">
        <tr><th>Name</th><th>Company</th><th>Phone</th><th>Email</th><th>Status</th><th>Action</th></tr>
        @foreach($admins as $admin)
        <tr>
        <td><b>{{ $admin->name }}</b></td>
        <td><b>{{ $admin->company }}</b></td>
        <td>{{ $admin->phone }}</td>
        <td>{{ $admin->email }}</td>
        <td>
        @if($admin->status ==  1)
        <span style="color : green">Active</span>
        @else 
        <span style="color : brown">Suspended</span>
        @endif
        </td>
        <td><a style="color : brown" href="{{ url('admin/sub_admin/items', ['id'=> $admin->id]) }}">View Sub-Admin Items</a></td>
        </tr>
        @endforeach
     </table>
     
     </div>
     <hr class="soft">
     <div class="pagination">
      {{ $admins->links() }}
     </div>
     @endif
</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->

@endsection
