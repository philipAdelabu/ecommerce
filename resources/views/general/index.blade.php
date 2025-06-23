
@include('general.inc.header')
   
 <main id="MainContent" class="content-for-layout focus-none" role="main" tabindex="-1">
 <section id="shopify-section-template--18127200649451__slideshow" class="shopify-section section">
 <link href="{{ url('cdn/shop/t/62/assets/component-rating-v=179577762467860590411719351849.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{ url('cdn/shop/t/62/assets/component-volume-pricing-v=111870094811454961941719351849.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{ url('cdn/shop/t/62/assets/component-price-v=70172745017360139101719351849.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{ url('cdn/shop/t/62/assets/quick-order-list-v=135599196971493151141719351850.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{ url('cdn/shop/t/62/assets/quantity-popover-v=78745769908715669131719351850.css') }}" rel="stylesheet" type="text/css" media="all" />

 
 <slideshow-component
   class="slider-mobile-gutter mobile-text-below"
   role="region"
   aria-roledescription="Carousel"
   aria-label="Slideshow about our brand"
 ><div
     class="slideshow banner banner--medium grid grid--1-col slider slider--everywhere banner--mobile-bottom slideshow--placeholder scroll-trigger animate--fade-in"
     id="Slider-template--18127200649451__slideshow"
     aria-live="polite"
     aria-atomic="true"
     data-autoplay="false"
     data-speed="5"
   ></div></slideshow-component>
 </section><section id="shopify-section-template--18127200649451__featured-collection-0" class="shopify-section section">
 
 <style data-shopify>.section-template--18127200649451__featured-collection-0-padding {
     padding-top: 45px;  

   @media screen and (min-width: 750px) {
     .section-template--18127200649451__featured-collection-0-padding {
       padding-top: 60px;
       padding-bottom: 60px;
     }
   }</style><div
   class="color-scheme-1 isolate gradient"
 >
   <div
     class="collection section-template--18127200649451__featured-collection-0-padding"
     id="collection-template--18127200649451__featured-collection-0"
     data-id="template--18127200649451__featured-collection-0">



 <div class="collection__title title-wrapper title-wrapper--no-top-margin page-width"><h2 class="title inline-richtext h2 scroll-trigger animate--slide-in">
       Trending Products
     </h2></div>

 <slider-component class="slider-mobile-gutter page-width page-width-desktop scroll-trigger animate--slide-in">
   <ul
     id="Slider-template--18127200649451__featured-collection-0"
     data-id="template--18127200649451__featured-collection-0"
     class="grid product-grid contains-card contains-card--product grid--5-col-desktop grid--2-col-tablet-down"
     role="list"
     aria-label="Slider"
   >
      
   <!-- item --->   


   @if(count($items) > 0)
      @php $i = 0;  @endphp 
    @foreach($items as $item)
       @if($item->category == 'LAPTOP' && $item->sub_category !== 'Apple')  
       @php if(++$i == 11) break; @endphp
          
          <li id="Slide-template--18127200649451__featured-collection-0-1"
                  class="grid__item scroll-trigger animate--slide-in" data-cascade
                    style="--animation-order: 1;">
                
          <div class="card-wrapper product-card-wrapper underline-links-hover">
          <div class="card card--card card--media color-scheme-2 gradient" style="--ratio-percent: 125.0%;">
            <div
              class="card__inner  ratio"
              style="--ratio-percent: 125.0%;"
            ><div class="card__media">
                  <div class="media media--transparent media--hover-effect">
                    
                    <img  src="{{ url($item->image1) }}"
                      sizes="(min-width: 1200px) 267px, (min-width: 990px) calc((100vw - 130px) / 4), (min-width: 750px) calc((100vw - 120px) / 3), calc((100vw - 35px) / 2)"
                      alt="{{ $item->name }}"  class="motion-reduce"
                        loading="lazy"   width="3024" height="4032" >
                    
                   @if($item->image2) <img
                        src="{{  url($item->image2)  }}"
                        sizes="(min-width: 1200px) 267px, (min-width: 990px) calc((100vw - 130px) / 4), (min-width: 750px) calc((100vw - 120px) / 3), calc((100vw - 35px) / 2)"
                        alt="{{ $item->name }}"
                        class="motion-reduce"
                        loading="lazy"
                        width="3024"
                        height="4032"
                      > @endif</div>
                </div>
                
                
                
            
                <div class="card__content">
                <div class="card__information">
                  <h3
                    class="card__heading"
                    
                  >
                    <a
                      href="{{ url('products/view', ['id'=>$item->id]) }}"
                      id="StandardCardNoMediaLink-template--18127200649451__featured-collection-0-8010360422635"
                      class="full-unstyled-link"
                      aria-labelledby="StandardCardNoMediaLink-template--18127200649451__featured-collection-0-8010360422635 NoMediaStandardBadge-template--18127200649451__featured-collection-0-8010360422635"
                    >
                      {{ $item->name }}
                    </a>
                  </h3>
                </div>
                <div class="card__badge top left"><span
                      id="NoMediaStandardBadge-template--18127200649451__featured-collection-0-8010360422635"
                      class="badge badge--bottom-left color-scheme-5"
                    >Sale</span></div>
              </div>
            </div>
            <div class="card__content">
              <div class="card__information">
                <h3
                  class="card__heading h5"
                  
                    id="title-template--18127200649451__featured-collection-0-8010360422635"
                  
                >
                  <a
                    href="{{ url('products/view', ['id'=>$item->id]) }}"
                    id="CardLink-template--18127200649451__featured-collection-0-8010360422635"
                    class="full-unstyled-link"
                    aria-labelledby="CardLink-template--18127200649451__featured-collection-0-8010360422635 Badge-template--18127200649451__featured-collection-0-8010360422635"
                  >
                   {{ $item->name }}
                  </a>
                </h3>
                <div class="card-information"><span class="caption-large light"></span>
                    <div
                      class="rating"
                      role="img"
                      aria-label="5.0 out of 5.0 stars"
                    >
                      <span
                        aria-hidden="true"
                        class="rating-star"
                        style="--rating: 5; --rating-max: 5.0; --rating-decimal: 0;"
                      ></span>
                    </div>
                    <p class="rating-text caption">
                      <span aria-hidden="true">5.0 /
                        5.0</span>
                    </p>
                    <p class="rating-count caption">
                      <span aria-hidden="true">(3)</span>
                      <span class="visually-hidden">3
                        total reviews</span>
                    </p>
          <div
          class="
          price  price--on-sale"
          >
          <div class="price__container"><div class="price__regular"><span class="visually-hidden visually-hidden--inline">Regular price</span>
              <span class="price-item price-item--regular">
              ₦{{ number_format($item->new_price, 2) }}
              </span></div>
          <div class="price__sale">
              <span class="visually-hidden visually-hidden--inline">Regular price</span>
              <span>
                <s class="price-item price-item--regular">
               @if($item->old_price)   
                  ₦{{ number_format($item->old_price, 2) }}
                @endif  
                </s>
              </span><span class="visually-hidden visually-hidden--inline">Sale price</span>
            <span class="price-item price-item--sale price-item--last">
              ₦{{ number_format($item->new_price, 2) }}
            </span>
          </div>
          <small class="unit-price caption hidden">
            <span class="visually-hidden">Unit price</span>
            <span class="price-item price-item--last">
              <span></span>
              <span aria-hidden="true">/</span>
              <span class="visually-hidden">&nbsp;per&nbsp;</span>
              <span>
              </span>
            </span>
          </small>
          </div></div>

          </div>
              </div>
              
              <div class="card__badge top left"><span
                    id="Badge-template--18127200649451__featured-collection-0-8010360422635"
                    class="badge badge--bottom-left color-scheme-5"
                  >Sale</span></div>
            </div>
          </div>
          </div>
       </li>
          
         @endif
       @endforeach 
      @endif
      <!-- End of item --> 
       
      

      </ul></slider-component><div class="center collection__view-all scroll-trigger animate--slide-in">
     <a
       href="{{ url('collections/best-selling') }}"
       class="link underlined-link"
       aria-label="View all products in the Best selling products collection"
     >
       View all
     </a>
   </div></div>
</div>


</section><section id="shopify-section-template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41" class="shopify-section section">

<style data-shopify>.section-template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41-padding {
 padding-top: 27px;
 padding-bottom: 27px;
}

@media screen and (min-width: 750px) {
 .section-template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41-padding {
   padding-top: 36px;
   padding-bottom: 36px;
 }
}</style><div
class="color-scheme-3 isolate gradient"
>
<div
 class="collection section-template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41-padding"
 id="collection-template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41"
 data-id="template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41"
>
 <div class="collection__title title-wrapper title-wrapper--no-top-margin page-width"><h2 class="title inline-richtext h1 scroll-trigger animate--slide-in">
       Apple Computers
     </h2></div>

 <slider-component class="slider-mobile-gutter page-width page-width-desktop scroll-trigger animate--slide-in">
   <ul
     id="Slider-template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41"
     data-id="template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41"
     class="grid product-grid contains-card contains-card--product grid--4-col-desktop grid--2-col-tablet-down"
     role="list"
     aria-label="Slider"
   >


   <!-- Start of Apple Computer -->  
   @if(count($items) > 0)
     @php $i = 0; @endphp
    @foreach($items as $item)
       @if($item->category == 'LAPTOP' && $item->sub_category == 'Apple') 
       @php if(++$i == 5) break; @endphp 
     <li
         id="Slide-template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41-1"
         class="grid__item scroll-trigger animate--slide-in" data-cascade
           style="--animation-order: 1;">
         

<div class="card-wrapper product-card-wrapper underline-links-hover">
 <div
   class="
     card card--card
      card--media
      color-scheme-2 gradient"
   style="--ratio-percent: 125.0%;"
 >
   <div
     class="card__inner  ratio"
     style="--ratio-percent: 125.0%;"
   ><div class="card__media">
         <div class="media media--transparent media--hover-effect">
           
           <img
         
             src="{{ url($item->image1) }}"
             sizes="(min-width: 1200px) 267px, (min-width: 990px) calc((100vw - 130px) / 4), (min-width: 750px) calc((100vw - 120px) / 3), calc((100vw - 35px) / 2)"
             alt="{{ $item->name }}"
             class="motion-reduce"
             
               loading="lazy"
             
             width="3024"
             height="4032"
           >
           
        @if($item->image2)  <img
           
               src="{{ url($item->image2) }}"
               sizes="(min-width: 1200px) 267px, (min-width: 990px) calc((100vw - 130px) / 4), (min-width: 750px) calc((100vw - 120px) / 3), calc((100vw - 35px) / 2)"
               alt="{{ $item->name }}"
               class="motion-reduce"
               loading="lazy"
               width="3024"
               height="4032"
             > @endif </div>
       </div><div class="card__content">
       <div class="card__information">
         <h3
           class="card__heading"
           
         >
           <a
             href="{{ url('products/view', ['id'=>$item->id]) }}"
             id="StandardCardNoMediaLink-template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41-8514775744747"
             class="full-unstyled-link"
             aria-labelledby="StandardCardNoMediaLink-template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41-8514775744747 NoMediaStandardBadge-template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41-8514775744747"
           >
              {{ $item->name }}
           </a>
         </h3>
       </div>
       <div class="card__badge top left"></div>
     </div>
   </div>
   <div class="card__content">
     <div class="card__information">
       <h3
         class="card__heading h5"
         
           id="title-template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41-8514775744747">
         <a
           href="{{ url('products/view', ['id'=>$item->id]) }}"
           id="CardLink-template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41-8514775744747"
           class="full-unstyled-link"
           aria-labelledby="CardLink-template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41-8514775744747 Badge-template--18127200649451__28179e0b-e8aa-4b19-8dc2-b5ba1207fe41-8514775744747"
         >
          {{ $item->name }}
         </a>
       </h3>
       <div class="card-information"><span class="visually-hidden">Vendor:</span>
           <div class="caption-with-letter-spacing light">{{ $item->sub_category }}</div><span class="caption-large light"></span>
<div
class="
 price "
>
<div class="price__container"><div class="price__regular"><span class="visually-hidden visually-hidden--inline">Regular price</span>
     <span class="price-item price-item--regular">
      @if($item->old_price) ₦{{ number_format($item->old_price, 2) }} @endif
     </span></div>
 <div class="price__sale">
     <span class="visually-hidden visually-hidden--inline">Regular price</span>
     <span>
       <s class="price-item price-item--regular">
         
           
         
       </s>
     </span><span class="visually-hidden visually-hidden--inline">Sale price</span>
   <span class="price-item price-item--sale price-item--last">
     ₦{{  number_format($item->new_price, 2)  }}
   </span>
 </div>
 <small class="unit-price caption hidden">
   <span class="visually-hidden">Unit price</span>
   <span class="price-item price-item--last">
     <span></span>
     <span aria-hidden="true">/</span>
     <span class="visually-hidden">&nbsp;per&nbsp;</span>
     <span>
     </span>
   </span>
 </small>
</div></div>

</div>
     </div>
     
     
     <div class="card__badge top left"></div>
   </div>
 </div>
</div>
       </li>
        @endif
    @endforeach 
  @endif
      
       <!-- End of Apple Computer -->
          
      </ul></slider-component></div>
</div>
</section>



<section id="shopify-section-template--18127200649451__331227b5-4d73-4a1a-9e65-edf6d86ed845" class="shopify-section section"><link href="cdn/shop/t/62/assets/section-rich-text-v=155250126305810049721719351850.css" rel="stylesheet" type="text/css" media="all" />
<style data-shopify>.section-template--18127200649451__331227b5-4d73-4a1a-9e65-edf6d86ed845-padding {
 padding-top: 9px;
 padding-bottom: 9px;
}

@media screen and (min-width: 750px) {
 .section-template--18127200649451__331227b5-4d73-4a1a-9e65-edf6d86ed845-padding {
   padding-top: 12px;
   padding-bottom: 12px;
 }
}</style><div class="isolate page-width">
<div class="rich-text content-container color-scheme-1 gradient section-template--18127200649451__331227b5-4d73-4a1a-9e65-edf6d86ed845-padding">
 <div class="rich-text__wrapper rich-text__wrapper--left">
   <div class="rich-text__blocks left"><h2
             class="rich-text__heading rte inline-richtext h1 scroll-trigger animate--slide-in"
             
             
               data-cascade
               style="--animation-order: 1;"
             
           >
             Phones & Tablets
           </h2></div>
 </div>
</div>
</div>


</section><section id="shopify-section-template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845" class="shopify-section section">


<style data-shopify>.section-template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845-padding {
 padding-top: 27px;
 padding-bottom: 27px;
}

@media screen and (min-width: 750px) {
 .section-template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845-padding {
   padding-top: 36px;
   padding-bottom: 36px;
 }
}</style><div
class="color-scheme-1 isolate gradient"
>
<div
 class="collection section-template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845-padding"
 id="collection-template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845"
 data-id="template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845"
>
 <div class="collection__title title-wrapper title-wrapper--no-top-margin page-width"></div>

 <slider-component class="slider-mobile-gutter page-width page-width-desktop scroll-trigger animate--slide-in">


   <ul
     id="Slider-template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845"
     data-id="template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845"
     class="grid product-grid contains-card contains-card--product grid--4-col-desktop grid--2-col-tablet-down"
     role="list"
     aria-label="Slider"
   >
    
   
   <!-- Start of Phone and Tables -->
   @if(count($items) > 0)
     @php $i = 0 ; @endphp
    @foreach($items as $item)
       @if($item->category == 'PHONES & TABLETS')  
       @php if(++$i == 5) break; @endphp 
<li
         id="Slide-template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845-1"
         class="grid__item scroll-trigger animate--slide-in"
         
           data-cascade
           style="--animation-order: 1;"
         
       >
         

<div class="card-wrapper product-card-wrapper underline-links-hover">
 <div
   class="
     card card--card
      card--media
      color-scheme-2 gradient "
   style="--ratio-percent: 100%;"
 >
   <div
     class="card__inner  ratio"
     style="--ratio-percent: 100%;"
   ><div class="card__media">
         <div class="media media--transparent media--hover-effect">
           
           <img
        
             src="{{ url($item->image1) }}"
             sizes="(min-width: 1200px) 267px, (min-width: 990px) calc((100vw - 130px) / 4), (min-width: 750px) calc((100vw - 120px) / 3), calc((100vw - 35px) / 2)"
             alt="{{ $item->name }}"
             class="motion-reduce" loading="lazy" width="3024" height="4032">
           
</div>
       </div><div class="card__content">
       <div class="card__information">
         <h3
           class="card__heading"
           
         >
           <a
             href="{{ url('products/view', ['id'=>$item->id]) }}"
             id="StandardCardNoMediaLink-template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845-8649086173419"
             class="full-unstyled-link"
             aria-labelledby="StandardCardNoMediaLink-template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845-8649086173419 NoMediaStandardBadge-template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845-8649086173419"
           >
            {{ $item->name }}
           </a>
         </h3>
       </div>
       <div class="card__badge top left"></div>
     </div>
   </div>
   <div class="card__content">
     <div class="card__information">
       <h3
         class="card__heading h5"
         
           id="title-template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845-8649086173419"
         
       >
         <a
           href="{{ url('products/view', ['id'=>$item->id]) }}"
           id="CardLink-template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845-8649086173419"
           class="full-unstyled-link"
           aria-labelledby="CardLink-template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845-8649086173419 Badge-template--18127200649451__5e3bf2d9-37ea-4103-830b-6a7bd2587845-8649086173419"
         >
          {{ $item->name }}
         </a>
       </h3>
       <div class="card-information"><span class="caption-large light"></span>
<div
class="
 price "
>
<div class="price__container"><div class="price__regular"><span class="visually-hidden visually-hidden--inline">Regular price</span>
     <span class="price-item price-item--regular">
      @if($item->old_price) ₦{{ number_format($item->old_price, 2) }} @else ₦{{ number_format($item->new_price, 2) }} @endif
     </span></div>
 <div class="price__sale">
     <span class="visually-hidden visually-hidden--inline">Regular price</span>
     <span>
       <s class="price-item price-item--regular"></s>
     </span><span class="visually-hidden visually-hidden--inline">Sale price</span>
   <span class="price-item price-item--sale price-item--last">
     ₦{{ number_format($item->new_price, 2) }}
   </span>
 </div>
 <small class="unit-price caption hidden">
   <span class="visually-hidden">Unit price</span>
   <span class="price-item price-item--last">
     <span></span>
     <span aria-hidden="true">/</span>
     <span class="visually-hidden">&nbsp;per&nbsp;</span>
     <span>
     </span>
   </span>
 </small>
</div></div>

</div>
     </div>
     
     
     <div class="card__badge top left"></div>
   </div>
 </div>
</div>
       </li>
          @endif
        @endforeach 
      @endif

       <!-- End of Phone and Tables -->
      
      </ul></slider-component></div>
</div>


</section><section id="shopify-section-template--18127200649451__featured_collection_KKgFFa" class="shopify-section section"><link href="cdn/shop/t/62/assets/component-card-v=120341546515895839841719351849.css" rel="stylesheet" type="text/css" media="all" />

<style data-shopify>.section-template--18127200649451__featured_collection_KKgFFa-padding {
 padding-top: 27px;
 padding-bottom: 27px;
}

@media screen and (min-width: 750px) {
 .section-template--18127200649451__featured_collection_KKgFFa-padding {
   padding-top: 36px;
   padding-bottom: 36px;
 }
}</style><div class="color-scheme-1 isolate gradient">
<div class="collection section-template--18127200649451__featured_collection_KKgFFa-padding"
 id="collection-template--18127200649451__featured_collection_KKgFFa" data-id="template--18127200649451__featured_collection_KKgFFa">
 <div class="collection__title title-wrapper title-wrapper--no-top-margin page-width"><h2 class="title inline-richtext h1 scroll-trigger animate--slide-in">
       Accessories
     </h2></div>

 <slider-component class="slider-mobile-gutter page-width page-width-desktop scroll-trigger animate--slide-in">
   <ul
     id="Slider-template--18127200649451__featured_collection_KKgFFa"
     data-id="template--18127200649451__featured_collection_KKgFFa"
     class="grid product-grid contains-card contains-card--product grid--4-col-desktop grid--2-col-tablet-down"
     role="list"
     aria-label="Slider"
   >
    

 <!-- Start of Accessories --> 
 @if(count($items) > 0)
    @php $i = 0; @endphp
    @foreach($items as $item)
       @if($item->category == 'ACCESSORIES') 
       @php if(++$i == 5) break; @endphp 

      <li id="Slide-template--18127200649451__featured_collection_KKgFFa-1"
         class="grid__item scroll-trigger animate--slide-in"
         data-cascade  style="--animation-order: 1;">
         


<div class="card-wrapper product-card-wrapper underline-links-hover">
 <div
   class="card card--card card--media color-scheme-2 gradient" style="--ratio-percent: 125.0%;">
   <div class="card__inner  ratio"
     style="--ratio-percent: 125.0%;">
       <div class="card__media">
         <div class="media media--transparent media--hover-effect">
           
           <img
             src="{{ url($item->image1) }}"
             sizes="(min-width: 1200px) 267px, (min-width: 990px) calc((100vw - 130px) / 4), (min-width: 750px) calc((100vw - 120px) / 3), calc((100vw - 35px) / 2)"
             alt="{{ $item->name }}"
             class="motion-reduce" loading="lazy"
             width="1290" height="1716">
           
</div>
       </div><div class="card__content">
       <div class="card__information">
         <h3 class="card__heading">
           <a
             href="{{ url('products/view', ['id'=>$item->id]) }}"
             id="StandardCardNoMediaLink-template--18127200649451__featured_collection_KKgFFa-8667404665067"
             class="full-unstyled-link"
             aria-labelledby="StandardCardNoMediaLink-template--18127200649451__featured_collection_KKgFFa-8667404665067 NoMediaStandardBadge-template--18127200649451__featured_collection_KKgFFa-8667404665067"
           >
             {{ $item->name }}
           </a>
         </h3>
       </div>
       <div class="card__badge top left"></div>
     </div>
   </div>
   <div class="card__content">
     <div class="card__information">
       <h3 class="card__heading h5"  id="title-template--18127200649451__featured_collection_KKgFFa-8667404665067">
         <a
           href="{{ url('products/view', ['id'=>$item->id]) }}"
           id="CardLink-template--18127200649451__featured_collection_KKgFFa-8667404665067"
           class="full-unstyled-link"
           aria-labelledby="CardLink-template--18127200649451__featured_collection_KKgFFa-8667404665067 Badge-template--18127200649451__featured_collection_KKgFFa-8667404665067"
         >
           {{ $item->name  }}
         </a>
       </h3>
       <div class="card-information"><span class="caption-large light"></span>
<div
class="
 price "
>
<div class="price__container"><div class="price__regular"><span class="visually-hidden visually-hidden--inline">Regular price</span>
     <span class="price-item price-item--regular">
       @if($item->old_price) ₦{{ number_format($item->old_price, 2) }} @endif
     </span></div>
 <div class="price__sale">
     <span class="visually-hidden visually-hidden--inline">Regular price</span>
     <span>
       <s class="price-item price-item--regular"></s>
     </span><span class="visually-hidden visually-hidden--inline">Sale price</span>
   <span class="price-item price-item--sale price-item--last">
     ₦{{ number_format($item->new_price, 2) }}
   </span>
 </div>
 <small class="unit-price caption hidden">
   <span class="visually-hidden">Unit price</span>
   <span class="price-item price-item--last">
     <span></span>
     <span aria-hidden="true">/</span>
     <span class="visually-hidden">&nbsp;per&nbsp;</span>
     <span>
     </span>
   </span>
 </small>
</div></div>

</div>
     </div>
     
     
     <div class="card__badge top left"></div>
   </div>
 </div>
</div>
       </li>
       @endif
    @endforeach 
  @endif
    
      <!--  End of Accessories -->  
      </ul></slider-component></div>
</div>


</section><section id="shopify-section-template--18127200649451__featured_collection_AG9HeU" class="shopify-section section">


<style data-shopify>.section-template--18127200649451__featured_collection_AG9HeU-padding {
 padding-top: 27px;
 padding-bottom: 27px;
}

@media screen and (min-width: 750px) {
 .section-template--18127200649451__featured_collection_AG9HeU-padding {
   padding-top: 36px;
   padding-bottom: 36px;
 }
}</style><div
class="color-scheme-1 isolate gradient"
>
<div
 class="collection section-template--18127200649451__featured_collection_AG9HeU-padding"
 id="collection-template--18127200649451__featured_collection_AG9HeU"
 data-id="template--18127200649451__featured_collection_AG9HeU"
>
 <div class="collection__title title-wrapper title-wrapper--no-top-margin page-width"><h2 class="title inline-richtext h1 scroll-trigger animate--slide-in">
       Computer components
     </h2><div class="collection__description body rte scroll-trigger animate--slide-in"><p><meta charset="utf-8"><span>Explore</span> our top-quality computer parts and components at unbeatable prices.</p>
<!---->

     </div></div>

 <slider-component class="slider-mobile-gutter page-width page-width-desktop scroll-trigger animate--slide-in">

 <ul
     id="Slider-template--18127200649451__featured_collection_AG9HeU"
     data-id="template--18127200649451__featured_collection_AG9HeU"
     class="grid product-grid contains-card contains-card--product grid--4-col-desktop grid--2-col-tablet-down"
     role="list"
     aria-label="Slider"
   >



   <!-- start of Computer components -->  

   @if(count($items) > 0)
     @php $i = 0; @endphp
    @foreach($items as $item)
       @if($item->category == 'COMPUTER COMPONENTS') 
          @php if(++$i == 5) break; @endphp 
     
     <li
         id="Slide-template--18127200649451__featured_collection_AG9HeU-1"
         class="grid__item scroll-trigger animate--slide-in"
           data-cascade style="--animation-order: 1;">
         

<div class="card-wrapper product-card-wrapper underline-links-hover">
 <div
   class="card card--card card--media
      color-scheme-2 gradient" style="--ratio-percent: 125.0%;">
   <div
     class="card__inner  ratio"
     style="--ratio-percent: 125.0%;"
   ><div class="card__media">
         <div class="media media--transparent media--hover-effect">
           
           <img
      
             src="{{ url($item->image1) }}"
             sizes="(min-width: 1200px) 267px, (min-width: 990px) calc((100vw - 130px) / 4), (min-width: 750px) calc((100vw - 120px) / 3), calc((100vw - 35px) / 2)"
             alt="{{ $item->name }}"
             class="motion-reduce"loading="lazy"
             width="3024" height="4032">
           
</div>
       </div><div class="card__content">
       <div class="card__information">
         <h3 class="card__heading">
           <a
             href="{{ url('products/view', ['id'=>$item->id]) }}"
             id="StandardCardNoMediaLink-template--18127200649451__featured_collection_AG9HeU-8653720223979"
             class="full-unstyled-link"
             aria-labelledby="StandardCardNoMediaLink-template--18127200649451__featured_collection_AG9HeU-8653720223979 NoMediaStandardBadge-template--18127200649451__featured_collection_AG9HeU-8653720223979"
           >
             {{ $item->name }}
           </a>
         </h3>
       </div>
       <div class="card__badge top left"></div>
     </div>
   </div>
   <div class="card__content">
     <div class="card__information">
       <h3 class="card__heading h5" id="title-template--18127200649451__featured_collection_AG9HeU-8653720223979" >
         <a
           href="{{ url('products/view', ['id'=>$item->id]) }}"
           id="CardLink-template--18127200649451__featured_collection_AG9HeU-8653720223979"
           class="full-unstyled-link"
           aria-labelledby="CardLink-template--18127200649451__featured_collection_AG9HeU-8653720223979 Badge-template--18127200649451__featured_collection_AG9HeU-8653720223979"
         >
           {{ $item->name }}
         </a>
       </h3>
       <div class="card-information"><span class="visually-hidden">Vendor:</span>
           <div class="caption-with-letter-spacing light">{{ $item->sub_category }}</div><span class="caption-large light"></span>
<div
class="
 price "
>
<div class="price__container"><div class="price__regular"><span class="visually-hidden visually-hidden--inline">Regular price</span>
     <span class="price-item price-item--regular">
     @if($item->old-price)  ₦{{ number_format($item->old_price, 2) }} @endif
     </span></div>
 <div class="price__sale">
     <span class="visually-hidden visually-hidden--inline">Regular price</span>
     <span>
       <s class="price-item price-item--regular"></s>
     </span><span class="visually-hidden visually-hidden--inline">Sale price</span>
   <span class="price-item price-item--sale price-item--last">
     ₦{{ number_format($item->new_price, 2) }}
   </span>
 </div>
 <small class="unit-price caption hidden">
   <span class="visually-hidden">Unit price</span>
   <span class="price-item price-item--last">
     <span></span>
     <span aria-hidden="true">/</span>
     <span class="visually-hidden">&nbsp;per&nbsp;</span>
     <span>
     </span>
   </span>
 </small>
</div></div>

</div>
     </div>
     <div class="card__badge top left"></div>
   </div>
 </div>
</div>
       </li>
          @endif
       @endforeach 
    @endif

       <!-- End of Computer components -->
      </ul></slider-component><div class="center collection__view-all scroll-trigger animate--slide-in">
     <a
       href="{{ url('collections/computer-components') }}"
       class="button"
       aria-label="View all products in the Computer components collection"
     >
       View all
     </a>
   </div></div>
</div>


</section><section id="shopify-section-template--18127200649451__fb1e4e53-846c-41cc-b9e2-aa1e632e7b1b" class="shopify-section section">

<style data-shopify>.section-template--18127200649451__fb1e4e53-846c-41cc-b9e2-aa1e632e7b1b-padding {
 padding-top: 30px;
 padding-bottom: 39px;
}

@media screen and (min-width: 750px) {
 .section-template--18127200649451__fb1e4e53-846c-41cc-b9e2-aa1e632e7b1b-padding {
   padding-top: 40px;
   padding-bottom: 52px;
 }
}</style><div class="isolate">
<div class="rich-text content-container color-scheme-1 gradient rich-text--full-width content-container--full-width section-template--18127200649451__fb1e4e53-846c-41cc-b9e2-aa1e632e7b1b-padding">
 <div class="rich-text__wrapper rich-text__wrapper--center page-width">
   <div class="rich-text__blocks center"><h2
             class="rich-text__heading rte inline-richtext h1 scroll-trigger animate--slide-in"
             
             
               data-cascade
               style="--animation-order: 1;"
             
           >
             Why Buy USA Used Laptops?
           </h2><div
             class="rich-text__text rte scroll-trigger animate--slide-in"
             
             
               data-cascade
               style="--animation-order: 2;"
             
           >
             <p>There are many reasons why USA used laptops are preferred to new laptops bought here in Nigeria, it’s not just because of its affordability but also the assurance of getting a laptop made with original and quality materials that are durable. </p><p>The United States set standards that regulate production of products in their country which reduces the chances of producing substandard products. </p><p>Hence, laptops sold in USA are of good quality standard, unlike many fake brands and refurbished laptops packaged as brand new sold in Nigeria. </p><p>Imported fairly used laptops serve almost the same purpose as laptop bought directly from the Original Equipment Manufacturers (OEM). This and many more are reasons why it’s preferable you purchase USA used laptops rather than new laptops sold in  Nigeria.</p>
           </div></div>
 </div>
</div>
</div>


</section><section id="shopify-section-template--18127200649451__5f84946c-f99f-46cf-bedf-b66d839b3ee6" class="shopify-section section">
<link href="{{ url('cdn/shop/t/62/assets/section-multicolumn-v=81420361875458722681719351850.css') }}" rel="stylesheet" type="text/css" media="all" />
<link href="{{ url('cdn/shop/t/62/assets/component-slider-v=14039311878856620671719351849.css') }}" rel="stylesheet" type="text/css" media="all" />
<style data-shopify>.section-template--18127200649451__5f84946c-f99f-46cf-bedf-b66d839b3ee6-padding {
 padding-top: 27px;
 padding-bottom: 27px;
}

@media screen and (min-width: 750px) {
 .section-template--18127200649451__5f84946c-f99f-46cf-bedf-b66d839b3ee6-padding {
   padding-top: 36px;
   padding-bottom: 36px;
 }
}</style><div class="multicolumn color-scheme-1 gradient background-none no-heading">
<div
 class="page-width section-template--18127200649451__5f84946c-f99f-46cf-bedf-b66d839b3ee6-padding isolate scroll-trigger animate--slide-in"
 
   data-cascade
 
><slider-component class="slider-mobile-gutter">
   <ul
     class="multicolumn-list contains-content-container grid grid--1-col-tablet-down grid--3-col-desktop"
     id="Slider-template--18127200649451__5f84946c-f99f-46cf-bedf-b66d839b3ee6"
     role="list"
   ><li
         id="Slide-template--18127200649451__5f84946c-f99f-46cf-bedf-b66d839b3ee6-1"
         class="multicolumn-list__item grid__item scroll-trigger animate--slide-in"
         
         
           data-cascade
           style="--animation-order: 1;"
         
       >
         <div class="multicolumn-card content-container"><div class="multicolumn-card__info"><h3 class="inline-richtext">GREAT VALUE</h3><div class="rte"><p>We offer you quality and clean UK used laptop computers at affordable prices.</p></div></div>
         </div>
       </li><li
         id="Slide-template--18127200649451__5f84946c-f99f-46cf-bedf-b66d839b3ee6-2"
         class="multicolumn-list__item grid__item scroll-trigger animate--slide-in"
         
         
           data-cascade
           style="--animation-order: 2;"
         
       >
         <div class="multicolumn-card content-container"><div class="multicolumn-card__info"><h3 class="inline-richtext">CONFIDENCE</h3><div class="rte"><p>All our products are tested and confirmed ok, with <em>30 days limited warranty.</em></p></div></div>
         </div>
       </li><li
         id="Slide-template--18127200649451__5f84946c-f99f-46cf-bedf-b66d839b3ee6-3"
         class="multicolumn-list__item grid__item scroll-trigger animate--slide-in"
         
         
           data-cascade
           style="--animation-order: 3;"
         
       >
         <div class="multicolumn-card content-container"><div class="multicolumn-card__info"><h3 class="inline-richtext">LAGOS CONTACT</h3><div class="rte"><p>+2347030109292 Buypc89@gmail.com</p><p>Shop J18 and J29 First Floor, Block J, Akorede International Market, Ijesha Bus Stop, Ijesha, Suru Lere, Lagos, Nigeria 101283</p></div></div>
         </div>
       </li>
       </ul></slider-component>
 <div class="center"></div>
</div>
</div>


</section>
 </main>



@include('general.inc.footer')



