@include('general.inc.header')
  
  @include('general.inc.filter')
        
        
        <div
        class="product-grid-container scroll-trigger animate--slide-in"
        id="ProductGridContainer"
        
          data-cascade
        
      ><div
            class="collection page-width"
          >
            <div class="loading-overlay gradient"></div>
            <ul
              id="product-grid"
              data-id="template--18127200616683__product-grid"
              class="
                grid product-grid grid--2-col-tablet-down
                grid--4-col-desktop
                
              "
            >
              
      <!-- Beginning of single display  -->
      @if(count($items) > 0)
         @foreach($items as $item)
            
         <li class="grid__item scroll-trigger animate--slide-in"
                  data-cascade style="--animation-order: 1;">
                  

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
                
                width="3024"
                height="4032"
              >
              
             @if($item->image2)<img  src="{{ url($item->image2) }}"
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
              <a href="{{ url('products/view', ['id'=>$item->id]) }}"
                id="StandardCardNoMediaLink-template--18127200616683__product-grid-8665029476587"
                class="full-unstyled-link"
                aria-labelledby="StandardCardNoMediaLink-template--18127200616683__product-grid-8665029476587 NoMediaStandardBadge-template--18127200616683__product-grid-8665029476587"
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
            
              id="title-template--18127200616683__product-grid-8665029476587"
            
          >
            <a  href="{{ url('products/view', ['id'=>$item->id]) }}"
              id="CardLink-template--18127200616683__product-grid-8665029476587"
              class="full-unstyled-link"
              aria-labelledby="CardLink-template--18127200616683__product-grid-8665029476587 Badge-template--18127200616683__product-grid-8665029476587"
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
         @if($item->old_price) ₦{{ number_format($item->old_price, 2) }}  @endif
        </span></div>
    <div class="price__sale">
        <span class="visually-hidden visually-hidden--inline">Regular price</span>
        <span>
          <s class="price-item price-item--regular">
            
              
            
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
        
        
        <div class="card__badge top left"></div>
      </div>
    </div>
  </div>
                </li>
    @endforeach 
  @endif

   <!-- End of single display --->



 
              
              
              
              </ul>

<link href="{{ url('cdn/shop/t/62/assets/component-pagination-v=136206814810731739951719351849.css') }}" rel="stylesheet" type="text/css" media="all" />
<div class="pagination-wrapper">
    <nav class="pagination" role="navigation" aria-label="Pagination">
      <ul class="pagination__list list-unstyled" role="list">
        
       @if(count($items) > 0 ) {{ $items->links() }} @endif
        
        </ul>
    </nav>
  </div>
</div></div>
    </div></div>


</div>


@include('general.inc.footer')