@extends('layout.admin')
@section('content')
   <div class="row">
    <div class="span2"></div>
	<div class="span8">
    <ul class="breadcrumb">
		<li><a href="{{ url('adminDashboard') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Administrators</li>
    </ul>
    @include('inc.message')
	<h3> <span style="color : brown">List Of Administrators</span> <div class="pull-right">
				<a href="{{ url('admin_add_admin') }}" class="btn btn-large btn-danger" >Create Another Admin </a>
			</div></h3>	<br /> 
    @if($admins)
    
     <div class="well">
	 <h4>Administrators List</h4>
     <table class="table table-striped table-responsive ">
         @foreach($admins as $s)
        <tr><td> <a href="{{ url('admin/admin', ['status'=>'view', 'id'=>$s->id ]) }}"> {{$s->name}} </a></td><td><a href="{{ url('admin/admin', ['status'=>'view', 'id'=>$s->id ]) }}">{{ $s->company }}</a></td>
        <td>@if($s->status == 1) 
        <b style="color : green">Active</b> 
         @else
         <b style="color : brown">Suspended</b> 
        @endif</td>
         <td >
         <div class="pull-right" >
         <a href="{{ url('admin/admin', ['status'=>'view', 'id' => $s->id ]) }}" class="btn btn-xs btn-success">View</a>&nbsp;&nbsp;&nbsp;
         <a href="{{ url('admin/admin', ['status'=>'edit', 'id' => $s->id ]) }}" class="btn btn-xs btn-primary">Edit</a>&nbsp;&nbsp;&nbsp;
         @if($s->status == 0)
         <a href="{{ url('admin/admin', ['status'=>'enable', 'id' => $s->id ]) }}" class="btn btn-xs btn-info">Enable</a>&nbsp;&nbsp;&nbsp;
         @else
         <a href="{{ url('admin/admin', ['status'=>'suspend', 'id' => $s->id ]) }}" class="btn btn-xs btn-warning">Suspend</a>&nbsp;&nbsp;&nbsp;
         @endif
         <a href="{{ url('admin/admin', ['status'=>'delete','id' => $s->id ]) }}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to do this ?');">Delete</a>
        </div>
         </td>
        </tr>
        @endforeach
     </table>
     </div>
    
     @endif
       <div class="pagination">
		{{ $admins->links() }}
        </div>

</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->

@endsection
