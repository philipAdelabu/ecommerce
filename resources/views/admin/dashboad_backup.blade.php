@extends('layout.admin')
 @section('content')
  
<div class="page-header">
<h3>Add Category and Sub-category.</h3>
 Various category and sub-category can be added here for the seller to easily post related items.
 
</div>
<!-- The beginning of the body -->
@include('inc.message')
<br />
<div class="row-fluid">
<div class="span1"></div>
<div class="span10">
  
       
        <div class="form-inline">
         <div class="row-fluid">
         {{ Form::open(['url'=>'add_category', 'role'=>'form']) }}
                 {{ csrf_field() }}
		      <div class="span5">
                  <div class="control-group">
			          <label class="control-label" for="category">Add Category</label>
		         	<div class="controls">
			          <input required name="category" type="text" class="input-large form-control" id="category">
                      <button type="submit" class="btn btn-primary btn-lg" >Add</button>
			       </div>
                  </div>
               </div>
                  
            {{ Form::close() }}
		
         </div>	
	</div>

 <hr />
 Add A Sub-category after selecting a category in the category option.<br /><br />
 <div class="form-inline">
     <div class="row-fluid">
     <div class="span10">
        {{ Form::open(['url'=>'add_sub_category', 'role'=>'form']) }}
                 {{ csrf_field() }}
        <div class="control-group">
            <label class="control-label" for="category">Select a Category</label>
            <div class="controls">
              <select required name="catg_id" id="category" class="input-xlarge form-control" >
               @if(count($categories) > 0)
                    @foreach($categories as $catg)
                    <option value="{{ $catg->id }}">{{ $catg->name }}</option>
                    @endforeach
               @else
                 <option></option>
               @endif
        
              </select>
              <input required placeholder="Enter Sub-category" name="sub_category" type="text" class="input-xlarge " id="sub_category">
             <button type="submit" class="btn btn-danger btn-lg" >Add Sub-category</button>
            </div>
          </div>
          {{ Form::close() }}
          </div>
        </div>
       </div>
         
       <br /><br /><br />
    
      </div>
      </div>
	
 @endsection