@extends('layout.admin')
@section('content')
<div class="container">


<!-- Sidebar end=============================================== -->
    <ul class="breadcrumb">
    <li class="active">Admin Products</li>
    </ul>
 
	   <div class="row">			
			<div class="span12">
              <div id="myTabContent" >
			  <b>Sub-Admin Name:</b> {{ $admin->name }}, <b> &nbsp;&nbsp;&nbsp;Company Name: </b>{{ $admin->company }}, &nbsp;&nbsp;&nbsp;<b>Phone: </b>{{ $admin->phone }}, <b> &nbsp;&nbsp;&nbsp;Email: </b>{{ $admin->email }} 
	
             <hr class="soft"/>
			  @include('inc.message')	
	     <h3 style="color : brown">Admin Prduct(s)</h3>
       <!-- Block view of items  -->
       @if($items != null )
			<div class="tab-pane active" id="blockView">
				<ul class="thumbnails">
				  @if($items != null && count($items) > 0)
				    @foreach($items as $t)
					<li class="span3">
					  <div class="thumbnail">
					   <b>{{ $t->initial_quantity }} | {{ $t->quantity }}</b> pcs
						<a href="{{ url('admin/admin/specific/item', ['status'=>'view','id'=>$t->id , 'admin_id'=>$admin->id]) }}"><img src="{{ url($t->image1) }}" alt=""/></a>
						<div class="caption">
						<h5>{{  substr(( $t->name .' | '.  $t->item_type ),0, 20) }} {{ strlen( $t->name .' | '.  $t->item_type) > 25 ? '...' : '' }}</h5>
						  <p> 
							  <!--	{{ substr($t->description, 0, 20) }} -->
						 @if($t->old_price)
						  Old Price <s><span style="color : brown; font-size : 12px;">NGN {{number_format($t->old_price,2)}}</span></s> 
						  @else <br />
						  @endif
						  </p>
						  <h4 style="text-align:center"><a class="btn btn-success btn-xs" href="{{ url('admin/admin/specific/item', ['status'=>'view','id'=>$t->id ,'admin_id'=>$admin->id]) }}">NGN{{ number_format($t->new_price,2) }} </a>  <!-- <a class="btn btn-xs btn-success" href="{{ url('admin/admin/specific/item', ['status'=>'view','id'=>$t->id ,'admin_id'=>$admin->id]) }}">View</a>  --> <a class="btn btn-danger btn-xs" href="{{ url('admin/admin/specific/item', ['status'=>'delete','id'=>$t->id, 'admin_id'=>$admin->id ]) }}">Delete</a></h4>
						  <span style="font-size : 12px"><b>{{$t->company}}: </b>{{$t->contact}}</span> @if($t->state)|<span style="font-size : 11px"> <b>{{$t->state}}:</b> {{$t->city}}</span> @endif
						</div>
					  </div>
					</li>
					@endforeach
				   @endif
				  </ul>
				 
			<hr class="soft"/>
			</div>
			
           <!-- The end of the block items -->
		<div class="pagination">
		{!! $items->render() !!} 
			</div>
				<br class="clr">
					 </div>
		</div>
          </div>
	</div>
	@else
	   <h3 style="color : brown"> There is no available item yet. </h3>
	@endif
</div>
</div> 
<!-- MainBody End ============================= -->
@endsection