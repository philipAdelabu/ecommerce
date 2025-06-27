@extends('layout.admin')
@section('content')
<div class="container">

<!-- Sidebar end=============================================== -->
    <ul class="breadcrumb">
    <li class="active">All Purchases</li>
    </ul>
 
          <!-- Static Table Start -->
          <div class="data-table-area mg-tb-15">
        <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h3>All Purchases state that occured within the system</h3>
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
                                                <th data-field="name" data-editable="false"><div class="text-center">Company</div></th>
                                                <th data-field="email" >TransactionId</th>
                                                <th data-field="price" ><div class="text-center">Item</div></th>
												<th data-field="date" >Price(NGN)</th>
												<th data-field="task" ><div class="text-center">Quantity</div></th>
                                                <th data-field="id" >Total(NGN)</th>
                                                <th data-field="company" >Mode of Payment</th>
                                                <th data-field="action"><div class="text-center">Action</div></th>
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        @if($items)
                                          @php $count = 1 ; @endphp
                                           @foreach($items as $t)
                                           <tr>
                                           <td > &nbsp;&nbsp;{{ $count }}</td>
                                           <td >&nbsp;&nbsp;<a  href="#"><span style="color : green">{{ $t->company }}</span></a></td>
                                           <td >&nbsp;&nbsp;<a href="{{ url('admin/transaction/detail', ['trans_id'=>$t->transaction_id, 'buyer_id'=>$t->user_id , 'seller'=>$t->supplier_id]) }}"><span style="color : brown">{{ $t->transaction_id }}</span></a></td>
                                           <td >&nbsp;&nbsp;<img width="40" height="40" src="{{ url($t->image) }}"  alt="" /><br /><b>&nbsp;&nbsp;{{$t->name}}</b></td>
                                           <td >&nbsp;&nbsp;{{ number_format($t->price, 2) }}</td>
                                           <td >&nbsp;&nbsp;{{ $t->quantity }}</td>
                                           <td >&nbsp;&nbsp;{{ number_format($t->total, 2) }}</td>
                                           <td >&nbsp;&nbsp;{{ $t->mode_of_payment }}</td>
                                           <td >&nbsp;&nbsp;
                                               @if($t->status == 2) <span style="color : blue; font-weight: bold">Cancelled</span>
                                               @elseif($t->status == 1) <span style="color : green; font-weight: bold">Processed</span>
                                               @else <i style="color : orange; font-weight: bold">Pending</i>&nbsp;&nbsp;
                                               <a href="{{ url('admin/item/purchase', ['status'=>'approve', 'id'=>$t->id]) }}" class="btn btn-xs btn-primary" onclick="return confirm('Are you sure about this ?');">Approve</a>&nbsp;&nbsp;
                                               <a href="{{ url('admin/item/purchase', ['status'=>'cancel','id'=>$t->id]) }}" class="btn btn-xs btn-warning" onclick="return confirm('Are you sure about this ?');">Cancel</a>&nbsp;&nbsp;
                                              @endif
                                              <a href="{{ url('admin/item/purchase', ['status'=>'delete','id' => $t->id ]) }}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure you want to do this ?');">Delete</a>
                                              
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