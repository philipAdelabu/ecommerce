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
    <ul class="breadcrumb">
    <li><a href="{{ url('admin_view_item') }}">Products</a> <span class="divider">/</span></li>
    <li class="active">product Details</li>
    </ul>
	@include('inc.message')	 
	<br />
	@if($item != null)
	<div class="row">	  
			<div id="gallery" class="span3">
            <a href="{{ url($item->image1) }}" title="{{ $item->item_type  }}">
				<img src="{{ url($item->image1)  }}" style="width:100%" alt="{{ $item->item_type }}"/>
            </a>
			<br />
			<div id="differentview" class="moreOptopm carousel slide">
			<div class="carousel-inner">
                  <div class="item active">
                   <a href="{{ url($item->image1)  }}"> <img style="width:29%" src="{{ url($item->image1) }}" alt=""/></a>
                   <a href="{{ $item->image2 ? url($item->image2) : url($item->image1)  }}"> <img style="width:29%" src="{{ $item->image2 ? url($item->image2) : url($item->image1)  }}" alt=""/></a>
                   <a href="{{ $item->image3 ? url($item->image3) : url($item->image1)  }}" > <img style="width:29%" src="{{ $item->image3 ? url($item->image3) : url($item->image1) }}" alt=""/></a>
                  </div>
                  <div class="item">
                   <a href="{{ $item->image3 ? url($item->image3) : url($item->image1) }}" > <img style="width:29%" src="{{ $item->image3 ? url($item->image3) : url($item->image1) }}" alt=""/></a>
                   <a href="{{ url($item->image1)  }}"> <img style="width:29%" src="{{ url($item->image1)  }}" alt=""/></a>
                   <a href="{{ $item->image2 ? url($item->image2) : url($item->image1)  }}"> <img style="width:29%" src="{{ $item->image2 ? url($item->image2) : url($item->image1)  }}" alt=""/></a>
                  </div>
                </div>
              <!--  
			  <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
              <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a> 
			  -->
              </div>
			  
			
			</div>
			<div class="span6">
			<h4>Product Id: <span style="color : brown">{{ $item->id }}</span></h4>
				<h3>{{ $item->name ?? '' }}   <span style="color: brown">{{ $item->visible == -1 ? "(hidden item)" : '' }} </span></h3>
				<h5>{{ $item->item_type }}</h5>
				<hr class="soft"/>
			
				  <div class="row">
				    <div class="span3">
					New Price <span  style="color : green">NGN{{ number_format($item->new_price,2) }} </span> <br /> 
					@if($item->old_price) Old Price <s  style="color : brown"> NGN{{ number_format($item->old_price,2) }} </s>@endif
					</div>
					
					
					<div class="pull-right">
				
					  <a class="btn btn-sm btn-primary" href="{{ url('admin/specific/item', ['status'=>'edit','id'=>$item->id ]) }}"> Edit <i class=" icon-pencil"></i></a>
					
					 &nbsp;&nbsp;&nbsp;<a class="btn btn-sm btn-danger" href="{{ url('admin/specific/item', ['status'=>'delete','id'=>$item->id ]) }}"> Delete <i class=" icon-trash"></i></a>
					</div>
				  </div>
			
				
				<hr class="soft"/>
				<h4> @if($item->quantity == 0)
				     <span style="color : brown"> Out Of Stock</span>
			        @else {{ $item->iniatial_quantity }} | {{ $item->quantity }} items in stock
					@endif
					</h4>
				
				<hr class="soft clr"/>
                 <b style="font-size: 18px;"> Adjust Item Visibility  </b><br /><br />
				  {{ Form::open(['url'=> 'admin/show/item/visibility' ]) }}  
				     {{ csrf_field() }}
                     <input type="hidden" name="item_id" value="{{ $item->id }}" />
					<b style="color: green">Show Item</b> <input class="form-control" {{ $item->visible == 1 ? 'checked' : '' }} type="radio" name="visibility" value="1"  /> &nbsp;&nbsp;
					<b style="color: brown">Hide Item</b> <input class="form-control"  {{ $item->visible == -1 ? 'checked' : '' }}  type="radio" name="visibility"  value="-1" />
					 <br /><br />
					<span style="font-size: 12px;"> Adjust Item Quantiy  (<b style="color: brown">0 means out-of-stock</b>)<br /></span>
					 <input type="number" name="quantity" value="{{ $item->quantity }}" />
                     &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp;
                     &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;  &nbsp;&nbsp;&nbsp; <button type="submit" class="btn btn-md btn-primary">Update Visibility</button>
				  {{ Form::close() }}
                  


				<hr />
				<h4>Description</h4>
				<p>
			    {{ $item->description ??  '' }}
				
				</p>
				<a class="btn btn-small pull-right" href="#detail">More Details</a>
				<br class="clr"/>
			<a href="#" name="detail"></a>
			<hr class="soft"/>
			</div>
			
			<div class="span9">
        
            <div id="myTabContent" >
              <div class="tab-pane fade active in" id="home">
			  <h4>Product Information and Specifications</h4>
			 
                <table class="table table-bordered">
				<tbody>
				<tr class="techSpecRow"><th colspan="2">Product Specifications</th></tr>
				
				@if( $features && $features_key)
				  @foreach($features_key as $key)
				<tr class="techSpecRow"><td class="techSpecTD1"><b>{{ ucfirst($key) }}</b></td><td class="techSpecTD2">{{ $features->{$key} }}</td></tr>
				  @endforeach
				 @endif
				</tbody>
			
				</table>
                   
		

              </div>
	
		

		<hr class="soft"/>

  
					 </div>
		</div>
          </div>
	</div>
	@else
	   <h3 style="color : brown"> The items category you looking is not yet available. </h3>
	@endif
</div>
</div> 
</div>
<!-- MainBody End ============================= -->
@endsection