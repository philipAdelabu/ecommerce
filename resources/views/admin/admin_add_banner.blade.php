@extends('layout.admin')
 @section('content')
  
<div class="page-header">
<h3>Image(s) For Banner Upload</h3>
<h4>Here you can upload beautiful images for banner for the home page. The size should be: <u style="color : brown">1170x480</u> pixel.</h4>
<b>Note:</b> <b style="color : brown">If you want to associate the banner to an item that is already posted, as a featured product, then you should get the item id and enter it into the input field beside the image uploader. This action is actually optional.<br />

</b>
<h4>Image Dimension should be : <u>1170x480 pixel</u> </h4>
</div>
@include('inc.message')
<!-- The beginning of the body -->
<div class="row-fluid">
<div class="span1"></div>
<div class="span10">

<br />
       
       <div class="form-inline">
     <div class="row-fluid">
     <div class="span10">
        {{ Form::open(['url'=>'admin/add/banner_ad',  'files' => 'true', 'role'=>'form']) }}
                 {{ csrf_field() }}
        <div class="control-group">
            <label class="control-label" for="category"><b style="font-size: 11px;"><span style="color: brown">(optional)</span> Enter the item id no, <br /> if the banner features the item.</b></label>
            <div class="controls">
             <input placeholder="item id no:" name="item_id"  type="text"  class="input-large form-control" id="category">     
             <input required class="input-file input-large form-control" id="image_3" name="image" type="file">
             &nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-danger btn-lg" >Submit Business Ad Banner</button>
            </div>
          </div>
          {{ Form::close() }}
          </div>
        </div>
       </div>
       
       <br />
       
       
    
      </div>
      </div>
	
 @endsection