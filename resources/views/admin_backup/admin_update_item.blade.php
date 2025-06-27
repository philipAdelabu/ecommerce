@extends('layout.admin')
    @section('content')
  
<!-- Heading
================================================== -->
<div class="page-header">
<h3>Update Itme  </h3>
 Here you can update products and items for sales.
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
          
		            
                <input type="hidden" name="update_item" value="update_item" /> 
                <input type="hidden" name="category_changed" id="category_changed" />
               <div class="span5">
                   <div class="control-group">
                      <label style="color: green" class="control-label" for="new_price">New Price</label>
                      <div class="controls">
                        <input name="new_price" type="number" class="input-large" id="new_price" value="{{ $item->new_price ?? '' }}">
                      </div>
                    </div>
               </div>
               <div class="span5">
                  <div class="control-group">
		                	<label style="color: red" class="control-label" for="old_price">Old Price</label>
                      <div class="controls">
                            <input type="hidden" name="update" value="1" />
                            <input type="hidden" name="item_id" value="{{ $item->id }}" />
                        <input name="old_price" type="number" class="input-large" id="old_price" value="{{ $item->old_price ?? '' }}">
                      </div>
                  </div>
               </div>

               <div class="span12">
                 <div class="control-group">
                  <label class="control-label" for="item_condition">Item condition <i style="color : red"> (Optional)</i></label>
                    <input  name="item_condition"  value="{{ $item->item_condition ?? '' }}" class="input-xxlarge" id="item_condition">
                  </div>
              </div>
		
         </div>	
	</div>

  
     <div class="row-fluid">
      <div class="span5">
          <div class="control-group">
            <label class="control-label" for="name">Descriptive Name</label>
            <div class="controls">
              <input required name="name" type="text" class="input-xlarge" id="name" value="{{ $item->name ?? '' }}">
            </div>
          </div>
     </div>
      <div class="span5">
             <div class="control-group">
                 <label class="control-label" for="quantity">Quantity</label>
                 <div class="controls">
                    <input min=1 name="quantity" type="number" class="input-large" id="quantity" value="{{ $item->quantity ?? '' }}"  />
                </div>
            </div>
      </div>

           <div class="span12">
              <div class="control-group">
                  <label class="control-label" for="item_condition">Item condition <i style="color : red"> (Optional)</i></label>
                  <div class="controls">
                    <input  name="item_condition" value="{{ $item->item_condition ?? '' }}"  class="input-xxlarge" id="item_condition" />
                  </div>
              </div>
          </div>

</div>



    <br />


     <div class="row-fluid">

     <div class="span6">
        <div class="control-group">
            <label class="control-label" for="category">Category</label>
            <div class="controls">
            <select required name="category" id="category" class="input-xlarge form-control" onchange="load_subCategory();" >
            <option>{{ $item->category ?? '-- Change Category --' }}</option>  
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
            <label class="control-label" for="sub_category">Brand Name</label>
            <div class="controls">
              <select required name="sub_category" class="input-xlarge form-control" id="sub_category">
              <option>{{ $item->sub_category ?? '-- select brand name --' }}</option> 
              </select>
              <input type="hidden" name="sub_category_id" value="{{ $item->sub_category_id}}" id="sub_categry_id" />
            </div>
          </div>
          </div>
       </div>
 
         <hr />
  

   @if( $features && $features_key)
      @php $i = 1 ; @endphp
				  @foreach($features_key as $key)
  <div id="{{ $i }}" class="row-fluid">
   <div class="span4 ">
    <input name="{{ 'key_'.$i }}" style="font-weight:bold;" type="text" value="{{ ucfirst($key) }}" class="form-control" >&nbsp;&nbsp;<span style="font-size: 20px; font-weight: bold;">:</span>
    </div>
    <div class="span6">
     <input  name="{{ 'value_'.$i }}" type="text" value="{{ $features->{$key} }}" class=" form-control input-xxlarge" >
  </div>
    <div class="span2"><a class="btn btn-xs btn-danger" onclick="remove_row({{ $i }});">Remove</a></div>
  </div>
        @php $i++; @endphp
          @endforeach
				 @endif
       
<h5>Features and Specification(s)  <b style="color : brown"> (Optional)</b></h5>
<table class="table table-striped table-bordered table-hover table-responsible" id="placeholder"></table>
<hr />
 
<div  style="background-color : #eee; padding : 10px;">
<div class="row-fluid">
   <div class="span4 ">
    <label>Spec </label><input id="key" style="font-weight:bold;" type="text" placeholder="Attribute" class="form-control" >&nbsp;&nbsp;<span style="font-size: 20px; font-weight: bold;">:</span>
    </div>
    <div class="span6">
    <label>Value</label> <input  id="val" type="text" placeholder="Value" class=" form-control input-xlarge" >
    <br /><br />
    <a style="" class="btn btn-xs btn-primary" onclick=" return addField();">Click To Add spec</a>
  </div>
 
 </div>
 <span style="font-size: 15px;">e.g &nbsp;&nbsp; <b>Size :</b> &nbsp;&nbsp;&nbsp;&nbsp;29 inches</span> 
 <br /><i style="color : brown; font-size: 12px;">(You can add more <b>specification</b> of your item from here. Write the <b>Attribute</b> and <b>Value</b> in the input fields above.)</i> <br /> 
 </div>
 <hr />

