@extends('layout.admin')
 @section('content')
  
<div class="page-header">
<h3>Select and Edit/update a Category or Brand name </h3>
 You are free to edit, update or delete a category or sub-category from the section.
</div>
<!-- The beginning of the body -->
@include('inc.message')
<br />
   
	<div class="container">
	<div class="row">
<!-- Sidebar ================================================== -->
<div  class="span5">
       <h4>Select And Edit Category</h4>
		<ul  class="nav nav-tabs nav-stacked">
		 @if(count($categories) > 0 )
		  @foreach($categories as $category)
		  <li ><a href="{{ url('admin/edit/item', ['type'=>'category','id'=>$category->id]) }}">{{ $category->name}}</a></li>
		  @endforeach
      @endif
		</ul>
		<br/>
	</div>
	<div class="span1"></div>
	<div id="sidebar" class="span5">
	 <h4>Select a Category And a Brand to Edit</h4>
		<ul id="sideManu" class="nav nav-tabs nav-stacked">
		 @if(count($categories) > 0 )
		  @foreach($categories as $category)
		  <li class="subMenu open"><a href="">{{ $category->name}} <i class="icon-chevron-down pull-right"></i></a>
		      <ul style="display:none">
			    @foreach($category->subCategory as $subCatg)
				<li><a  href="{{ url('admin/edit/item', ['type'=>'sub_category','id'=>$subCatg->id]) }}"><i class="icon-chevron-right"></i>{{ $subCatg->name }} </a> </li>
				@endforeach
			  </ul>
		  </li>
		  @endforeach 
       @endif
		</ul>
		<br/>
	</div>
<!-- Sidebar end=============================================== -->

</div></div></div>	
<br /><br /><br />
 @endsection