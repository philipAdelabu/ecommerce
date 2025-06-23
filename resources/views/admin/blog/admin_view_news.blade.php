@extends('layout.admin')
@section('content')

<!-- Sidebar end=============================================== -->
    <ul class="breadcrumb">
   <li class="active">View All Submitted Posts</li>
    </ul>
	@include('inc.message')	 			
			<div class="span9">
        
            <div id="myTabContent" >
          
		<hr class="soft"/>
	     <h3 style="color : brown">Posts</h3>
       <!-- Block view of items  -->
       @if($news != null )
			<div class="tab-pane active" id="blockView">
				<ul class="thumbnails">
				  @if($news != null && count($news) > 0)
				    @foreach($news as $t)
					<li class="span3">
					  <div class="thumbnail">
					     <p> 
						 <span style="color : blue; font-size : 12px;">{{ strlen($t->title) < 25 ?   $t->title : substr($t->title, 0, 24) }} ..</span>
						 </p>
					
						<a href="{{ url('admin/specific/news', ['status'=>'view','id'=>$t->id ]) }}">
						@if($t->image) <img src="{{ url($t->image)  }}" alt=""/>
                          @else <img src="{{ url('11.jpg')  }}" alt=""/>
                         @endif
						</a>
						<div class="caption">
						     <h4 style="text-align:center"><a class="btn btn-mini btn-success" href="{{ url('admin/specific/news', ['status'=>'view','id'=>$t->id ]) }}"> <i class="icon-zoom-in"></i> View</a> <a class="btn btn-mini btn-primary" href="{{ url('admin/specific/news', ['status'=>'edit','id'=>$t->id ]) }}" >Edit </a> <a class="btn btn-mini btn-danger" href="{{ url('admin/specific/news', ['status'=>'delete','id'=>$t->id ]) }}">Delete</a></h4>
						  <span style="font-size : 12px">Author : <b>{{ $t->author}}</b></span>
						  
						</div>
					  </div>
					</li>
					@endforeach
				   @endif
				  </ul>
				 </div>
			<hr class="soft"/>
			</div>
			
           <!-- The end of the block items -->
		<div class="pagination">
		{!! $news->render() !!} 
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