@include('inc.dashboard.header')

            <div class="content">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg1"><i class="fa fa-laptop"></i></span>
							<div class="dash-widget-info text-right">
							     <h4>{{ count($items) }}</h4>
                                 <a href="{{ url('admin_add_product') }}"> <button type="button" class="btn btn-sm btn-primary">Add Product <i class="fa fa-plus" aria-hidden="true"></i> </button></a>
							</div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                            <div class="dash-widget-info text-right">
                                <h4>1072</h4>
                                <a href="#"> <button type="button" class="btn btn-sm btn-success">Add User <i class="fa fa-plus" aria-hidden="true"></i> </button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h4>72</h4>
                                <a href="#"> <button type="button" class="btn btn-sm btn-secondary">Add Admin <i class="fa fa-plus" aria-hidden="true"></i> </button></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                        <div class="dash-widget">
                            <span class="dash-widget-bg4"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                            <div class="dash-widget-info text-right">
                                <h4>618</h4>
                                <span class="widget-title4">Pending <i class="fa fa-check" aria-hidden="true"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
			
				<div class="row">
					<div class="col-12">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title d-inline-block">Recent Transactions</h4> <a href="appointments.html" class="btn btn-primary float-right">View all</a>
							</div>
							<div class="card-body p-0">
								<div class="table-responsive">
									<table class="table mb-0">
										<thead class="d-none">
											<tr>
												<th>Product</th>
												<th>Price</th>
												<th>User Name</th>
                                                <th>Contact</th>
												<th class="text-right">Status</th>
											</tr>
										</thead>
										<tbody>

                                        @if(count($purchases) > 0)
                                          @php $count = 1 ; @endphp
                                           @foreach($purchases as $t)

                                              <tr>
												<td   style="min-width: 200px;">
													<a class="avatar" href="#profile"><img style="height:20px; width: 20px;" src="{{ url($t->image) }}" /></a>
													<h2><a href="profile.html">{{ $t->product_name }} <span>{{ $t->item_id }}</span></a></h2>
												</td>
                                                <td>
													<h5 class="time-title p-0">=N= {{ number_format($t->price, 2) }}</h5>
													<p>{{ $t->transaction_id }}</p>
												</td>                 
												<td>
													<h5 class="time-title p-0">{{ $t->user_name }}</h5>
													<p>{{ $t->phone ? $t->phone : $t->email }}</p>
												</td>
												<td>
													<h5 class="time-title p-0">{{ $t->updated_at }}</h5>
													<p>
                                                        @if($t->status == 2) <span style="color : blue; font-weight: bold">Cancelled</span>
                                                        @elseif($t->status == 1) <span style="color : green; font-weight: bold">Processed</span>
                                                        @else <i style="color : orange; font-weight: bold">Pending</i>&nbsp;&nbsp;
                                                        @endif
                                                    </p>
												</td>
												<td class="text-right">
													
                                                        @if($t->status == 0)
                                                        <a href="{{ url('admin/item/purchase', ['status'=>'approve', 'id'=>$t->id]) }}" class="btn btn-xs btn-primary take-btn" onclick="return confirm('Are you sure about this ?');">Approve</a>&nbsp;&nbsp;
                                                        <a href="{{ url('admin/item/purchase', ['status'=>'cancel','id'=>$t->id]) }}" class="btn btn-xs btn-warning take-btn" onclick="return confirm('Are you sure about this ?');">Cancel</a>&nbsp;&nbsp;
                                                        @endif
                                                        <a href="{{ url('admin/item/purchase', ['status'=>'delete','id' => $t->id ]) }}" class="btn btn-xs btn-danger take-btn" onclick="return confirm('Are you sure you want to do this ?');">Delete</a>
                                                        
												</td>
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
				<div class="row">
					<div class="col-12 col-md-6 col-lg-8 col-xl-8">
						<div class="card">
							<div class="card-header">
								<h4 class="card-title d-inline-block">Recent Users </h4> <a href="patients.html" class="btn btn-primary float-right">View all</a>
							</div>
							<div class="card-block">
								<div class="table-responsive">
									<table class="table mb-0 new-patient-table">
										<tbody>
										
                                            @if(count($users) > 0)
                                             @foreach($users as $user)
											<tr>
												<td>
													<img width="28" height="28" class="rounded-circle" src="{{ url('assets/img/user.jpg') }}" alt=""> 
													<h2>{{ $user->name }}</h2>
												</td>
												<td>{{ $user->email }}</td>
												<td>{{ $user->phone ?? '' }}</td>
												<td>
                                                     @if($user->login)
                                                        <button class="btn btn-success btn-primary-four float-right">Logged In</button>
                                                     @else 
                                                        <button class="btn btn-danger btn-primary-four float-right">Logged In</button>
                                                     @endif
                                                </td>
											</tr>
                                            @endforeach
                                            @endif


										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					  <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                        <div class="card member-panel">
							<div class="card-header bg-white">
								<h4 class="card-title mb-0">Sub-Admins</h4>
							</div>
                            <div class="card-body">
                                <ul class="contact-list">
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">John Doe</span>
                                                <span class="contact-date">MBBS, MD</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Richard Miles</span>
                                                <span class="contact-date">MD</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">John Doe</span>
                                                <span class="contact-date">BMBS</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status online"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Richard Miles</span>
                                                <span class="contact-date">MS, MD</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="John Doe"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status offline"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">John Doe</span>
                                                <span class="contact-date">MBBS</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="contact-cont">
                                            <div class="float-left user-img m-r-10">
                                                <a href="profile.html" title="Richard Miles"><img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle"><span class="status away"></span></a>
                                            </div>
                                            <div class="contact-info">
                                                <span class="contact-name text-ellipsis">Richard Miles</span>
                                                <span class="contact-date">MBBS, MD</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="card-footer text-center bg-white">
                                <a href="doctors.html" class="text-muted">View all Doctors</a>
                            </div>
                        </div>
                    </div>
				</div>
            </div>
           @include('inc.section.messages')
        </div>

@include('inc.dashboard.footer')