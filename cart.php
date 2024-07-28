<?php 
include_once "inc/config.php";
include_once "inc/drc.php";

$pagetitle = "Cart - ";
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

                  <h1 class="page-header__title">Shop Cart</h1>

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
          <div class="table-responsive">
              <table class="table w-1/1 d-non align-middle">
                <thead>
                  <tr>
                    <th class="">Image</th>
                    <th class="">Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                
                <tbody class="cart-items-container">

                    <tr>
                      <td class="">
                        <div class="size-100 bg-image rounded-8 js-lazy mr-10" data-bg="products/66a3e51f4ec445.73910591.jpg"></div>
                      </td>

                      <td>
                        <div class="fw-500 text-dark-1">Cosy Chair - Beige, Leather</div>
                      </td>

                      <td>
                        <p>$1.298</p>
                      </td>

                      <td>
                        <div class="input-counter  js-input-counter">
                          <input class='input-counter__counter' type="number" placeholder="value..." value='1' />
                          

                          <div class="input-counter__controls">
                            <button class='input-counter__up js-down'>
                              <i class='icon' data-feather="minus"></i>
                            </button>

                            <button class='input-counter__down js-up'>
                              <i class='icon' data-feather="plus"></i>
                            </button>
                          </div>
                        </div>
                      </td>

                      <td>
                        <p>$1.298</p>
                      </td>


                      <td>
                        <i class="icon" data-feather="x"></i>
                      </td>
                    </tr>
                    
                </tbody>
              </table>

          </div>



          <div class="row justify-end d-none">
            <div class="col-12 table-responsive">
              <div class="px-30 pr-60 py-25 rounded-8 bg-light-6 md:d-noe">
                <div class="row justify-beteen">
                  <div class="col-md-3 col-3">
                    <div class="fw-500 text-deep-green-1">Product</div>
                  </div>
                  <div class="col-md-2 col-2">
                    <div class="fw-500 text-deep-green-1">Price</div>
                  </div>
                  <div class="col-md-3 col-3">
                    <div class="fw-500 text-deep-green-1">Quantity</div>
                  </div>
                  <div class="col-md-2 col-2">
                    <div class="fw-500 text-deep-green-1">Subtotal</div>
                  </div>
                  <div class="col-md-1 col-1">
                    <div class="d-flex justify-en">
                      <div class="fw-500 text-deep-green-1">Remove</div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="px-30 pr-60 md:px-0 cart-items-containe">

                <div class="row y-gap-20 justify-betwee items-center pt-30 pb-30 border-bottom-light d-noe">
                  <div class="col-md-3 col-3">
                    <div class="d-flex items-center">
                      <div class="">
                        <div class="size-100 bg-image rounded-8 js-lazy md:d-none mr-10" data-bg="products/66a3e51f4ec445.73910591.jpg"></div>
                      </div>
                      <div class="fw-500 text-dark-1">Cosy Chair - Beige, Leather</div>
                    </div>
                  </div>

                  <div class="col-md-2 col-2">
                    <div class="">
                      
                      <p>$298</p>
                    </div>
                  </div>

                  <div class="col-md-3 col-3">
                    <div class="">
                      <div class="shopCart-products__title d-none md:d-block mb-10">
                        Quantity
                      </div>

                      <div class="input-counter md:mt-20 js-input-counter">
                        <input class='input-counter__counter' type="number" placeholder="value..." value='1' />

                        <div class="input-counter__controls">
                          <button class='input-counter__up js-down'>
                            <i class='icon' data-feather="minus"></i>
                          </button>

                          <button class='input-counter__down js-up'>
                            <i class='icon' data-feather="plus"></i>
                          </button>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-md-2 col-2">
                    <div class="">
                      <div class="shopCart-products__title d-none md:d-block mb-10">
                        Subtotal
                      </div>

                      <p>$1.298</p>
                    </div>
                  </div>

                  <div class="col-md-1 col-1">
                    <div class="md:d-none d-flex justify-end">
                      <i class="icon" data-feather="x"></i>
                    </div>
                  </div>
                </div>

                

               

              </div>

              <div class="shopCart-footer px-16 mt-30">
                <div class="row justify-between y-gap-30">
                  <div class="col-xl-5">
                    <form class="" action="https://creativelayers.net/themes/educrat-html/post">
                      <div class="d-flex justify-between border-dark">
                        <input class="rounded-8 px-25 py-20" type="text" placeholder="Coupon Code">
                        <button class="text-black fw-500" type="submit">Apply coupon</button>
                      </div>
                    </form>
                  </div>

                  <div class="col-auto">
                    <div class="shopCart-footer__item">
                      <button class="button -md -deep-green-3 text-white">Update cart</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-4 col-lg-5 layout-pt-lg">
              <div class="py-30 bg-light-4 rounded-8 border-light">
                <h5 class="px-30 text-20 fw-500">
                  Cart Totals
                </h5>

                <div class="d-flex justify-between px-30 item mt-25">
                  <div class="py-15 fw-500 text-dark-1">Subtotal</div>
                  <div class="py-15 fw-500 text-dark-1">$1.298</div>
                </div>

                <div class="d-flex justify-between px-30 item border-top-dark">
                  <div class="pt-15 fw-500 text-dark-1">Total</div>
                  <div class="pt-15 fw-500 text-dark-1" id="total-price2">$3.298</div>
                </div>
              </div>

              <a href="<?php echo CHECKOUT ?>" class="button -md -deep-green-1 text-white col-12 mt-30">Proceed to checkout</a>
            </div>
          </div>
        </div>
      </section>

      <?php
  include_once "footer.php";
  include_once "tail.php";
?>