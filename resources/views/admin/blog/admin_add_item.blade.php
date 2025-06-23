@extends('layout.admin')
   
   @section('editor_header')
 
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('editors/bower_components/font-awesome/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('editors/bower_components/Ionicons/css/ionicons.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('editors/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="editors/dist/css/skins/_all-skins.min.css') }}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{ url('editors/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
   @endsection('editor')

   @section('editor_footer')
   <!-- jQuery 3 -->
<script src="{{ url('editors/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ url('editors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- FastClick -->
<script src="{{ url('editors/bower_components/fastclick/lib/fastclick.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ url('editors/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ url('editors/dist/js/demo.js') }}"></script>
<!-- CK Editor -->
<script src="{{ url('editors/bower_components/ckeditor/ckeditor.js') }}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ url('editors/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ url('editors/displayeditor.js') }}"></script>
   @endsection()
    
    @section('content')
  
<!-- Heading
================================================== -->
<div class="page-header">
<h3>Add News </h3>
 
</div>
<!-- The beginning of the body -->
 @include('inc.message')

<div class="row-fluid">
<div class="span1"></div>
<div class="span10">
{{ Form::open(['url'=>'admin_add_news', 'files' => 'true', 'role'=>'form', 'enctype'=>'multipart/form-data']) }}
     {{ csrf_field() }}
        <fieldset>
     
     
 
    <div class="control-group">
			<label class="control-label" for="title"><b>Title</b></label>
			<div class="controls">
			  <input required name="title" type="text" class="input-xxlarge" id="title">
			</div>
   </div>
 
   <!-- Beginning of the editor content -->
   <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box box-info">
            <div class="box-header">
              <h3 class="box-title">News Content
                <small>Full Text Editor Features</small>
              </h3>
              <!-- tools box -->
              <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip"
                        title="Collapse">
                  <i class="fa fa-minus"></i></button>
             
              </div>
              <!-- /. tools -->
            </div>
            <!-- /.box-header -->
            <div class="box-body pad">
            <textarea name="content" id="editor1" name="editor" rows="10" cols="80"></textarea>
            </div>
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col-->
      </div>
      <!-- ./row -->
    </section>
    <!-- End of the Editor -->
   <br />
    <div class="control-group">
			<label class="control-label" for="author"><b>Author's Name</b></label>
			<div class="controls">
			  <input required name="author" type="text" class="input-xxlarge" id="author">
			</div>
   </div>
  <hr />

      <h4>Image For The News</h4>
          <div class="control-group">
            <label class="control-label" for="image">Image   <i style="color : green"><b>(Optional)</b></i></label>
            <div class="controls">
              <input class="input-file" id="image" name="image" type="file">
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


      
	
    @endsection