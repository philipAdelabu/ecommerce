@extends('layouts.admin')
@section('title')<span style="color : green">User Successfully Created </span>@endsection
@section('content')

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>
                            <div class="col-md-6">
                                <input disabled="true" id="name" type="text" class="form-control" name="name" value="@php echo $detail['name']; @endphp" required autofocus>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="reg_id" class="col-md-4 control-label">Registration Id</label>
                            <div class="col-md-6">
                                <input disabled="true" id="reg_id" type="text" class="form-control" name="reg_id" value=" @php echo $detail['reg_id']; @endphp" required autofocus>
                            </div>
                        </div>
                         <div class="form-group">
                            <label for="status" class="col-md-4 control-label">Status</label>
                            <div class="col-md-6">
                                <input disabled="true" id="status" type="text" class="form-control" name="status" value="@php echo $detail['level']; @endphp" required autofocus>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input disabled="true"  id="email" type="email" class="form-control" name="email" value="@php echo $detail['email']; @endphp" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">Password</label>
                            <div class="col-md-6">
                                <input disabled="true" id="password" value="@php echo $detail['password']; @endphp"  class="form-control" name="password" required>
                            </div>
                        </div>
                       
                        <div class="text-center">
                              <br /><br />
                                <a href="admin_manage_user" class="btn btn-success">OK</a>
                            
                        </div>
                    </form>
                
@endsection