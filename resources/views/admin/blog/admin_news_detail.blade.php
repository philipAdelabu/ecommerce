@extends('layout.admin')

@section('content')

<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->



<!-- Sidebar end=============================================== -->

	<div class="span9"> 
    <ul class="breadcrumb">
     <li class="active">Content Details</li>
    </ul>
	@include('inc.message')	  
	<br />
	@if($content != null)
	<div class="row">	  
			<div id="gallery" class="span3">
			@if($content->image)
            <a href="{{ url($content->image) }}" title="">
				<img src="{{ url($content->image)  }}" style="width:100%" alt=""/>
            </a>
			@else 
			<a href="{{ url('11.jpg') }}" title="">
				<img src="{{ url('11.jpg')  }}" style="width:100%" alt=""/>
            </a>
			@endif
			<br />
					
		 </div>
			<div class="span6">
				<small>Author: {{ $content->author }}</small><br />
				<small>Created: {{ $content->created_at }}</small>
				<hr class="soft"/>
		
				<h4>Title: <span style="color : brown">{{ $content->title }}</span></h4>
				<p>
				{!! $content->message !!}
				</p>
			   
			<hr class="soft"/>
			<div class="row">
					<div class="pull-right">
					  <a class="btn btn-sm btn-primary" href="{{ url('admin/specific/news', ['status'=>'edit','id'=>$content->id ]) }}"> Edit <i class=" icon-pencil"></i></a>
					 &nbsp;&nbsp;&nbsp;<a class="btn btn-sm btn-danger" href="{{ url('admin/specific/news', ['status'=>'delete','id'=>$content->id ]) }}"> Delete <i class=" icon-trash"></i></a>
					</div>
				  </div>
			</div>
			</div></div></div></div>
			<div class="span12"> 
        
            <div id="myTabContent" >
          
	
		
		<br class="clr"/>
		<hr class="soft"/>
	     <h3 style="color : brown">Related News</h3>
       <!-- Block view of items  -->
	  
			<div class="tab-pane active" id="blockView">
				<ul class="thumbnails">
				  @if($contents != null && count($contents) > 0)
				    @foreach($contents as $t)
					<li class="span3">
					  <div class="thumbnail">
					     <p> 
						  Title: <span style="color : blue; font-size : 12px;">{{ $t->title }}</span>
						 </p>
					
						<a href="{{ url('admin/specific/news', ['status'=>'view','id'=>$t->id ]) }}">
						 @if($t->image) <img src="{{ url($t->image)  }}" alt=""/>
                          @else <img src="{{ url('11.jpg')  }}" alt=""/>
                         @endif
						</a>
						<div class="caption">
						<p>	{!!  substr($t->message, 0, 20) !!} </p>
						 
						  <h4 style="text-align:center"><a class="btn btn-mini btn-success" href="{{ url('admin/specific/news', ['status'=>'view','id'=>$t->id ]) }}"> <i class="icon-zoom-in"></i> View</a> <a class="btn btn-mini btn-primary" href="{{ url('admin/specific/news', ['status'=>'edit','id'=>$t->id ]) }}" >Edit </a> <a class="btn btn-mini btn-danger" href="{{ url('admin/specific/news', ['status'=>'delete','id'=>$t->id ]) }}">Delete</a></h4>
						  <span style="font-size : 12px">Author : <b>{{ $t->author}}</b>
						  
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
		{!! $contents->render() !!} 
			</div>
				<br class="clr">
					 </div>
		</div>
          </div>
	</div>
	@else
	   <h3 style="color : brown"> The item or category you are looking for is not available Here. </h3>
	@endif
</div>
</div> 
</div>
<!-- MainBody End ============================= -->
@endsection