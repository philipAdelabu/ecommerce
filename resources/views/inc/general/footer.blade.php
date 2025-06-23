

        <!-- Start Footer Area -->
        <footer class="htc__foooter__area gray-bg">
            <div class="container">
                <div class="row">
                    <div class="footer__container clearfix">


                        

                         <!-- Start Single Footer Widget -->
                         <div class="col-md-3 col-lg-3 col-sm-6">
                            <div class="ft__widget">
                                
                                <div class="footer-address">
                                    <ul>
                                        <li>
                                            <div class="address-icon">
                                                <i class="zmdi zmdi-pin"></i>
                                            </div>
                                            <div class="address-text">
                                                <p>{{ session('company') ? session('company')->address1  : '' }}</p>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="address-icon">
                                                <i class="zmdi zmdi-email"></i>
                                            </div>
                                            <div class="address-text">
                                                <a href="#">{{ session('company') ? session('company')->email  : '' }}</a>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="address-icon">
                                                <i class="zmdi zmdi-phone-in-talk"></i>
                                            </div>
                                            <div class="address-text">
                                                <p> {{ session('company') ? session('company')->phone1  : '' }}</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <ul class="social__icon">
                                    <li><a href="#"><i class="zmdi zmdi-twitter"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-instagram"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-facebook"></i></a></li>
                                    <li><a href="#"><i class="zmdi zmdi-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- End Single Footer Widget -->

                        <div class="col-md-3 col-lg-2 col-sm-6 smt-30 xmt-30">
                            <div class="ft__widget">
                                <h2 class="ft__title">Infomation</h2>
                                <ul class="footer-categories">
                                    <li><a href="{{ url('about') }}">About Us</a></li>
                                    <li><a href="{{ url('contact') }}">Contact Us</a></li>
                                    <li><a href="#">Terms & Conditions</a></li>
                                    <li><a href="#">Returns & Exchanges</a></li>
                                    <li><a href="#">Shipping & Delivery</a></li>
                                    <li><a href="#">Privacy Policy</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Start Single Footer Widget -->
                        <div class="col-md-3 col-lg-3 col-lg-offset-1 col-sm-6 smt-30 xmt-30">
                            <div class="ft__widget">
                                <h2 class="ft__title">Newsletter</h2>
                                <div class="newsletter__form">
                                    <p>Subscribe to our newsletter and get 10% off your first purchase .</p>
                                    <div class="input__box">
                                        <div id="mc_embed_signup">
                                            <form  id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate"  novalidate>
                                                <div id="mc_embed_signup_scroll" class="htc__news__inner">
                                                    <div class="news__input">
                                                        <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="Email Address" required>
                                                    </div>
                                                    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                                                    <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_6bbb9b6f5827bd842d9640c82_05d85f18ef" tabindex="-1" value=""></div>
                                                    <div class="clearfix subscribe__btn"><input type="submit" value="Send" name="subscribe" id="mc-embedded-subscribe" class="bst__btn btn--white__color">
                                                        
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>        
                                </div>
                            </div>
                        </div>
                        <!-- End Single Footer Widget -->

                         <!-- Start Single Footer Widget -->
                         <div class="col-md-3 col-lg-3 col-sm-6">
                            <div class="ft__widget" style="margin-top: 60px;">
                                <div  class="ft__logo text-center">
                                    <a href="{{ url('/') }}">
                                        <img src="{{ url('images/logo/logo.png') }}" alt="footer logo">
                                    </a>
                                </div>  
                            </div>
                        </div>
                        <!-- End Single Footer Widget -->


                    </div>
                </div>
                <!-- Start Copyright Area -->
                <div class="htc__copyright__area">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
                            <div class="copyright__inner">
                                <div class="copyright">
                                    <p>© {{ date('Y') }} <a href="#">{{ session('company') ? session('company')->name  : '' }}</a>
                                    All Right Reserved.</p>
                                </div>
                                <ul class="footer__menu">
                                    <li><a href="{{ url('/') }}">Home</a></li>
                                    <li><a href="{{ url('about') }}">About</a></li>
                                    <li><a href="{{ url('contact') }}">Contact Us</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Copyright Area -->
            </div>
        </footer>
        <!-- End Footer Area -->
    </div>
    <!-- Body main wrapper end -->

    <!-- QUICKVIEW PRODUCT -->
    <div id="quickview-wrapper">
        <!-- Modal -->
        <div class="modal fade" id="productModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal__container" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-product">
                            <!-- Start product images -->
                            <div class="product-images">
                                <div class="main-image images">
                                    <img id="selected_prd_image" alt="big images" src="images/product/big-img/1.jpg">
                                </div>
                            </div>
                            <!-- end product images -->
                            <div class="product-info">
                                <h1 id="selected_prd_name">Simple Fabric Bags</h1>
                                <div class="rating__and__review">
                                    <ul class="rating">
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                        <li><span class="ti-star"></span></li>
                                    </ul>
                                    <div class="review">
                                        <a href="#">4 customer reviews</a>
                                    </div>
                                </div>
                                <div class="price-box-3">
                                    <div class="s-price-box">
                                        <span id="selected_prd_new_price" class="new-price"></span>
                                        <span id="selected_prd_old_price" class="old-price"></span>
                                    </div>
                                </div>
                                <div id="selected_prd_description" class="quick-desc">
                                    Designed for simplicity and made from high quality materials. Its sleek geometry and material combinations creates a modern look.
                                </div>
                             
                            
                                <div class="social-sharing">
                                    <div class="widget widget_socialsharing_widget">
                                        <h3 class="widget-title-modal">Share</h3>
                                        <ul class="social-icons">
                                            <li><a target="_blank" title="rss" href="#" class="rss social-icon"><i class="zmdi zmdi-rss"></i></a></li>
                                            <li><a target="_blank" title="Linkedin" href="#" class="linkedin social-icon"><i class="zmdi zmdi-linkedin"></i></a></li>
                                            <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="zmdi zmdi-pinterest"></i></a></li>
                                            <li><a target="_blank" title="Tumblr" href="#" class="tumblr social-icon"><i class="zmdi zmdi-tumblr"></i></a></li>
                                            <li><a target="_blank"   href="#" title="Whatsapp"><i class="zmdi zmdi-whatsapp"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="addtocart-btn">
                                    <a id="selected_prd_add_to_cart" href="#">Add to cart</a>
                                </div>
                            </div><!-- .product-info -->
                        </div><!-- .modal-product -->
                    </div><!-- .modal-body -->
                </div><!-- .modal-content -->
            </div><!-- .modal-dialog -->
        </div>
        <!-- END Modal -->
    </div>
    <!-- END QUICKVIEW PRODUCT -->
    <!-- Placed js at the end of the document so the pages load faster -->

   

       <!-- jquery latest version -->
       <script src="{{ url('pages/general/js/vendor/jquery-1.12.0.min.js') }}"></script>
    <!-- Bootstrap framework js -->
    <script src="{{ url('pages/general/js/bootstrap.min.js') }}"></script>
    <!-- All js plugins included in this file. -->
    <script src="{{ url('pages/general/js/plugins.js') }}"></script>
    <script src="{{ url('pages/general/js/slick.min.js') }}"></script>
    <script src="{{ url('pages/general/js/owl.carousel.min.js') }}"></script>
    <!-- Waypoints.min.js. -->
    <script src="{{ url('pages/general/js/waypoints.min.js') }}"></script>
    <!-- Main js file that contents all jQuery plugins activation. -->
    <script src="{{ url('pages/general/js/main.js') }}"></script>

    <!-- brought forward from the others  -->

    <!-- Active Js -->
    <script src="{{ url('pages/assets/js/main.js') }}"></script>
    <script src="{{ url('js/self-lib.js') }}"></script>

          <script>
                  function  getProductNames(searchable_name){
                     if(searchable_name !== undefined){
                        ul = document.getElementById('display_searchable_product');
                        var l =  searchable_name.length;
                        if(l < 2) { ul.innerHTML = "";  return };
                     url = "{{ url('find/product/related/') }}";
                     data = {
                      'name' : searchable_name,
                      '_token' : "{{ csrf_token() }}",
                      };
                    $.post(url, data, (result, status)=>{
                    if(status == 'success'){
                       
                        ul.innerHTML = "";
                        document.getElementById('display_result').style.display = 'block';
                        console.log('data >>> ', result);
                        result.map( d => {
                             console.log(d);
                             link_name = "{{ url('getProduct/name') }}/"+d; 
                             a = document.createElement('a');
                             a.appendChild(document.createTextNode(d));
                             a.setAttribute('href', link_name);
                             li = document.createElement('li');
                             li.appendChild(a);
                             ul.appendChild(li);
                           });
                          }
                     }); 
                 }
            }
            </script>

      
   
</body>

</html>