<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ session('company') ? session('company')->name : '' }}</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="keyboard, computer, naira, money, goods, products, buying, selling, shopping mall, shopping cart, free selling, free buying, online shopping, shopping, money" />

   @if(Request::is('account') || Request::is('contact') )
      <link href="{{ url('pages/assets/css/account.css') }}" rel="stylesheet">
   @endif

    @if( substr(Request::fullUrl(), 0, 38) == 'https://ecommerce.com/specific/item/view')
    <meta property="og:url"           content="{{ Request::fullUrl() }}" />
    <meta property="og:site_name" content="ojanija.com">
    <meta property="og:type"          content="Website"/>
    <meta property="og:title"         content="{{ $item->name }}, For Sales!!" />
    <meta property="og:description"   content="{{ $item->description ? substr($item->description, 0, 200) : $item->company }}" />
    <meta property="og:image"   itemprop="image"  content="{{ url($item->image1) }}" />
    
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />
 
    <meta name="twitter:card" content="summary">
    <meta name="twitter:card" content="summary_large_image" />
     <meta name="twitter:creator" content="@{{ $item->company }}" />
    <meta name="twitter:site" content="@ojanija.com" />
    <meta name="twitter:label1" content="Written by">
    <meta name="twitter:data1" content="{{ $item->company }}">
    <meta name="twitter:label2" content="Est. reading time">
    <meta name="twitter:data2" content="2 minutes">
    @endif

    @if( substr(Request::fullUrl(), 0, 34) == 'https://ecommerce.com/single_post')
            <meta property="og:url"           content="{{ Request::fullUrl() }}" />
            <meta property="og:site_name" content="ecommerce.com">
            <meta property="og:type"          content="Website"/>
            <meta property="og:title"         content="{{ $content->title }}" />
            <meta property="og:description"   content="{{ $content->message ? substr($content->message, 0, 200) : $content->company }}" />
            <meta property="og:image"   itemprop="image"  content="{{ url($content->image) }}" />
            <meta property="og:image:type" content="image/jpeg">
            <meta property="og:image:width" content="300" />
            <meta property="og:image:height" content="300" />
            
         
            <meta name="twitter:card" content="summary">
            <meta name="twitter:card" content="summary_large_image" />
          <meta name="twitter:creator" content="@{{ $content->company }}" />
          <meta name="twitter:site" content="@ecommerce.com/blog" />
          <meta name="twitter:label1" content="Written by">
           <meta name="twitter:data1" content="{{ $content->company }}">
          <meta name="twitter:label2" content="Est. reading time">
           <meta name="twitter:data2" content="2 minutes">
        @endif
    


     <!-- brought forward from others  -->


    <!-- Font-Awesome CSS -->
    <link href="{{ url('pages/assets/css/font-awesome.min.css') }}" rel="stylesheet">
  
    <link href="{{ url('pages/assets/css/plugins.css') }}" rel="stylesheet">
    <link href="{{ url('pages/assets/css/skin-default.css') }}" rel="stylesheet">

    <!-- Main Style CSS -->
    <link href="{{ url('pages/assets/css/style.css') }}" rel="stylesheet">


    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    

    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="{{ url('pages/general/css/bootstrap.min.css') }}">
    <!-- Owl Carousel main css -->
    <link rel="stylesheet" href="{{ url('pages/general/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('pages/general/css/owl.theme.default.min.css') }}">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="{{ url('pages/general/css/core.css') }}">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="{{ url('pages/general/css/shortcode/shortcodes.css') }}">
    <!-- Theme main style -->
    <link rel="stylesheet" href="{{ url('pages/general/css/style.css') }}">
    <!-- Responsive css -->
    <link rel="stylesheet" href="{{ url('pages/general/css/responsive.css') }}">
    <!-- User style -->
    <link rel="stylesheet" href="{{ url('pages/general/css/custom.css') }}">

     
   

    <style>

            @media (min-width: 320px) {
            .container {  width: 94%; }
            }

            a:hover {
                background-color: 'blue';
            }
            #display_searchable_product > li > a {
                font-size: 16px;
            }
            .bg__white {
                background-color: #fff;
            }
            .main-header-inner .category-toggle-wrap {
                -ms-flex-preferred-size: 350px;
                flex-basis: 350px;
            
            }
            .product-slider-active .col-lg-4,
            .product-slider-active .col-sm-4,
            .product-slider-active .col-md-4,
            .product-slider-active .col-xs-12 {
                width: auto%;
            }

            .product-slider-active.owl-carousel .owl-nav div {
                display: inline;
            }
            .adjustHeight {
                display: flex;
                flex: 1 0 auto;
            }
    </style>
   

    <!-- Modernizr JS -->
    <script src="{{ url('pages/general/js/vendor/modernizr-2.8.3.min.js') }}"></script>

