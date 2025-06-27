@extends('inc.admin.general')
@section('title') Search For Any User or Member @endsection
@section('content')
       <!-- The content start here --->
  @include('inc.message')
 <div class="center" style="margin: 4%  20%  20% 20% " >
     		<div class="hr"></div>
                                                        
														<div class="hr"></div>
														<div style="text-align: left">
														 @if(!empty($total ))
														 <p>Total number of search result : <b>{{ count($total) }}</b></p><br />
                                                           @php $i = 1 @endphp
														   @if(count($present) > 0)
														   @foreach($present as $p)
                                                              <p>{{ $i++ }}&nbsp;&nbsp;&nbsp;&nbsp;  <a href=" " >{{ $p->user_code }}</a>  &nbsp;&nbsp;&nbsp;&nbsp;{{ $p->name }}</p>
														   @endforeach 
														   @endif
														 @endif
														 </div>
														 <div class="pagination">
														 {{ $present->links() }}
														 </div>
														<hr />
 </div>
@endsection