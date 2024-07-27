<?php 
  include_once "inc/config.php";
  include_once "inc/drc.php";

  $pagetitle = "Shop - ";
  include_once "head.php";
  include_once "header.php"
?>

      <section data-anim="fade" class="breadcrumbs d-none">
        <div class="container">
          <div class="row">
            <div class="col-auto">
              <div class="breadcrumbs__content">

                <div class="breadcrumbs__item ">
                  <a href="#">Home</a>
                </div>

                <div class="breadcrumbs__item ">
                  <a href="#">All courses</a>
                </div>

                <div class="breadcrumbs__item ">
                  <a href="#">User Experience Design</a>
                </div>

                <div class="breadcrumbs__item ">
                  <a href="#">User Interface</a>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="page-header -type-1 mt-60">
        <div class="container">
          <div class="page-header__content">
            <div class="row justify-center text-center">
              <div class="col-auto">
                <div data-anim="slide-up delay-1">

                  <h1 class="page-header__title">Shop Order</h1>

                </div>

                <div data-anim="slide-up delay-2">

                  <p class="page-header__text">We’re on a mission to deliver engaging, curated courses at a reasonable price.</p>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="layout-pt-md layout-pb-lg">
        <div class="container">
          <div class="row no-gutters justify-content-center">
            <div class="col-xl-8 col-lg-9 col-md-11">
              <div class="shopCompleted-header">
                <div class="icon">
                  <i data-feather="check"></i>
                </div>
                <h2 class="title">
                  Your order is completed!
                </h2>
                <div class="subtitle">
                  Thank you. Your order has been received.
                </div>
              </div>

              <div class="shopCompleted-info">
                <div class="row no-gutters y-gap-32">
                  <div class="col-md-3 col-sm-6">
                    <div class="shopCompleted-info__item">
                      <div class="subtitle">Order Number</div>
                      <div class="title text-purple-1 mt-5">13119</div>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-6">
                    <div class="shopCompleted-info__item">
                      <div class="subtitle">Date</div>
                      <div class="title text-purple-1 mt-5">27/07/2021</div>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-6">
                    <div class="shopCompleted-info__item">
                      <div class="subtitle">Total</div>
                      <div class="title text-purple-1 mt-5">$40.10</div>
                    </div>
                  </div>

                  <div class="col-md-3 col-sm-6">
                    <div class="shopCompleted-info__item">
                      <div class="subtitle">Payment Method</div>
                      <div class="title text-purple-1 mt-5">Direct Bank Transfer</div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="shopCompleted-footer bg-light-4 border-light rounded-8">
                <div class="shopCompleted-footer__wrap">
                  <h5 class="title">
                    Order details
                  </h5>

                  <div class="item">
                    <span class="fw-500">Product</span>
                    <span class="fw-500">Subtotal</span>
                  </div>

                  <div class="item">
                    <span class="">Hoodie x2</span>
                    <span class="">$59.00</span>
                  </div>

                  <div class="item -border-none">
                    <span class="">Seo Books x 1</span>
                    <span class="">$67.00</span>
                  </div>

                  <div class="item -border-none">
                    <span class="fw-500">Subtotal</span>
                    <span class="fw-500">$178.00</span>
                  </div>

                  <div class="item">
                    <span class="fw-500">Shipping</span>
                    <span class="fw-500">$178.00</span>
                  </div>

                  <div class="item">
                    <span class="fw-500">Total</span>
                    <span class="fw-500">$9,218.00</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


<?php
  include_once "footer.php";
  include_once "tail.php";
?>