@extends('inc.admin.general')
@section('title') Search For Any User or Member @endsection
@section('content')
       <!-- The content start here --->
 <div class="center" style="margin: 2%  10%  0% 10% " >
     		<div class="hr"></div>
                                                          <form action="{{ url('find_user') }}" method="post" >
														       {{ csrf_field() }}
																<div class="input-group input-group-lg">
																	<span class="input-group-addon">
																		UserId or FullName:
																	</span>
																	<input required="true" name="user" type="text" class="form-control search-query" placeholder="UserId or FullName" />
																	<span class="input-group-btn">
																		<button type="submit" class="btn btn-default btn-lg">
																			<span class="ace-icon fa fa-search icon-on-right bigger-110"></span>
																			Search
																		</button>
																	</span>
																</div>
                                                                </form>
														<div class="hr"></div>
				@if(!empty($present ))
				

             <!-- Static Table Start -->
        <div class="data-table-area mg-tb-15">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="sparkline13-list">
                            <div class="sparkline13-hd">
                                <div class="main-sparkline13-hd">
                                    <h1>
														 Total number of search result : <b>{{ count($present) }}</b>
														 </h1>
                                </div>
                            </div>
                            <div class="sparkline13-graph">
                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    
                                    <table id="table" data-toggle="table" data-pagination="true" data-search="true" data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true" data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                        data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="state">S/N</th>
                                                <th data-field="id">User Id</th>
                                                <th data-field="name">Name</th>
                                                <th data-field="company" >Email</th>
                                                <th data-field="price">Phone</th>
                                                <th data-field="task">Address</th>
                                                <th data-field="date"></th>
												<th data-field="email" class="text-center">Status</th>
                                                <th data-field="action">Action</th>    
                                            </tr>
                                        </thead>
                                        <tbody class="text-center">
                                        @if($present !=  null)
	                                          @php $i = 1; @endphp
                                          @foreach($present as $d)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td><a href=" " >{{ $d->user_code }}</a></td>
                                                <td>{{ $d->name }}</td>
                                                <td>{{ $d->email }}</td>
												<td>{{ $d->phone }}</td>
												<td>{{ $d->address }}</td>                                   
                                                <td></td>
												<td></td>
                                                <td><a href="{{ url('disable/user', ['user_code'=> $d->user_code ]) }}" onclick="return confirm('Are you sure about this ?');" >Disable</a></td>
                                            </tr> 
                                            @endforeach
	                                    @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Static Table End -->
        @endif






												
 </div>
@endsection