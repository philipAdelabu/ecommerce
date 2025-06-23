@extends('layout.admin')
@section('content')
<div class="container">
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
    <li><a href="index.html">Home</a> <span class="divider">/</span></li>
    <li><a href="{{ url('admin_view_item') }}">Products</a> <span class="divider">/</span></li>
    <li class="active">Your Submitted Items</li>
    </ul>
	@include('inc.message')	 			
			<div class="span9">
        
            <div id="myTabContent" >
          
		<hr class="soft"/>
	     <h3 style="color : brown">{{ $type }} to delete</h3>
       <!-- Block view of items  -->
       @if($items != null )
			<div class="tab-pane active" id="blockView">
				<ul class="thumbnails">
				  @if($items != null && count($items) > 0)
				    @foreach($items as $t)
					<li class="span3">
					  <div class="thumbnail">
					  <b>{{ $t->item->initial_quantity }} | {{ $t->item->quantity }}</b> pcs
						<a href="{{ url('admin/specific/item', ['status'=>'view','id'=>$t->item->id ]) }}"><img src="{{ url($t->image) }}" alt=""/></a>
						<div class="caption">
						 
						  <h5>{{  substr(( $t->item->name .' | '.  $t->item->item_type ),0, 20) }} {{ strlen( $t->item->name .' | '.  $t->item->item_type) > 25 ? '...' : '' }}</h5>
						  <p> 
							{{ substr($t->item->description, 0, 20) }}
						  </p>
						  <h4 style="text-align:center"> <a class="btn btn-danger" href="{{ url('admin/delete', ['item'=>$type,'id'=>$t->id ]) }}">Delete</a></h4>
						  <b>Updated:</b> {{ $t->updated_at }}
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
	   <h3 style="color : brown"> You have no available item yet. </h3>
	@endif
</div>
</div> 
</div>
<!-- MainBody End ============================= -->
@endsection