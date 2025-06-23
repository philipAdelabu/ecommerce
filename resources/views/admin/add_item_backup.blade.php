@extends('layout.admin')
    @section('content')
  
<!-- Heading
================================================== -->
<div class="page-header">
<h3>Add Itme for Sale </h3>
 Here you can add products and items for sales.
</div>
<!-- The beginning of the body -->
 @include('inc.message')

<div class="row-fluid">
<div class="span1"></div>
<div class="span10">
{{ Form::open(['url'=>'admin_add_product', 'files' => 'true', 'role'=>'form', 'enctype'=>'multipart/form-data']) }}
     {{ csrf_field() }}
        <fieldset>
        <div class="well form-inline">
         <div class="row-fluid">
          
		 <div class="span5">
                  <div class="control-group">
			<label class="control-label" for="old_price">Old Price <em style="color : brown ">(Optional)</em></label>
			<div class="controls">
			  <input name="old_price" type="number" class="input-large" id="old_price">
			</div>
                  </div>
               </div>

               <div class="span5">
                  <div class="control-group">
			<label style="color: green" class="control-label" for="new_price">New Price</label>
			<div class="controls">
			  <input required name="new_price" type="number" class="input-large" id="new_price">
			</div>
                  </div>
               </div>
		
         </div>	
	</div>

       <!--
        <div class="control-group">
            <label class="control-label" for="display_type">Diplay Type</label>
            <div class="controls">
              <select name="display_type" id="display_type">
              <option value="None">None</option>
                <option value="Special">Special</option>
                <option value="Featured">Featured</option>
              </select>
            </div>
          </div>
        --> 
       
    <div class="control-group">
			<label class="control-label" for="name">Item Name</label>
			<div class="controls">
			  <input name="name" type="text" class="input-xxlarge" id="name">
			</div>
   </div>
   <br />
<div class="row-fluid">
<div class="span6">      
		<div class="control-group">
			<label class="control-label" for="state">State Location Of Item<sup style="color : brown">(Optional)</sup></label>
			<!-- name="ostate" -->
			<div class="controls">
			    @include('admin.nigeria_states')
			</div>
		</div>
    </div>	

<div class="span6">
		<div class="control-group">
			<label class="control-label" for="city">City Location Of Item<sup style="color : brown">(Optional)</sup></label>
			<div class="controls">
			<input  class="input-xlarge"  required name="city" type="text" id="city" placeholder="City">
			<!-- <select name="lga" id="lga"> <option selected="selected">Select item...</option> </select>	-->
			</div>
		</div>
    </div>
  </div> <!-- The end of the row-fluid --> 
  <br />


    <div class="control-group">
			<label class="control-label" for="quantity">Quantity</label>
			<div class="controls">
			  <input min=1 name="quantity" type="number" class="input-large" id="quantity">
			</div>
           </div>
 
     <div class="row-fluid">

     <div class="span6">
        <div class="control-group">
            <label class="control-label" for="category">Category</label>
            <div class="controls">
            <select required name="category" id="category" class="input-xlarge form-control" onchange="load_subCategory();" >
               <option>-- Select Category --</option>
               @if(count($categories) > 0)
                    @foreach($categories as $catg)
                    <option value="{{ $catg->id .'/'. $catg->name }}">{{ $catg->name }}</option>
                    @endforeach
               @endif
        
              </select>
            </div>
          </div>
          </div>

    <div class="span6">
        <div class="control-group">
            <label class="control-label" for="sub_category">Sub-Category</label>
            <div class="controls">
              <select required name="sub_category" id="sub_category">
               <option>-- Select Sub-Category --</option>
              </select>
            </div>
          </div>
          </div>
       </div>
 
           
      <div class="control-group">
			  <label class="control-label" for="brand">Brand</label>
			   <div class="controls">
			     <input name="brand" type="text" class="input-xxlarge" id="brand">
		    	</div>
        </div>

              <div class="control-group">
		          	<label class="control-label" for="model">Model</label>
		         	 <div class="controls">
			           <input name="model" type="text" class="input-xxlarge" id="model">
			          </div>
              </div>


              <div class="control-group">
			<label class="control-label" for="size">Size</label>
			<div class="controls">
			  <input name="size" type="text" class="input-xxlarge" id="size">
			</div>
              </div>

              <div class="control-group">
			<label class="control-label" for="dimension">Dimension</label>
			<div class="controls">
			  <input name="dimension" type="text" class="input-xxlarge" id="dimension">
			</div>
              </div>
		
              <div class="control-group">
            <label class="control-label" for="features">Features</label>
            <div class="controls">
              <textarea name="features" class="input-xxlarge" id="features" rows="4"></textarea>
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="description">Description</label>
            <div class="controls">
              <textarea name="description" class="input-xxlarge" id="description" rows="4"></textarea>
            </div>
          </div>
       
          <div class="control-group">
            <label class="control-label" for="images">Image 1</label>
            <div class="controls">
              <input required="true" class="input-file" id="images" name="images[]" type="file">
            </div>
          </div>

          <div class="control-group">
            <label class="control-label" for="images">Image 2 </label>
            <div class="controls">
              <input required="true" class="input-file" id="image_2" name="images[]" type="file">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="image_3">Image 3</label>
            <div class="controls">
              <input required="true" class="input-file" id="image_3" name="images[]" type="file">
            </div>
          </div>
          <div class="control-group">
            <label class="control-label" for="image_4">Image 4</label>
            <div class="controls">
              <input required="true" class="input-file" id="image_4" name="images[]" type="file">
            </div>
          </div>
        <br />
          <div>
            <button type="submit" class="btn btn-primary">Submit Item</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="reset" class="btn btn-danger">Reset</button>
          </div>
        </fieldset>
      {{ Form::close() }}
      </div>
      </div>


      <script>
         function load_subCategory(){
            catg_id = document.getElementById('category').value;
            catg_id = catg_id.split('/');
            $.get("get/subCategory/"+catg_id,
            function(data, status){
          // alert("Data: " + JSON.parse(data) + "\nStatus: " + status);
            if(status && data){
                sub_catg = document.getElementById('sub_category');
                while(sub = document.getElementById('sub_catg')){
                    sub_catg.removeChild(sub);
                }
                data = JSON.parse(data);
               sub_catg = document.getElementById('sub_category');
               for(var i = 0; i < data.length; i++){
                 option = document.createElement('option');
                 option.setAttribute('value', data[i]);
                 option.setAttribute('id','sub_catg');
                 option.innerHTML = data[i]; 
                 sub = sub_catg.appendChild(option); 
               } 
              }
             });
         }
      </script>
	
    @endsection