@extends('layout.admin')
@section('content')
   <div class="row">
	<div class="span12">
    <ul class="breadcrumb">
		<li><a href="{{ url('adminDashboard') }}">Home</a> <span class="divider">/</span></li>
		<li class="active">Suppliers</li>
    </ul>
    @include('inc.message')
	<h3> <span style="color : green">List Of Supplier</span> <div class="pull-right">
				<a href="{{ url('admin_add_seller') }}" class="btn btn-large btn-danger" >Create Another Supplier </a>
			</div></h3>	<br /> 
    @if($sellers)
    
    
         
	 <h4>Supplier List</h4>
   <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar"></div>
                                    <table class="table table-responsive table-bordered" id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" 
                                         data-show-export="true"  data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state"><div class="text-right">S/N</div></th>
                                                <th data-field="price" ><div class="text-center"></div></th>
                                                <th data-field="name" data-editable="false"><div class="text-center">Created</div></th>
                                                <th data-field="email" >Name</th>
                                                
												<th data-field="date" >Email</th>
												<th data-field="task" ><div class="text-center">Company</div></th>
                                                
                                                <th data-field="company" >Status</th>
                                                <th data-field="action"><div class="text-center">Action</div></th>
                                                <th data-field="id" ></th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        @php $count = 1 ; @endphp
         @foreach($sellers as $s)
         <tr>
         <td>{{ $count }}</td>
         <td></td>
         <td>{{ $s->created_at }}</td>
        <td> <a href="{{ url('admin/supplier', ['status'=>'view', 'id'=>$s->id ]) }}"> {{$s->name}} </a></td>
        <td> {{$s->email}}</td>
        <td><a href="{{ url('admin/supplier', ['status'=>'view', 'id'=>$s->id ]) }}">{{ $s->company }}</a></td>
        <td>
             @if($s->status == 1) <b style="color : brown">Suspended</b>  @if($s->referral == 1)<em style="color : brown">Managed By Root</em>    @endif  @endif
             @if($s->status == 0) <b style="color : green">Active</b>  @if($s->referral == 1)<em style="color : brown"> Managed By Root</em>     @endif  @endif 
        </td>
         <td >
         
         <a href="{{ url('admin/supplier', ['status'=>'view', 'id' => $s->id ]) }}" class="btn btn-xs btn-success">View</a>&nbsp;&nbsp;&nbsp;
         
        <!-- <a href="{{ url('admin/supplier', ['status'=>'edit', 'id' => $s->id ]) }}" class="btn btn-xs btn-primary">Edit</a>&nbsp;&nbsp;&nbsp; -->
         @if($s->status == 1)
         <a href="{{ url('admin/supplier', ['status'=>'enable', 'id' => $s->id ]) }}" class="btn btn-xs btn-info">Enable</a>&nbsp;&nbsp;&nbsp;
         @else
         <a href="{{ url('admin/supplier', ['status'=>'suspend', 'id' => $s->id ]) }}" class="btn btn-xs btn-warning">Suspend</a>&nbsp;&nbsp;&nbsp;
         @endif
         </td>
         <td>
       <!--  <a href="{{ url('admin/supplier', ['status'=>'delete','id' => $s->id ]) }}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to do this ?');">Delete</a> -->
        
         </td>
        </tr>
        @php $count++ ; @endphp
        @endforeach
                                          </tbody>
                                    </table>
                                </div>
                            </div>
    
   
        
        @endif
</div>
</div>
</div>
</div>
<!-- MainBody End ============================= -->

@endsection
