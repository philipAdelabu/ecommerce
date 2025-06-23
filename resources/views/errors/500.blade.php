@include('general.inc.header')

<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url({{  url('pages/images/bg/error.png')  }})no-repeat scroll center center / cover ;">
            <div class="ht__bradcaump__wrap">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="bradcaump__inner text-center"  style="color: #fff; float: right">
                                <h2 class="bradcaump-title"  style="color: #fff;">500 Error</h2>
                                <nav class="bradcaump-inner">
                                  <a class="breadcrumb-item" style="color: #fff;" href="{{ url('/') }}">Home</a>
                                  <span class="brd-separetor">/</span>
                                  <span style="color: #fff;" class="breadcrumb-item active">We have problem processing your request</span>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- End Bradcaump area -->



@include('general.inc.footer')