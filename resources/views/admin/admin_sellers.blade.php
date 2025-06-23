@extends('layout.admin')
@section('content')
   <div class="row">
    <div class="span2"></div>
	<div class="span8">
    <ul class="breadcrumb">
		<li><a href="{{ url('adminDashboard') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Administrator </li>
    </ul>
    @include('inc.message')
    <p>View all the available administrators and their conresponding sellers, by clicking on the view sellers products.</p>
	<h3> <span style="color : green">Administrator's Sellers</span></h3>	<br /> 
    @if($admins)   
	<div class="well">
	 <h5>Click View Admin Sellers to view seller of the Admin </h5>
        
     <table class="table table-striped table-responsive ">
        <tr><th>Name</th><th>Company</th><th>Phone</th><th>Email</th><th>Status</th><th>Action</th></tr>
        @foreach($admins as $admin)
        <tr>
        <td><b>{{ $admin->name }}</b></td>
        <td>{{ $admin->company }}</td>
        <td>{{ $admin->phone }}</td>
        <td>{{ $admin->email }}</td>
        <td>
        @if($admin->status == 1)
        <span style="color : green">Active</span>
        @else 
        <span style="color : brown">Suspended</span>
        @endif
        </td>
        <td><a style="color : brown" href="{{ url('admin/seller/admin', ['id'=> $admin->id]) }}">View Admin Sellers</a></td>
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
