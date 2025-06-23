<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>{{ config('app.name') }}</title>

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <link rel="stylesheet" href=" {{ url('admin/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ url('admin/assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />
    <!-- <link rel="shortcut icon" href="{{ url('logo/') }}">  -->
  </head>
  <body>
  <div  class="container">
      @yield('content')
 
 
      <div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span  style="font-size: 16px; color : brown">{{ config('app.name') }}</span>
							 &copy; @php echo date('Y'); @endphp
						</span>

					</div>
				</div>
			</div>

		</div><!-- /.main-container -->
        
    <!-- jquery
		============================================ -->
    <script src="{{ url('admin/js/vendor/jquery-1.11.3.min.js') }}"></script>
    <!-- bootstrap JS
		============================================ -->
    <script src="{{ url('admin/js/bootstrap.min.js') }}"></script>
    <!-- wow JS
		============================================ -->
    <script src="{{ url('admin/js/wow.min.js') }}"></script>
    <!-- price-slider JS
		============================================ -->
    <script src="{{ url('admin/js/jquery-price-slider.js') }}"></script>
    <!-- meanmenu JS
		============================================ -->
    <script src="{{ url('admin/js/jquery.meanmenu.js') }}"></script>
    <!-- owl.carousel JS
		============================================ -->
    <script src="{{ url('admin/js/owl.carousel.min.js') }}"></script>
   
  
</body>

</html>