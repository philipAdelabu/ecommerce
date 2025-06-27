@extends('layout.admin')
 @section('content')
  
<div class="page-header">
<h3>Add Text For Scrolling.</h3>
This section . You can also deleted and re-add again text that needs to scroll .
</div>
<!-- The beginning of the body -->
@include('inc.message')

<div class="row-fluid">
<div class="span1"></div>
<div class="span10">


Add a scrolling message that will be display in the home page of the index.<br /><br />
 <div class="form-inline">
     <div class="row-fluid">
     <div class="span5">
        {{ Form::open(['url'=>'add_marquee', 'role'=>'form']) }}
                 {{ csrf_field() }}
        <div class="control-group">
            <label class="control-label" for="category">Enter the scrolling message</label>
            <div class="controls">
             <textarea rows="7" cols="10" name="message" class="input-xlarge" ></textarea>
            </div>
          </div>
          <button type="submit" class="btn btn-success btn-lg" >Submit</button>
          {{ Form::close() }}
          </div>


            <div class="span5">
                 @if($message != null)
                  <div class="control-group">
			          <label class="control-label" for="category">Current Scrolling Text</label>
		         	<div class="controls">
			         <textarea rows="7"  disabled class="input-xlarge" > {{ $message }} </textarea>
                      
			          </div>
                  </div>
                  <a href="{{ url('delete/scrolling/text') }}" class="btn btn-danger btn-lg" >Delete</a>
                 @endif
               </div>


        </div>
       </div>
  
         </div>	
	</div>

 <hr />

 
        
        
		      
                 

         
       <br /><br /><br />
    
      </div>
      </div>
	
 @endsection