</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->  

    <!-- Body main wrapper start -->
    <div class="wrapper fixed__footer"> 
        <!-- Start Header Style -->
         <header  id="header" class="htc-header header--3 bg__gray" style="height: 100px; margin-bottom: 20px;">
            <!-- Start Mainmenu Area -->
            <div style="margin-top: 0px; margin-bottom: 20px;" id="sticky-header-with-topbar" class="mainmenu__area sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="col-md-2 col-lg-2 col-sm-3 col-xs-3">
                            <div class="logo">
                                <a href="{{ url('/') }}">
                                    <img src="{{ url('images/logo/logo.png') }}" alt="logo">
                                </a>
                            </div>
                        </div>
                        <!-- Start MAinmenu Ares -->
                        <div class="col-md-8 col-lg-8 col-sm-6 col-xs-6" >
                            <nav class="mainmenu__nav hidden-xs hidden-sm">
                                <ul class="main__menu">
                                    <li class="drop"><a href="{{ url('/') }}">Home</a></li>
                                    <li class="drop"><a href="{{ url('about') }}">About</a></li>
                                    <li class="drop"><a href="{{url('blog') }}">Blog</a> </li> 
                                    <li class="drop"><a href="#">Categories</a>
                                        <ul class="dropdown">
                                            
                                           @if( session('categories')  != null )
                                            @php $categories = session('categories');  @endphp     
                                               @foreach($categories as $category)
                                                    <li><a href="{{ url('item/view/catg', ['catg_id'=>$category->id]) }}">{{ $category->name }} <span><i class="zmdi zmdi-chevron-right"></i></span></a>
                                                        @if(count($category->subCategory) > 0)
                                                           <ul class="lavel-dropdown">
                                                              @foreach($category->subCategory as $subCatg)
                                                                  <li><a  href="{{ url('item/view/sub_catg', ['sub_catg_id'=>$subCatg->id]) }}">- {{ $subCatg->name }}</a> </li>
                                                              @endforeach
                                                           </ul>
                                                         @endif
                                                    </li>
                                              @endforeach
                                            @endif
 
                                        </ul>
                                    </li>
                                    <li><a href="{{ url('contact') }}">Contact</a></li>
                                    <li><a href="{{ url('checkout') }}">checkout</a></li>
                                    @if(session()->exists('user'))
                                    <li><a href="{{ url('logout') }}">Logout</a></li>
                                    @else
                                    <li><a href="{{ url('signup') }}">Login</a></li>
                                    @endif
                                </ul>
                            </nav>
                            
                            <div class="mobile-menu clearfix visible-xs visible-sm">
                                <nav id="mobile_dropdown">
                                    <ul>
                                        <li><a href="{{ url('/') }}">Home</a></li>

                                           @if( session('categories')  != null )
                                              @php $categories = session('categories');  @endphp   
                                              <li><a href="#">Product Categories</a>
                                                    <ul>  
                                                       @foreach($categories as $category)
                                                          <li><a href="{{ url('item/view/catg', ['catg_id'=>$category->id]) }}">{{ $category->name }}</a>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @endif
                                      
                                           <li><a href="#">pages</a>
                                            <ul>
                                               
                                                <li><a href="{{ url('cart') }}l">cart</a></li>
                                                <li><a href="{{ url('checkout') }}">checkout</a></li>
                                                <li><a href="{{ url('blog') }}">blog</a></li>

                                                @if(session()->exists('user'))
                                                    <li><a href="{{ url('logout') }}">Logout</a></li>
                                                @else
                                                    <li><a href="{{ url('signup') }}">Login</a></li>
                                                @endif

                                            </ul>
                                        </li>
                                        <li><a href="{{ url('about') }}">about</a></li>
                                        <li><a href="{{ url('contact') }}">contact</a></li>
                                    </ul>


                                </nav>
                            </div>                          
                        </div>
                        <!-- End MAinmenu Ares -->
                        @php
                         $cart = '';
                            if(session('cartSize') != null && session('cartSize') > 0) 
                                $cart = session('cartSize');
                        @endphp
                        <div class="col-md-2 col-sm-4 col-xs-3">  
                            <ul class="menu-extra">
                                <li class="search search__open"><span class="ti-search"></span></li>
                                <li><a href="{{ url('account') }}"><span class="ti-user"></span></a></li>
                                <li class="cart__menu"> <span class="ti-shopping-cart" style=" color : {{ $cart !=  '' ? 'green' : '' }} ; font-weight : {{ $cart !=  '' ? 'bold' : '' }} ">{{ $cart }}</span></li>
                                <li class="toggle__menu hidden-xs hidden-sm"><span class="ti-menu"></span></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Style -->

     

      
        
        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container" >
                    <div class="row" >
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="search__inner ">
                                <form id="form-item-search" action="{{ url('product/search') }}" method="post">
                                    @csrf 
                                    <input name="name" oninput="getProductNames(this.value);" placeholder="Search... " type="text" id="text-input">
                                    <div style="background-color: white; border: 0.5px solid gray; display: none;max-height: 300px; overflow: scroll;" id="display_result">
                                        <ul id="display_searchable_product" style="padding: 10px 0px 10px 20px; text-align: left;"></ul>
                               </div>
                                    <button type="submit"></button>
                                </form>
                              
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon" onclick="document.getElementBy('display_searchable_product').innerHTML = '' "><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->

           
         

            <!-- Start Offset MEnu -->
            <div class="offsetmenu">
                <div class="offsetmenu__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="off__contact">
                        <div class="logo">
                            <a href="{{ url('/') }}">
                                <img src="{{ url('images/logo/logo.png') }}" alt="logo">
                            </a>
                        </div>
                        <p>{!! session('information') ? substr(session('information')->about, 0 , 200)  : '' !!}</p>
                    </div>
                    
                      <div>
                        @if(session('specials'))
                          @php $specials = session('specials'); @endphp
                          @foreach($specials as $s)
                             <a href="{{ url('specific/item', ['status'=>'view','id'=>$s->id ]) }} "><img height="70" width="70" src="{{ url($s->image1) }}" alt="sidebar images" style="margin: 10px 5px; "></a> 
                          @endforeach
                        @endif
                      </div>
                      <br />
                 
                    <div class="offset__sosial__share">
                        <h4 class="offset__title">Follow Us On Social</h4>
                        <ul class="off__soaial__link">
                            <li><a class="bg--twitter" href="#"  title="Twitter"><i class="zmdi zmdi-twitter"></i></a></li>
                            
                            <li><a class="bg--instagram" href="#" title="Instagram"><i class="zmdi zmdi-instagram"></i></a></li>

                            <li><a class="bg--facebook" href="#" title="Facebook"><i class="zmdi zmdi-facebook"></i></a></li>

                            <li><a class="bg--googleplus" href="#" title="Google Plus"><i class="zmdi zmdi-google-plus"></i></a></li>

                            <li><a style="background-color: green" href="#" title="Whatsapp"><i class="zmdi zmdi-whatsapp"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Offset MEnu -->
            <!-- Start Cart Panel -->
            <div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>


                    <div class="shp__cart__wrap">
 
                    @if( session('buyer_session') != null && sizeof(session(session('buyer_session'))) > 0)
                        @php $cart = session(session('buyer_session')); $count = 0; @endphp
                            @foreach($cart as $item_id => $value)
                            <form class="form-horizontal formClass" name="{{'mform'.$count}}"  action="#" method="post"  >
                                <div class="shp__single__product">
                                    <div class="shp__pro__thumb">
                                    <a href="{{ url('specific/item', ['status'=>'view','id'=>$item_id ]) }} "><img width="60" src="{{  url($cart[$item_id]['image'])  }}" alt="{{  $cart[$item_id]['name'] }}"/></a>
                                    </div>
                                    <div class="shp__pro__details">
                                        <h2><a href="{{ url('specific/item', ['status'=>'view','id'=>$item_id ]) }}">{{  $cart[$item_id]['name'] }}</a></h2>
                                        <span class="quantity">QTY: {{  $cart[$item_id]['quantity'] }}</span>
                                        <span class="shp__price">NGN {{  $cart[$item_id]['price'] }}</span>
                                    </div>
                                    <div class="remove__btn">
                                        <a title="Remove this item" href="{{ url('specific/item', ['status'=>'delete','id'=>$item_id ]) }}" onclick="return confirm('Are your sure you want to totally remove this item ?');" class="product-remove" type="submit" name="delete" type="button"><i class="zmdi zmdi-close"></i></a>
                                    </div>
                                </div>
                            </form>
                         @php $count++; @endphp
                       @endforeach
                    @endif  


                    </div>
                    <ul class="shoping__total">
                        <li class="subtotal">Subtotal:</li>
                        <li class="total__price">NGN {{ session('totalCost') != null && session('totalCost') > 0 ? number_format(session('totalCost'),2)  : 0 }}</li>
                    </ul>
                    <ul class="shopping__btn">
                        <li><a href="{{ url('cart') }}">View Cart</a></li>
                        <li class="shp__checkout"><a href="{{ url('checkout') }}">Checkout</a></li>
                    </ul>
                </div>
            </div>
            <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->

