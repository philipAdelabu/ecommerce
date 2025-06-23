@extends('layout.admin')
@section('content')
<div class="container">

<!-- Sidebar end=============================================== -->
    <ul class="breadcrumb">
    <li class="active">All Buyers</li>
    </ul>
 
          <!-- Static Table Start -->
          <div class="data-table-area mg-tb-15">
        <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h3>All Buyers</h3>
                                    @include('inc.message')
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <div id="toolbar"></div>
                                    <table class="table table-responsive table-bordered" id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" 
                                         data-show-export="true"  data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state"><div class="text-right">S/N</div></th>
                                                <th data-field="name" data-editable="false"><div class="text-center"></div></th>
                                                <th data-field="email" >Name</th>
                                                <th data-field="price" ><div class="text-center"></div></th>
												<th data-field="date" >Email</th>
												<th data-field="task" ><div class="text-center">Phone</div></th>
                                                <th data-field="id" ></th>
                                                <th data-field="company" >Status</th>
                                                <th data-field="action"><div class="text-center">Action</div></th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        @if($users)
                                          @php $count = 1 ; @endphp
                                           @foreach($users as $t)
                                           <tr>
                                           <td > &nbsp;&nbsp;{{ $count }}</td>
                                           <td></td>
                                           <td >&nbsp;&nbsp;{{ $t->name }}</td>
                                           <td></td>
                                           <td >&nbsp;&nbsp;{{ $t->email }}</td>
                                           <td >&nbsp;&nbsp;{{ $t->phone }}</td>
                                           <td></td>
                                           <td>
                                               @if($t->status == 0) <span style="color : green; font-weight: bold">Active</span>
                                               @else <span style="color : brown; font-weight: bold">Suspended</span>
                                               @endif
                                           </td>
                                           <td >&nbsp;&nbsp;
                                               @if($t->status == 0)  
                                               <a href="{{ url('admin/user', ['status'=>'suspend', 'id'=>$t->id]) }}" class="btn btn-xs btn-warning" onclick="return confirm('Are you sure about this ?');">Suspend</a>&nbsp;&nbsp;
                                               @else
                                               <a href="{{ url('admin/user', ['status'=>'activate', 'id'=>$t->id]) }}" class="btn btn-xs btn-primary" onclick="return confirm('Are you sure about this ?');">Activate</a>&nbsp;&nbsp;
                                              @endif
                                              <a href="{{ url('admin/user', ['status'=>'delete_buyer','id' => $t->id ]) }}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to do this ?');">Delete</a>
                                           </td>
                                           </tr>
                                            @php $count++ ; @endphp
                                           @endforeach
                                          @endif
                                    
                                         </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
     
        <!-- Static Table End -->


       

</div> 
<!-- MainBody End ============================= -->
@endsection