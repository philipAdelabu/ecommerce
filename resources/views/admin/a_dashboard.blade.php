@extends('layout.admin')
    @section('content')
 <div class="container">
	<div class="row">
          <div id="sidebar" class="span3">
          <div class="well well-small"> <strong></strong></div>
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
  
<!-- Heading
================================================ -->
<div class="page-header">
<h3>Add Item.</h3>
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
                    <label style="color: green" class="control-label" for="new_price">New Price</label>
                    <div class="controls">
                      <input required name="new_price" type="number" class="input-large" id="new_price">
                    </div>
                  </div>
               </div>
          
		  <div class="span5">
        <div class="control-group">
            <label class="control-label" for="old_price">Old Price <em style="color : brown ">(Optional)</em></label>
             <div class="controls">
                <input name="old_price" type="number" class="input-large" id="old_price">
			       </div>
        </div>
      </div>

               
		
         </div>	
	</div>

       
  
   <br />
      <div class="row-fluid">
      <div class="span5">
          <div class="control-group">
              <label class="control-label" for="name">Descriptive Name</label>
              <div class="controls">
                <input required name="name" type="text" class="input-xlarge" id="name">
              </div>
          </div>
       </div>
           <div class="span5">
              <div class="control-group">
                  <label class="control-label" for="quantity">Quantity</label>
                  <div class="controls">
                    <input required min=1 name="quantity" type="number" class="input-large" id="quantity">
                  </div>
              </div>
          </div>

          <div class="span12">
              <div class="control-group">
                  <label class="control-label" for="item_condition">Item condition <i style="color : red"> (Optional)</i></label>
                    <input  name="item_condition"  class="input-xxlarge" id="item_condition">
              </div>
          </div>

     </div> <!-- The end of the row-fluid --> 
  <br />


         
 
     <div class="row-fluid">

     <div class="span5">
        <div class="control-group">
            <label class="control-label" for="category">Category</label>
            <div class="controls">
            <select required name="category" id="category" class="input-xlarge form-control" onchange="load_subCategory();" >
               <option  value>-- Select Category --</option>
               @if(count($categories) > 0)
                    @foreach($categories as $catg)
                    <option value="{{ $catg->id .'/'. $catg->name }}">{{ $catg->name }}</option>
                    @endforeach
               @endif
        
              </select>
            </div>
          </div>
          </div>

    <div class="span5">
        <div class="control-group">
            <label class="control-label" for="sub_category">Brand Name</label>
            <div class="controls">
              <select required name="sub_category" id="sub_category">
               <option  value>-- Select Brand Name --</option>
              </select>
            </div>
          </div>
          </div>
       </div>

       <hr />
   

 
   
       
<h5>Add Features and Specification(s)  <b style="color : brown">(Optional)</b></h5>
<table class="table table-striped table-bordered table-hover table-responsible" id="placeholder"></table>
<hr />
<div  style="background-color : #eee; padding : 10px;">
     
<div class="row-fluid">
  
   <div class="span4 ">
    <label>Feature</label>
    <input id="key" style="font-weight:bold;" type="text" placeholder="Feature" class="form-control" >
    </div>
    <div class="span6">
    <label>Spec</label> 
    <input  id="val" type="text" placeholder="Spec" class=" form-control input-xlarge" >
    <a style="" class="btn btn-xs btn-primary" onclick=" return addField();">Click To Add spec</a>
  </div>

 </div>
 <span style="font-size: 15px;">e.g &nbsp;&nbsp; <b>Size :</b> &nbsp;&nbsp;&nbsp;&nbsp;29 inches</span> 
 <br /><i style="color : brown; font-size: 12px;">(You can add more <b>specification</b> of your item from here. Write the <b>Attribute</b> and <b>Value</b> in the input fields above.)</i> <br />
  
</div>
    <hr />

    <div class="control-group">
            <label class="control-label" for="description">More Details and Description  <b style="color : brown">(Optional)</b></label>
            <div class="controls">
              <textarea name="description" class="input-xxlarge" id="description" rows="5"></textarea>
            </div>
          </div>
      <hr />
      <div class="control-group">
            <label class="control-label" for="package-item">Add Items inside package separated by comma or semi-colon  <b style="color : brown">(Optional)</b></label>
            <div class="controls">
              <textarea name="package" class="input-xxlarge" id="package-item" rows="5"></textarea>
            </div>
          </div>
      <hr />

  <h4>Image size should be 1200 x 1000 px</h4>

            <div class="row-fluid">
   
                  <div class="span6 control-group">
                    <label class="control-label" for="images">Image 1  <i style="color : green"><b>(Required)</b></i></label>
                    <div class="controls">
                      <input required="true" class="input-file" id="images" name="images[]" type="file">
                    </div>
                  </div>

                  <div class="span6 control-group">
                    <label class="control-label" for="images">Image 2  <i style="color : brown">(Optional)</i></label>
                    <div class="controls">
                      <input  class="input-file" id="image_2" name="images[]" type="file">
                    </div>
                  </div>
            </div>
            <div class="row-fluid">
              <div class="span6 control-group">
                <label class="control-label" for="image_3">Image 3  <i style="color : brown">(Optional)</i></label>
                <div class="controls">
                  <input class="input-file" id="image_3" name="images[]" type="file">
                </div>
              </div>
              <div class="span6 control-group">
                <label class="control-label" for="image_4">Image 4  <i style="color : brown">(Optional)</i></label>
                <div class="controls">
                  <input  class="input-file" id="image_4" name="images[]" type="file">
                </div>
              </div>
          </div>
          <div class="span12 control-group"><br />
              <label class="control-lable" for="video">Embed Youtube video url  <i style="color : brown">(Optional)</i></label>
              <input type="text" name="video" id="video" class="input-xxlarge"
              placeholder="https://www.youtube.com/embed/v9sm86IEPIg?si=2Vg_W7_CibBPNoTi" />
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

</div>
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
         
        
         function addField(){
            k = document.getElementById('key').value;
            val = document.getElementById('val').value;

           
           
            if(val == '' || val == null) { $('#val').focus(); $('#val').css("border-color", "red");  return; }
            if(k == '' || k == null) { $('#key').focus(); $('#key').css("border-color", "red");  return; }
            
            //Get the attention of the lastchild of the table
            table = $('#placeholder');
            table_children = table.find('tr');
            if(table_children.length > 0){ id = parseInt(table_children[table_children.length - 1].getAttribute('id')) + 1; }
            else id = 1;
           
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