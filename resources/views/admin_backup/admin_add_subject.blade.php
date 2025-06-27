@extends('inc.admin.general')
@section('title')Add Subject to Classes   @endsection
@section('content')
  <!-- The content start here --->
  @include('inc.message')

  {{ Form::open(['url'=>'admin_add_subject', 'class'=>'form-horizontal', 'role'=>'form']) }}
    {{ csrf_field() }}
     
	            <div style="margin-left:15%"  class="row"> 
	               <div class="col-sm-6 col-md-6">
      	                <div class="form-group ">
                           <p> Type Subject:  <input required='true' name="subject" class="form-control" /></p>
                        </div>
                  </div>
    
		<div style="margin-top : 15px" class="col-sm-4 col-md-4" >
         {{ Form::submit('Add New Subject', ['class'=>'btn btn-success']) }}
      </div>
	</div>
  {{ Form::close() }}



  <hr />
	<h4>Available Subjects</h4>
	<table class="table table-striped table-bordered table-hover">
	<thead><th>SN</th><th>Subject</th><th>Action</th></thead>
	<tbody>
	@if($subjects !=  null)
	  @php $i = 1; @endphp
      @foreach($subjects as $subject)
      <tr><td>{{ $i++ }}</td><td>{{ strtoupper($subject->name) }}</td><td>
	     <a class="btn btn-sm btn-danger" href="{{ url('delete/subject', ['id'=>$subject->id]) }}"  onclick="return confirm('Are you sure you want remove this subject?')">Delete</a> 
	     <a class="btn btn-sm btn-success" href="{{ url('edit/subject', ['id'=>$subject->id]) }}"  onclick="return confirm('Are you sure you want edit this subject?')">Edit</a>
	  </td></tr>
      @endforeach
	@endif
	</tbody>
	</table>
    <hr />
  
@endsection
