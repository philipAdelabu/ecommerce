@extends('layout.admin')

    @section('content')
  
  <div class="page-header">
  <h3>Select and Edit/update a Category or Sub-category </h3>
   You are free to edit, update or delete a category or sub-category from the section.
   <div style="float : right" >
		<a class="btn btn-danger" href="{{ url('view_category') }}"> Back To View Category</a><br />
    </div>
  </div>

  <!-- The beginning of the body -->
  @include('inc.message')

     
<div class="container">
                    
<div class="text-center">
  <div class="form-inline">
         <div class="row-fluid">
         {{ Form::open(['url'=>'admin_update_item', 'role'=>'form']) }}
                 {{ csrf_field() }}

                 <div class="span6">
                      <div class="control-group">
                        <b>Choose and Icon for Category</b><br /><br />
                          <i class="fa fa-desktop fa-lg"></i> <input class="form-control" type="radio" name="icon" {{ $item->icon == 'fa fa-desktop' ? 'checked' : '' }} value="fa fa-desktop" /> 
                        &nbsp;&nbsp;&nbsp; <i class="fa fa-camera fa-lg"></i> <input class="form-control" type="radio" name="icon" value="fa fa-camera" {{ $item->icon == 'fa fa-camera' ? 'checked' : '' }} /> 
                        &nbsp;&nbsp;&nbsp; <i class="fa fa-phone fa-lg"></i> <input class="form-control" type="radio" name="icon" value="fa fa-phone" {{ $item->icon == 'fa fa-phone' ? 'checked' : '' }} /> 
                        &nbsp;&nbsp;&nbsp; <i class="fa fa-book fa-lg"></i> <input class="form-control" type="radio" name="icon" value="fa fa-book" {{ $item->icon == 'fa fa-book' ? 'checked' : '' }} /> 
                        &nbsp;&nbsp;&nbsp; <i class="fa fa-television fa-lg"></i> <input class="form-control" type="radio" name="icon" value="fa fa-television" {{ $item->icon == 'fa fa-television' ? 'checked' : '' }} /> 
                        &nbsp;&nbsp;&nbsp; <i class="fa fa-microchip fa-lg"></i> <input class="form-control" type="radio" name="icon" value="fa fa-microchip" {{ $item->icon == 'fa fa-microchip' ? 'checked' : '' }} /> 
                        &nbsp;&nbsp;&nbsp; <i class="fa fa-laptop fa-lg"></i> <input class="form-control" type="radio" name="icon" value="fa fa-laptop" {{ $item->icon == 'fa fa-laptop' ? 'checked' : '' }} /> 
                        &nbsp;&nbsp;&nbsp; <i class="fa fa-tablet fa-lg"></i> <input class="form-control" type="radio" name="icon" value="fa fa-tablet" {{ $item->icon == 'fa fa-tablet' ? 'checked' : '' }}  /> 
                        &nbsp;&nbsp;&nbsp; <i class="fa fa-car fa-lg"></i> <input class="form-control" type="radio" name="icon" value="fa fa-car" {{ $item->icon == 'fa fa-car' ? 'checked' : '' }} /> 
                      
                    </div>
                     <hr />
                 </div>
		          <div class="span6">
                  <div class="control-group">
			          <label class="control-label" for="item">Update <b>{{ $item->name }}</b> category</label>
		         	<div class="controls">
                     <input required='true' value="{{ $item->name }}" name="item" class="input-xlarge form-control" />
                      <input type="hidden" name="id" value="{{ $item->id }}" /> 
                     <input type="hidden" name="type" value="{{ $type }}" /> 
                      <button type="submit" class="btn btn-success btn-lg" >Update Now</button>
			       </div>
                  </div>
               </div>
                  
            {{ Form::close() }}
         </div>	
	</div>
</div>



  <hr />
	<h4>Available Name(s)  To Edit For
    @if($type == 'sub_category')
       {{ strtoupper($item->category->name) }} category
     @else 
     {{ strtoupper($type) }}
    @endif
    </h4>
	<table class="table table-striped table-bordered table-hover">
	<thead><th>SN</th><th>Name</th><th>Action</th></thead>
	<tbody>
	@if($items !=  null)
	  @php $i = 1; @endphp
      @foreach($items as $item)
      <tr><td>{{ $i++ }}</td><td>{{ strtoupper($item->name) }}</td><td>
	     <a class="btn btn-sm btn-danger" href="{{ url('admin/delete/item', ['type'=>$type,'id'=>$item->id]) }}"  onclick="return confirm('Are you sure you want remove it?')">Delete</a> 
	     <a class="btn btn-sm btn-primary" href="{{ url('admin/edit/item', ['type'=> $type,'id'=>$item->id]) }}" >Edit</a>
	  </td></tr>
      @endforeach
	@endif
	</tbody>
	</table>

    </div>
    @endsection