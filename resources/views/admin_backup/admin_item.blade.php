@extends('layout.admin')
@section('content')

	<div class="row">
   <div id="sidebar" class="span3">
		<div class="well well-small"> <strong>My Items Within The Sub-categories</strong></div>
		<ul id="sideManu" class="nav nav-tabs nav-stacked">
		 @if(count($categories) > 0 )
		  @foreach($categories as $category)
		  <li class="subMenu open"><a href="">{{ $category->name}}  [{{$category->totalCount($category->name, 'admin_id', session('admin_id'))}}] <i class="icon-chevron-down pull-right"></i></a>
		      <ul style="display:none">
			    @foreach($category->subCategory as $subCatg)
				<li><a  href="{{ url('admin/item/detail', ['sub_catg_id'=>$subCatg->id]) }}"><i class="icon-chevron-right"></i>{{ $subCatg->name }}  [{{$subCatg->itemCount($category->name, $subCatg->name, 'admin_id', session('admin_id'))}}]</a> </li>
				@endforeach
			  </ul>
		  </li>
		  @endforeach  
       @endif
		</ul>
	
		 
	</div>
<!-- Sidebar end=============================================== -->

	<div class="span9">
    <ul class="breadcrumb">
    <li><a href="{{ url('admin_view_item') }}">Products</a> <span class="divider">/</span></li>
    <li class="active">Your Submitted Items</li>
    </ul>
	@include('inc.message')	 			
			
        
            <div id="myTabContent" >
          
		<hr class="soft"/>
	     <h3 style="color : brown">My Items</h3>
       <!-- Block view of items  -->
       @if($items != null )
			<div class="tab-pane active" id="blockView">
				<ul class="thumbnails">
				  @if($items != null && count($items) > 0)
				    @foreach($items as $t)
					<li class="span3">
					  <div class="thumbnail">
					  <b>{{ $t->initial_quantity }} | {{ $t->quantity }}</b> pcs
						<a href="{{ url('admin/specific/item', ['status'=>'view','id'=>$t->id ]) }}"><img src="{{ url($t->image1) }}" alt=""/></a>
						<div class="caption">
						<h5>{{  substr(( $t->name .' | '.  $t->item_type ),0, 20) }} {{ strlen( $t->name .' | '.  $t->item_type) > 25 ? '...' : '' }}</h5>
						  <p> 
						  <!--	{{ substr($t->description, 0, 20) }} -->
						  Price <span style="color : blue; font-size : 12px;">NGN {{number_format($t->new_price,2)}}</span>
						 </p>
						  <h4 style="text-align:center"><a class="btn btn-success" href="{{ url('admin/specific/item', ['status'=>'view','id'=>$t->id ]) }}"> <i class="icon-zoom-in"></i> View</a> <a class="btn btn-primary" href="{{ url('admin/specific/item', ['status'=>'edit','id'=>$t->id ]) }}" >Edit </a> <a class="btn btn-danger" href="{{ url('admin/specific/item', ['status'=>'delete','id'=>$t->id ]) }}">Delete</a></h4>
						  <br /><span style="font-size : 12px"><b>{{ $t->company }} </b>
						  <br />Contact: {{$t->contact}}</span> 
						  <br /><span style="font-size : 11px">Location: <b>{{$t->state}} / {{$t->city}}</b></span>
						  <br /><span style="font-size : 12px">View: <b>{{$t->views}} </b> time(s)</span>
						</div>
					  </div>
					</li>
					@endforeach 
				   @endif
				  </ul>
				 
			<hr class="soft"/>
			</div>
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
	   <h3 style="color : brown"> You have no available item yet. </h3>
	@endif
</div>
</div> 
</div>
</div>
<!-- MainBody End ============================= -->
@endsection