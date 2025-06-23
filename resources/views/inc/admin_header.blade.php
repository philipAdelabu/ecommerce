<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Buy-PC</title>
  <!--  <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <meta name="description" content="Ojanija.. A Nigeria online Free products marketing for sellers and easy shopping for buyers.">
    <meta name="keywords" content="vnaira, buying, selling, shopping mall, shopping cart, free selling, free buying, online shopping, shopping, money" />
    <meta name="author" content="vnaira">
<!--Less styles -->
   <!-- Other Less css file //different less files has different color scheam
	<link rel="stylesheet/less" type="text/css" href="{{ url('general/themes/less/simplex.less') }}">
	<link rel="stylesheet/less" type="text/css" href="{{ url('general/themes/less/classified.less') }}">
	<link rel="stylesheet/less" type="text/css" href="{{ url('general/themes/less/amelia.less') }}">  MOVE DOWN TO activate
	-->
	<!--<link rel="stylesheet/less" type="text/css" href="{{ url('general/themes/less/bootshop.less') }}">
	<script src="{{ url('general/themes/js/less.js') }}" type="text/javascript"></script> -->
	
       <!-- Font-Awesome CSS -->
    <link href="{{ url('pages/assets/css/font-awesome.min.css') }}" rel="stylesheet">

<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="{{ url('general/themes/bootshop/bootstrap.min.css') }}" media="screen"/>
    <link href="{{ url('general/themes/css/base.css') }}" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="{{ url('general/themes/css/bootstrap-responsive.min.css') }}" rel="stylesheet"/>
	<link href="{{ url('general/themes/css/font-awesome.css') }}" rel="stylesheet" type="text/css">
<!-- Google-code-prettify -->	
	<link href="{{ url('general/themes/js/google-code-prettify/prettify.css') }}" rel="stylesheet"/>
	
	 <link href="{{ url('menu/style.css') }}" rel="stylesheet" type="text/css">
  
