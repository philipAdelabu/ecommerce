@extends('layout.admin')
@section('content')
<div class="container">
	<div class="row">
<!-- Sidebar end=============================================== -->
	<div class="span12">
    <ul class="breadcrumb">
    <li><a href="index.html">Home</a> <span class="divider">/</span></li>
    <li><a href="#">Products</a> <span class="divider">/</span></li>
    <li class="active">product Details</li>
    </ul>
    <br />
	
    <b>Supplier Name:</b> {{ $seller->name }}, <b> &nbsp;&nbsp;&nbsp;Company Name: </b>{{ $seller->company }}, &nbsp;&nbsp;&nbsp;<b>Phone: </b>{{ $seller->phone }}, <b> &nbsp;&nbsp;&nbsp;Email: </b>{{ $seller->email }} 
		      <hr class="soft"/> 
              @include('inc.message')	
              <h3>Supplier Item Details</h3>
	@if($item != null)
	<div class="row">
    <div  class="span3"></div>	  
			<div id="gallery" class="span3">
            <a href="{{ url($item->image1) }}" title="{{ $item->item_type ?? '' }}">
				<img src="{{ url($item->image1)  }}" style="width:100%" alt="{{ $item->item_type  ?? '' }}"/>
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
				<h3>{{ $item->name  ?? '' }} </h3>
				<small>{{ $item->item_type ??  '' }}</small>
				<hr class="soft"/>
			
				  <div class="row">
				    <div class="span3">
					<span  style="color : green">New Price =N= {{ $item->new_price ?? ''}} </span> <br /> 
					<span style="color : red"> Old Price =N=  {{ $item->old_price  ?? '' }} </span>
					
					</div>
					
					
					<div class="pull-right">
				
					 &nbsp;&nbsp;&nbsp;<a class="btn btn-sm btn-danger" href="{{ url('admin/seller/specific/item', ['status'=>'delete','id'=>$item->id , 'seller'=>$seller->id]) }}"> Delete <i class=" icon-trash"></i></a>
					</div>
				  </div>
			
				
				<hr class="soft"/> 
				<h4> @if($item->quantity == 0)
				     <span style="color : brown"> Out Of Stock</span>
			        @else {{ $item->initial_quantity }} | {{ $item->quantity }} items in stock
					@endif
					</h4>
				
				<hr class="soft clr"/>
				<p>
			    {{ $item->description ??  '' }}
				
				</p>
				<a class="btn btn-small pull-right" href="#detail">More Details</a>
				<br class="clr"/>
			<a href="#" name="detail"></a>
			<hr class="soft"/>
			</div>
			<div  class="span3"></div>
			<div class="span9">
        
            <div id="myTabContent" >
              <div class="tab-pane fade active in" id="home">
			  <h4>Product Information</h4>
                <table class="table table-bordered">
				<tbody>
				<tr class="techSpecRow"><th colspan="2">Product Details and Features</th></tr>
				
				@if( $features && $features_key)
				  @foreach($features_key as $key)
				<tr class="techSpecRow"><td class="techSpecTD1"><b>{{ ucfirst($key) }}</b></td><td class="techSpecTD2">{{ $features->{$key} }}</td></tr>
				  @endforeach
				 @endif


				<tr class="techSpecRow"><td class="techSpecTD1">Updated on:</td><td class="techSpecTD2"> {{ $item->updated_at  ??  ''}}</td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1"></td><td class="techSpecTD2"></td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Company Name:</td><td class="techSpecTD2">{{ $item->company ??  '' }}</td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Phone Contact:</td><td class="techSpecTD2">{{ $item->contact ??  '' }}</td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Item Location State:</td><td class="techSpecTD2">{{ $item->state ??'' }}</td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Item Location City:</td><td class="techSpecTD2">{{ $item->city ?? '' }}</td></tr>
				</tbody>
				</table>
				
				<h5>Features</h5>
				<p>
				{{ $item->itemDetail->features ??  '' }}
				</p>

              </div>
	
		
		<br class="clr"/>
		<hr class="soft"/>
	     <h3 style="color : brown">Related Items</h3>
       <!-- Block view of items  -->
       </div>
	 
			<div class="tab-pane active" id="blockView">
				<ul class="thumbnails">
				  @if($items != null && count($items) > 0)
                  @foreach($items as $t)
					<li class="span3">
					  <div class="thumbnail">
					   <b>{{ $t->quantity }}</b> pcs
						<a href="{{ url('admin/seller/specific/item', ['status'=>'view','id'=>$t->id , 'seller'=>$seller->id ]) }}"><img src="{{ url($t->image1) }}" alt=""/></a>
						<div class="caption">
						<h5>{{  substr(( $t->name .' | '.  $t->item_type ),0, 20) }} {{ strlen( $t->name .' | '.  $t->item_type) > 25 ? '...' : '' }}</h5>
						  <p> 
							{{ substr($t->description, 0, 20) }}
						  </p>
						  <h4 style="text-align:center"><a class="btn btn-xs" href="#">{{$t->new_price}} </a> <a class="btn btn-xs btn-success" href="{{ url('admin/seller/specific/item', ['status'=>'view','id'=>$t->id , 'seller'=>$seller->id]) }}">View</a>  <a class="btn btn-danger btn-xs" href="{{ url('admin/seller/specific/item', ['status'=>'delete','id'=>$t->id , 'seller'=>$seller->id ]) }}">Delete</a></h4>
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
	   <h3 style="color : brown"> The items category you looking is not yet available. </h3>
	@endif
</div>
</div> 

<!-- MainBody End ============================= -->
@endsection