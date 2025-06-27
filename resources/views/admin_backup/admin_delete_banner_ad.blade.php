@extends('layout.admin')
@section('content')
<div class="container">
	<div class="row">

<!-- Sidebar end=============================================== -->

	<div class="span12">
    <ul class="breadcrumb">
    <li><a href="index.html">Home</a> <span class="divider">/</span></li>
    <li><a href="{{ url('admin_view_item') }}">Products</a> <span class="divider">/</span></li>
    <li class="active">Your Submitted Items</li>
    </ul>
	@include('inc.message')	 			
			<div class="span9">
        
            <div id="myTabContent" >
          
		<hr class="soft"/>
	     <h3 style="color : brown">Banner Advert to delete</h3>
       <!-- Block view of items  -->
       @if($items != null )
			<div class="tab-pane active" id="blockView">
				<ul class="thumbnails">
				  @if($items != null && count($items) > 0)
				    @foreach($items as $t)
					<li class="span3">
					  <div class="thumbnail">
					 
						<a href="#"><img src="{{ url($t->image) }}" alt=""/></a>
						<div class="caption">
						  <h4 style="text-align:center"> <a class="btn btn-danger" href="{{ url('admin/delete', ['item'=>'banner_ad','id'=>$t->id ]) }}">Delete</a></h4>
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