<!-- fav and touch icons -->
   <!-- <link rel="shortcut icon" href="{{ url('general/themes/images/ico/favicon.ico') }}">  -->
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ url('general/themes/images/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ url('general/themes/images/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ url('general/themes/images/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ url('general/themes/images/ico/apple-touch-icon-57-precomposed.png') }}">
	<style type="text/css" id="enject"></style>
  <script src="{{ url('js/jquery-1.11.1.min.js') }}" type="text/javascript"></script>
<script type="text/javascript" src="{{ url('js/Dynamic_State_LGA.js') }}"></script>
        <!-- data-table CSS  ============================ -->
      <link rel="stylesheet" href="{{ url('data-table/css/data-table/bootstrap-table.css') }}">
    <link rel="stylesheet" href="{{ url('data-table/css/data-table/bootstrap-editable.css') }}">
     
      @yield('editor_header') 

  </head>

  <body>

<div class="container">
<div id="welcomeLine" class="row">
	<div class="span3">
  <a class="nav-brand" href="#"> <img height="60" width="100" src="{{ url('images/logo/logo.png') }}" alt=""/>
        </a>
      
	</div>
	<div class="span9">
	      <!-- Logo -->
   <span class="pull-right">
  
   <strong style="color : brown"> ADMINISTRATOR </strong><b>{{ session('admin')->name }}</b> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <a class="btn btn-mini btn-danger" href="{{ url('admin/logout') }}" >Logout</a>&nbsp;&nbsp;
     </span>
	    
	</div>
</div>
<!-- Navbar ================================================== -->
<!-- Header End====================================================================== -->



 <!-- ##### Header Area Start ##### -->
 <header  class="header-area">
    
<!-- ////////////////////// -->
           
<!-- Navbar ================================================== -->

  <div class="container">
<div id="logoArea" class="navbar">
        <div class="navbar-inner">	
        {{ Form::open(['url'=>'admin/search/content', 'files' => 'true', 'role'=>'form', 'class'=>'form-inline navbar-search']) }}
     {{ csrf_field() }}
		<input required placeholder="search" class="srchTxt" type="text" name="item" />
		  <select name="category" class="srchTxt">
			<option value="all">All</option>
      @if(($categories = session('categories')) != null)
         @foreach($categories as $category)
			         <option value="{{ $category->name }}">{{ $category->name }}</option>
			   @endforeach
      @endif
		</select> 
		  <button type="submit" id="submitButton" class="btn btn-primary">Go</button>
    {{ Form::close() }}
    
</div></div></div>

		<!-- /////////////////////// -->
		<!-- Navbar Area -->
		
        <div style=" border-bottom : 0.4px solid gray;" >
            <div class="classy-nav-container breakpoint-off">
                <div class="container">
			 
                    <!-- Menu -->
                    <nav style="height : 40px;" class="classy-navbar justify-content-between" id="cryptosNav">
					          
                        <!-- Logo -->
			
                   <span style="float : left;"></span>
                        <!-- Navbar Toggler -->
                        <div class="classy-navbar-toggler">
                            <span class="navbarToggler"><span></span><span></span><span></span></span>
                        </div>

                        <!-- Menu -->
                        <div class="classy-menu">

                            <!-- close btn -->
                            <div class="classycloseIcon">
                                <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                            </div>

                            <!-- Nav Start -->
                            <div  class="classynav">
                                <ul>
								        <li class=""> <a href="{{ url('adminDashboard') }}">Home</a></li>
	                                    
                                  
                                    <li><a href="#">Products</a>
                                        <ul class="dropdown">
               <li><a href="{{ url('add_category') }}">Add Category Items</a></li>
               <li><a href="{{ url('view_category') }}">Edit Category</a></li>
                <li><a href="{{ url('admin_add_product') }}">Add Item</a></li>
              <!--  <li><a href="{{ url('admin_view_item') }}">Admin Items</a></li>  -->
                <li class="divider"></li>
         
                <li><a href="#">Manage All Items</a>
                <ul class="dropdown">
                <li><a href="{{ url('view_all_item') }}">View All Items</a></li>
                <li><a href="{{ url('admin/add/banner') }}">Add Banner</a></li>
                <li><a href="{{ url('admin/add/featured') }}">Add Featured</a></li>
                <li><a href="{{ url('admin_delete_BannerAd') }}">Remove Banner </a></li>
                <li><a href="{{ url('admin/delete/Featured') }}">Remove Featured</a></li>
               <!-- <li><a href="{{ url('admin/add/special') }}">Add Special</a></li>
               <li><a href="{{ url('admin/delete/Banner') }}">Remove Banner </a></li> -->
               <!-- <li><a href="{{ url('admin/delete/Special') }}">Remove Special </a></li> -->
                <li><a href="{{ url('admin/add/marquee') }}">Scrolling Text</a></li>
                </ul></li>
          
                                  </ul>
                                </li> 
                                <!--
                                <li><a href="#">Seller</a>
                                    <ul class="dropdown">
                                     <li><a href="{{ url('admin_add_seller') }}">Create Seller</a></li>
                                     <li><a href="{{ url('admin/manage/supplier') }}">Manage Seller</a></li>
                                     <li class="divider"></li>
                                     <li class="nav-header">Nav header</li>
                                     <li><a href="{{ url('admin/view/supplier/items') }}">Seller Items</a></li>
                                    </ul>
                                </li> 
                              -->

                 @if(session()->exists('admin_id') && session('admin_id') == 1)
                 <li><a href="#">Admin</a>
                  <ul class="dropdown">
                <li><a href="{{ url('admin_add_admin') }}">Create Admin</a></li>
                <li><a href="{{ url('admin/manage/admin') }}">Manage Admin</a></li>
                <li class="divider"></li>
                <li class="nav-header">Nav header</li>
                <li><a href="{{ url('admin/view/admin/sellers') }}">Admin's Sellers</a></li>
                <li><a href="{{ url('admin/view/sub_admin/items') }}">Sub-Admin Item</a></li>
              </ul>
            </li>
            @endif


                                    <li><a href="#">Buyers</a>
                                        <ul class="dropdown">
                                        <li><a href="{{ url('users') }}">Users</a></li>
                                        <li><a href="{{ url('buyers') }}">Buyers</a></li>
                                         <li><a href="{{ url('admin/view/purchase/item') }}">Purchase Items</a></li>
                                        </ul>
                                    </li> 
                                    
                                    <li>
                                        <a href="#">News Post</a>
                                        <ul class="dropdown">
                                        <li><a href="{{ url('admin_add_news') }}">Add News</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Manage News</a>
                                        <ul class="dropdown">
                                        <li><a href="{{ url('admin_view_news') }}">Manage News</a></li>
                                        </ul></li>
                                         </ul>
                                </li> 
                                    <li><a href="#">Setting</a>
                                        <ul class="dropdown">
                                        <li><a href="{{ url('admin/update/information') }}">Company Detail</a></li>
                                        <li><a href="{{ url('admin/update/about') }}">Update About Us</a></li>
                                        <li><a href="{{ url('admin/update/shipping') }}">Shipping Policy</a></li>
                                        <li><a href="{{ url('admin/update/terms') }}">Update T&C</a></li>
                                        <li><a href="{{ url('admin/password/reset') }}">Password Reset</a></li>
                                        </ul>
                                    </li> 
                                 
                                
                                <li class=""><a href="{{ url('admin/logout') }}" >Logout</a></li>
                                </ul>

                                <!-- Newsletter Form -->
                               

							</div>
							

                            <!-- Nav End -->
                        </div>
                    </nav>
                  
                </div>
            </div>
        </div>
        
    </header>
    <!-- ##### Header Area End ##### -->


  <hr class="soften">
 