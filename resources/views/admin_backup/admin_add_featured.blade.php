@extends('layout.admin')
 @section('content')
  
<div class="page-header">
<h3>Image(s) For Featured Item Upload</h3>
<h4>Here you can upload beautiful images for featured product/item for the home page. The size should be: <u style="color : brown">1170x300</u> pixel.</h4>
<b>Note:</b> <b style="color : brown">The featured image is always associated to an item that is already posted. Therefore,  you should get the item id and enter it into the input field beside the image uploader.<br />
</b>
<h4>Image Dimension should be : <u>1170x300 pixel</u> </h4>
</div>
@include('inc.message')
<!-- The beginning of the body -->
<div class="row-fluid">
<div class="span1"></div>
<div class="span10">

 <div class="form-inline">
     <div class="row-fluid">
     <div class="span10">
        {{ Form::open(['url'=>'admin/add/featured',  'files' => 'true', 'role'=>'form']) }}
                 {{ csrf_field() }}
        <div class="control-group">
            <label style="font-size: 12px" class="control-label" for="category"><b>Enter The Item Id Here:</b><br />
            <span style="color: brown;">(required)</span> Enter the item id number that the image will feature.
            
             </label>
            <div class="controls">
             <input required placeholder="Item Id no:" name="item_id"  type="text"  class="input-large form-control" id="category">     
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