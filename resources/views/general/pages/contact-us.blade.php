@include('general.inc.header')
      <section id="shopify-section-template--18127200714987__main" class="shopify-section section"><link href="../cdn/shop/t/62/assets/section-main-page-v=848677459125201531719351850.css" rel="stylesheet" type="text/css" media="all" />
<style data-shopify>.section-template--18127200714987__main-padding {
    padding-top: 27px;
    padding-bottom: 0px;
  }

  @media screen and (min-width: 750px) {
    .section-template--18127200714987__main-padding {
      padding-top: 36px;
      padding-bottom: 0px;
    }
  }</style><div class="page-width page-width--narrow section-template--18127200714987__main-padding">
  <h1 class="main-page-title page-title h0 scroll-trigger animate--fade-in">
    Contact Us
  </h1>
  <div class="rte scroll-trigger animate--slide-in">
    
  </div>
</div>


</section><section id="shopify-section-template--18127200714987__form" class="shopify-section section"><link href="../cdn/shop/t/62/assets/section-contact-form-v=124756058432495035521719351850.css" rel="stylesheet" type="text/css" media="all" />
<style data-shopify>.section-template--18127200714987__form-padding {
    padding-top: 0px;
    padding-bottom: 45px;
  }

  @media screen and (min-width: 750px) {
    .section-template--18127200714987__form-padding {
      padding-top: 0px;
      padding-bottom: 60px;
    }
  }</style><div class="color-scheme-1 gradient">
  <div class="contact page-width page-width--narrow section-template--18127200714987__form-padding"><h2 class="visually-hidden">Contact form</h2><form method="post" action="/contact#ContactForm" id="ContactForm" accept-charset="UTF-8" class="isolate scroll-trigger animate--slide-in"><input type="hidden" name="form_type" value="contact" /><input type="hidden" name="utf8" value="✓" /><div class="contact__fields">
        <div class="field">
          <input
            class="field__input"
            autocomplete="name"
            type="text"
            id="ContactForm-name"
            name="contact[Name]"
            value=""
            placeholder="Name"
          >
          <label class="field__label" for="ContactForm-name">Name</label>
        </div>
        <div class="field field--with-error">
          <input
            autocomplete="email"
            type="email"
            id="ContactForm-email"
            class="field__input"
            name="contact[email]"
            spellcheck="false"
            autocapitalize="off"
            value=""
            aria-required="true"
            
            placeholder="Email"
          >
          <label class="field__label" for="ContactForm-email">Email
            <span aria-hidden="true">*</span></label
          ></div>
      </div>
      <div class="field">
        <input
          type="tel"
          id="ContactForm-phone"
          class="field__input"
          autocomplete="tel"
          name="contact[Phone number]"
          pattern="[0-9\-]*"
          value=""
          placeholder="Phone number"
        >
        <label class="field__label" for="ContactForm-phone">Phone number</label>
      </div>
      <div class="field">
        <textarea
          rows="10"
          id="ContactForm-body"
          class="text-area field__input"
          name="contact[Comment]"
          placeholder="Comment"
        ></textarea>
        <label class="form__label field__label" for="ContactForm-body">Comment</label>
      </div>
      <div class="contact__button">
        <button type="submit" class="button">
          Send
        </button>
      </div></form></div>
</div>


</section>


@include('general.inc.footer')

