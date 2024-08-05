<?php 
include_once "inc/config.php";
include_once "inc/drc.php";

$pagetitle = "Checkout - ";
include_once "head.php";
include_once "header.php"

?>
<script src="https://checkout.flutterwave.com/v3.js"></script>


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


      <section class="page-header -type-1 mt-60 text-white">
        <div class="overlay"></div>
        <div class="container">
          <div class="page-header__content">
            <div class="row justify-center text-center">
              <div class="col-auto">
                <div data-anim="slide-up delay-1">

                  <h1 class="page-header__title text-white">Shop Checkout</h1>

                </div>

                <div data-anim="slide-up delay-2">

                <p class="page-header__text">We’re on a mission to deliver Comfortable Clothing at a reasonable price.</p>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="layout-pt-md layout-pb-lg">
        <div class="container">
          <div class="row y-gap-50">


          <form id="checkoutForm" class="contact-form row x-gap-30 y-gap-30">
              <div class="col-lg-8">
                  <div class="shopCheckout-form row">
                      <div class="col-12">
                          <h5 class="text-20">Delivery details</h5>
                      </div>
                      <div class="col-sm-6">
                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">First name</label>
                          <input type="text" name="firstName" placeholder="First name" required>
                      </div>
                      <div class="col-sm-6">
                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Last name</label>
                          <input type="text" name="lastName" placeholder="Last name" required>
                      </div>
                      <div class="col-sm-6">
                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Email address *</label>
                          <input type="email" name="email" placeholder="Email address *" required>
                      </div>
                      <div class="col-sm-6">
                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Phone *</label>
                          <input type="text" name="phone" placeholder="Phone *" required>
                      </div>
                      <div class="col-12">
                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Country / Region *</label>
                          <select class="selectize wide js-selectize" name="country" required>
                              <option value="NG">Nigeria</option>
                          </select>
                      </div>
                      <div class="col-sm-6">
                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">State *</label>
                          <input type="text" name="state" placeholder="State *" required>
                      </div>
                      <div class="col-sm-6">
                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Town / City *</label>
                          <input type="text" name="city" placeholder="Town / City *" required>
                      </div>
                      <div class="col-sm-12">
                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Street Address*</label>
                          <input type="text" name="street" placeholder="Street Address" required>
                      </div>
                      <div class="col-12">
                          <h5 class="text-20 fw-500 pt-30">Additional information</h5>
                      </div>
                      <div class="col-12">
                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Order notes (optional)</label>
                          <textarea name="notes" id="form_notes" rows="8" placeholder="Order notes (optional)"></textarea>
                      </div>
                  </div>
              </div>
              <div class="col-lg-4">
                  <div class="">
                      <div class="pt-30 pb-15 bg-white border-light rounded-8 bg-light-4">
                          <h5 class="px-30 text-20 fw-500">Your order</h5>
                          <div id="totalCartItemsContainer"></div>
                          <div class="d-flex justify-between border-top-dark px-30">
                              <div class="py-15 fw-500">Subtotal</div>
                              <div class="py-15 fw-500" id="subtotal">₦0.00</div>
                          </div>
                          <div class="d-flex justify-between border-top-dark px-30">
                              <div class="py-15 fw-500 text-dark-1">Shipping</div>
                              <div class="py-15 fw-500 text-dark-1" id="shipping">₦0.00</div>
                          </div>
                          <div class="d-flex justify-between border-top-dark px-30">
                              <div class="py-15 fw-500 text-dark-1">Total</div>
                              <div class="py-15 fw-500 text-dark-1" id="total">₦0.00</div>
                          </div>
                      </div>
                      <div class="py-30 px-30 bg-white mt-30 border-light rounded-8 bg-light-4">
                          <h5 class="text-20 fw-500">Shipping Method</h5>
                          <div class="mt-30">
                              <button type="submit" id="payNowButton" class="button -md -deep-green-1 text-white col-12 mt-30">Pay Now</button>
                          </div>
                      </div>
                  </div>
              </div>
          </form>



        </div>
      </section>





  <!-- <div class="py-30 px-30 bg-white mt-30 border-light rounded-8 bg-light-4 d-none">
    <h5 class="text-20 fw-500">Shipping Method</h5>
    <div class="mt-30 ">
      <div class="form-radio d-flex items-center">
        <div class="radio">
          <input type="radio" name="radio">
          <div class="radio__mark">
            <div class="radio__icon"></div>
          </div>
        </div>
        <h5 class="ml-15 text-15 lh-1 fw-500 text-dark-1">Direct bank transfer</h5>
      </div>
      <p class="ml-25 pl-5 mt-25">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</p>
    </div>
    <div class="mt-30">
      <a href="<?php echo ORDER ?>" class="button -md -deep-green-1 text-white col-12 mt-30">Place order</a>
    </div>
  </div> -->
<!-- <script src="api/payment.js"></script> -->
<?php
  include_once "footer.php";
  include_once "tail.php";
?>