<div class="control-group">
     <label class="control-label" for="description">More Details and Description   <b style="color : brown"> (Optional)</b></label>
     <div class="controls">
       <textarea name="description" class="input-xxlarge" id="description" rows="5">{{ $item->description ?? '' }}</textarea>
     </div>
 </div>
<hr />

<div class="control-group">
     <label class="control-label" for="package"> Package items <b style="color : brown"> (Optional)</b> </label>
     <div class="controls">
       <textarea name="package" class="input-xxlarge" id="package" rows="5">{{ $item->package ?? '' }}</textarea>
     </div>
 </div>
<hr />

   
 <h4>Image size should be 1200 x1000 px</h4>
          
          <div class="row-fluid">
            
            <div class="span6 control-group">
              <label class="control-label" for="images">Image 1 </label>
              <div class="controls">
                <input class="input-file" id="images" name="images[]" type="file">
                <img height="40" width="40" src="{{ url($item->image1) }}" alt="" />
              </div>
            </div>

            <div class="span6 control-group">
              <label class="control-label" for="images">Image 2  </label>
              <div class="controls">
                <input  class="input-file" id="image_2" name="images[]" type="file">
                <img height="40" width="40" src="{{$item->image2 ?  url($item->image2) : '' }}" alt="" />
              </div>
            </div>
          </div>
          <div class="row-fluid">
          <div class="span6 control-group">
          <label class="control-label" for="image_3">Image 3  </label>
          <div class="controls">
            <input class="input-file" id="image_3" name="images[]" type="file">
            <img height="40" width="40" src="{{ $item->image3 ?  url($item->image3) : '' }}" alt="" />
          </div>
          </div>
          <div class="span6 control-group">
          <label class="control-label" for="image_4">Image 4  </label>
          <div class="controls">
            <input  class="input-file" id="image_4" name="images[]" type="file">
            <img height="40" width="40" src="{{ $item->image4 ?  url($item->image4) : ''  }}" alt="" />
          </div>
          </div>
          </div>


          <div class="span12 control-group"><br />
              <label class="control-lable" for="video">Embed Youtube video url  <i style="color : brown">(Optional)</i></label>
              <input type="text" name="video" id="video" placeholder="https://www.youtube.com/embed/v9sm86IEPIg?si=2Vg_W7_CibBPNoTi"
               value="{{ $item->video_url ?? '' }}" class="input-xxlarge" />
          </div>

        <hr /><br />
        <div style="text-align:center" class="">
            <button type="submit" class="btn btn-success">Submit Item</button>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <button type="reset" class="btn btn-danger">Reset</button>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="{{ url('admin_view_item') }}" class="btn btn-info">Cancel</a>
          </div>
        </fieldset>
      {{ Form::close() }}
      </div>
      </div>


      <script>
         function load_subCategory(){
            catg_id = document.getElementById('category').value;
           // catg_id = catg_id.split('/');
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
               sub_catg.innerHTML = '<option required value>  -- select sub-category -- </option>';
                catg_changed = document.getElementById('category_changed');
                catg_changed.setAttribute('value', 'yes');
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

            
         function addField(){
            k = document.getElementById('key').value;
            val = document.getElementById('val').value;

           
           
            if(val == '' || val == null) { $('#val').focus(); $('#val').css("border-color", "red");  return; }
            if(k == '' || k == null) { $('#key').focus(); $('#key').css("border-color", "red");  return; }
            
            //Get the attention of the lastchild of the table
            table = $('#placeholder');
            table_children = table.find('tr');
            if(table_children.length > 0){ id = parseInt(table_children[table_children.length - 1].getAttribute('id')) + 1; }
            else id = 20;
           
            document.getElementById('key').value = '';
            document.getElementById('val').value = '';
            
            tr = document.createElement('tr');
            tr.setAttribute('id', id);
            tr.innerHTML = '<td><input type="hidden" id="key_'+ id +'" name="key_'+ id +'" value="'+ k +'" /><b>'+ k +'</b> </td>'+
                        '<td><input type="hidden" id="value_'+ id +'" name="value_'+ id +'" value="'+ val +'"/> '+ val +'</td>'+
                        '<td style="text-align: right"> <a class="btn btn-xs btn-danger" onclick="remove_row('+id+');">Remove</a> </td>';
   
               (document.getElementById('placeholder')).appendChild(tr);
          
         }

         function remove_row(id){
             document.getElementById(id).remove();
         }

      </script>
	
    @endsection