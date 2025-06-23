@extends('layout.admin')
@section('content')
<div class="container">
	<div class="row">
                <div id="sidebar" class="span3">
                    <div class="well well-small"> <strong>My Items Within The Sub-categories</strong></div>
                    <ul id="sideManu" class="nav nav-tabs nav-stacked">
                    @if(count($categories) > 0 )
                    @foreach($categories as $category)
                    <li class="subMenu open"><a href="">{{ $category->name}}  [{{$category->totalCount($category->name)}}] <i class="icon-chevron-down pull-right"></i></a>
                        <ul style="display:none">
                            @foreach($category->subCategory as $subCatg)
                            <li><a  href="{{ url('admin/view/sub_cat', ['sub_catg_id'=>$subCatg->id]) }}"><i class="icon-chevron-right"></i>{{ $subCatg->name }}  [{{$subCatg->itemCount($category->name, $subCatg->name )}}]</a> </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach  
                @endif
                    </ul>    
                </div>
<!-- Sidebar end=============================================== -->



			
			<div class="span9">
              <div id="myTabContent" >
			 
             <hr class="soft"/>
			  @include('inc.message')	
	     <h3 style="color : brown">{{ $sub_cat_name  }}  Prduct(s)</h3>
       <!-- Block view of items  -->
           @if($items != null )
			<div class="tab-pane active" id="blockView">
				<ul class="thumbnails">
				  @if($items)
				    @foreach($items as $t)
					<li class="span3">
					  <div class="thumbnail">
					   <b>Item Id: {{ $t->id }}</b> <b style="float: right;">{{ $t->initial_quantity }} | {{ $t->quantity }} pieces</b>
						<a href="{{ url('admin/view/specific/item', ['status'=>'view','id'=>$t->id ]) }}"><img src="{{ url($t->image1) }}" alt=""/></a>
						<div class="caption">
						<h5><a href="{{ url('admin/view/specific/item', ['status'=>'view','id'=>$t->id ]) }}">{{  substr($t->name,0, 20) }} {{ strlen($t->name) > 20 ? '...' : '' }}</a></h5>
						  
						  <div style="text-align:center; font-size: 12px;">
						     <a href="{{ url('admin/view/specific/item', ['status'=>'view','id'=>$t->id ]) }}">NGN{{ number_format($t->new_price,2) }} </a>  <!-- <a class="btn btn-xs btn-success" href="{{ url('admin/seller/specific/item', ['status'=>'view','id'=>$t->id]) }}">View</a>  -->&nbsp;&nbsp; <a style="color: brown" href="{{ url('admin/view/specific/item', ['status'=>'delete','id'=>$t->id]) }}">Delete</a>
						     <br />  View: <b>{{$t->views}} </b> time(s)
						  </div>
						
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
<!-- MainBody End ============================= -->
@endsection