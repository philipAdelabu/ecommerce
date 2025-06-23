@include('general.inc.header')

      <section id="shopify-section-template--18127200846059__main" class="shopify-section section">
      


<style>
  .template-search__header {
    margin-bottom: 3rem;
  }

  .template-search__search {
    margin: 0 auto 3.5rem;
    max-width: 74.1rem;
  }

  .template-search__search .search {
    margin-top: 3rem;
  }

  .template-search--empty {
    padding-bottom: 18rem;
  }

  @media screen and (min-width: 750px) {
    .template-search__header {
      margin-bottom: 5rem;
    }
  }

  .search__button .icon {
    height: 1.8rem;
  }
</style><style data-shopify>.section-template--18127200846059__main-padding {
    padding-top: 45px;
    padding-bottom: 45px;
  }

  @media screen and (min-width: 750px) {
    .section-template--18127200846059__main-padding {
      padding-top: 60px;
      padding-bottom: 60px;
    }
  }</style>
  <div class="template-search template-search--empty section-template--18127200846059__main-padding">
    <div class="template-search__header page-width scroll-trigger animate--fade-in">
      <h1 class="h2 center">Search</h1>
      <div class="template-search__search"><predictive-search data-loading-text="Loading..."><main-search>
          <form action="{{ url('search') }}" method="post" role="search" class="search">
               @csrf() 
            <div class="field">
              <input
                class="search__input field__input"
                id="Search-In-Template"
                type="search"
                name="q"
             
                placeholder="Search"role="combobox"
                  aria-expanded="false"
                  aria-owns="predictive-search-results"
                  aria-controls="predictive-search-results"
                  aria-haspopup="listbox"
                  aria-autocomplete="list"
                  autocorrect="off"
                  autocomplete="off"
                  autocapitalize="off"
                  spellcheck="false">
              <label class="field__label" for="Search-In-Template">Search</label>
              <input name="options[prefix]" type="hidden" value="last"><div class="predictive-search predictive-search--search-template" tabindex="-1" data-predictive-search>

<div class="predictive-search__loading-state">
  <svg
    aria-hidden="true"
    focusable="false"
    class="spinner"
    viewBox="0 0 66 66"
    xmlns="http://www.w3.org/2000/svg"
  >
    <circle class="path" fill="none" stroke-width="6" cx="33" cy="33" r="30"></circle>
  </svg>
</div>
</div>

                <span class="predictive-search-status visually-hidden" role="status" aria-hidden="true"></span><button
                type="reset"
                class="reset__button field__button hidden"
                aria-label="Clear search term"
              >
                <svg class="icon icon-close" aria-hidden="true" focusable="false">
                  <use xlink:href="#icon-reset">
                </svg>
              </button>
              <button type="submit" class="search__button field__button" aria-label="Search">
                <svg class="icon icon-search" aria-hidden="true" focusable="false">
                  <use xlink:href="#icon-search">
                </svg>
              </button>
            </div>
          </form>
        </main-search></predictive-search></div></div></div>


</section>
<main>
@include('general.inc.footer')