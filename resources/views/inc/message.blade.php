  
  {{-- This is used to display a success message after the project is submitted --}}
  @if(session('success'))
                  <div class="alert alert-success">
                     {{session('success')}}
                  </div>
  @endif

   @if(session('fail'))
                  <div class="alert alert-danger">
                     {{session('fail')}}
                  </div>
    @endif
  
  @if(count($errors) > 0)
   @foreach($errors->all() as $error)
      <div class="alert alert-danger">
        {{$error}}
      </div>
   @endforeach
  @endif