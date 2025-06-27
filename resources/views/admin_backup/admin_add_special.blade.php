@extends('layout.admin')
 @section('content')
  
<div class="page-header">
<h3>Image(s) For Special Product Upload</h3>
<h4>Enter thhe product/item Id number in the input field and upload the needed image with dimension <u style="color : brown">160x160</u> pixel.</h4>
<b>Note:</b> <b style="color : brown">The image product that needs to be displayed as a featured product  has to be associated with an already uploaded product/item in the database.<br />
The supplier or seller of the product, therefore needs to provide the product id number and the needed image to the admin for uploading as special product for advert.
</b>
<h4>Image Dimension should be : <u>500x380 pixel</u> </h4>
</div>
@include('inc.message')
<!-- The beginning of the body -->
<div class="row-fluid">
<div class="span1"></div>
<div class="span10">

 <div class="form-inline">
     <div class="row-fluid">
     <div class="span10">
        {{ Form::open(['url'=>'admin/add/special',  'files' => 'true', 'role'=>'form']) }}
                 {{ csrf_field() }}
        <div class="control-group">
            <label class="control-label" for="category"><b>Enter The Product Id Here:</b></label>
            <div class="controls">
             <input required name="item_id"  type="number" min="1" class="input-large form-control" id="category">     
             <input required="true" class="input-file input-large form-control" id="image_3" name="image" type="file">
             &nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-danger btn-lg" >Submit</button>
            </div>
          </div>
          {{ Form::close() }}
          </div>
        </div>
       </div>
         
       <br /><br />
    
      </div>
      </div>
	
 @endsection