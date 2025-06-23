@extends('layout.admin')
  @section('content')
    <div class="container">
	<div class="span11">
    <ul class="breadcrumb">
		<li class="active">Purchase Item detail</li>
    </ul>
    <h3> Items  Summary <span style="font-size : 20px;" class="pull-right">Transaction no: &nbsp; <span style="color : brown">{{ $address->transaction_id }}</span></span> &nbsp;&nbsp; </h3>  
	
    <hr class="soft"/>
    
	 <table class="table table-bordered"> 
              <thead>
                <tr>
                  <th>Company</th>
                  <th>Product</th>
                  <th>Name</th>
                  <th>Quantity</th>
                    <th>Price (=N=)</th>
                  <th>Total (=N=)</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody>
          
      @if($items)
      @php  $count = 0; $total = 0; @endphp
           @foreach($items as $t)
            <tr >
            <td>{{ $t->company }}</td>
         <td><a href="{{ url('specific/item', ['status'=>'view','id'=>$t->id ]) }} "> <img width="60" src="{{ url($t->image) }}" alt=""/></a></td>
         <td>{{  $t->name }}</td>
          <td>{{ $t->quantity }}</td>
          <td>{{ number_format($t->price,2) }}</td>
          <td>{{ number_format($t->total,2) }}</td>
          <td>
             @if($t->status == 2) <span style="color : blue; font-weight: bold">Cancelled</span>
             @elseif($t->status == 1) <span style="color : green; font-weight: bold">Processed</span>
             @else <i style="color : orange; font-weight: bold">Pending</i>&nbsp;&nbsp;
            <a href="{{ url('admin/item/purchase', ['status'=>'approve', 'id'=>$t->id]) }}" class="btn btn-xs btn-primary" onclick="return confirm('Are you sure about this ?');">Approve</a>&nbsp;&nbsp;
            <a href="{{ url('admin/item/purchase', ['status'=>'cancel','id'=>$t->id]) }}" class="btn btn-xs btn-danger" onclick="return confirm('Are you sure about this ?');">Cancel</a>&nbsp;&nbsp;
            @endif
          </td>
          </tr>     
          @php $count++;  $total += $t->total; @endphp
          @endforeach
          @endif 
        
         <tr>
    <td colspan="5" style="text-align:right"><strong>TOTAL =</strong></td>
        <td class="label label-important" style="display:block"> <div id="total1">{{ number_format($total,2) }}</div> 
             </td>
             <td></td>
          </tr> 
      </tbody>
      </table>
      <hr class="soft"/>
          <h4>Buyer Details</h4>
			<table class="table table-bordered table-stripped">
			 <tr><th>Buyer Name and Full Address For The Delivery</th></tr>
             <tr> <td><b>Buyer Name</b></td><td><b>{{ $buyer->name }}</b></td></tr>
			 <tr> <td>State</td><td>{{ $address->state }}</td></tr>
            <tr> <td>City</td><td>{{ $address->city }}</td></tr>
            <tr> <td>LGA</td><td>{{ $address->lga }}</td></tr>
            <tr> <td>Street</td><td>{{ $address->street }}</td></tr>
           <tr> <td>Phone Contact</td><td>{{ $address->phone }}</td></tr>
           </table>	
            <br />
            <hr class="soft"/>

          @if($seller)
           <h4>Seller Details</h4>
			<table class="table table-bordered table-stripped">
			 <tr><th>Seller Details</th></tr>
             <tr> <td><b>Seller Name</b></td><td><b>{{ $seller->name }}</b></td></tr>
             <tr> <td>Company</td><td>{{ $seller->company }}</td></tr>
			 <tr> <td>State</td><td>{{ $seller->state }}</td></tr>
            <tr> <td>City</td><td>{{ $seller->lga }}</td></tr>
            <tr> <td>Street</td><td>{{ $seller->address }}</td></tr>
           <tr> <td>Phone Contact</td><td>{{ $seller->phone }}</td></tr>
           <tr> <td>Email</td><td>{{ $seller->email }}</td></tr>
           </table>	
           @else
             <h3>The Selling  is from the Administrator. </h3>
           @endif
           <br />
        <button class="btn  btn-md btn-success btn-large" onclick="window.print();"> Print A Copy</button>
	
	
</div>
</div></div> 
<!-- MainBody End ============================= -->


@endsection