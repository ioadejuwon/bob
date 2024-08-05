
<style>
  .input-counter {
            display: flex;
            align-items: center;
        }

        .input-counter input {
            width: 50px;
            text-align: center;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .input-counter button {
            background-color: #f0f0f0;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 5px;
            margin: 0 2px;
            cursor: pointer;
        }

        .input-counter button:hover {
            background-color: #e0e0e0;
        }
</style>
<?php 
include_once "inc/config.php";
include_once "inc/drc.php";

$pagetitle = "Cart - ";
include_once "head.php";
include_once "header.php";

echo '<script>';
echo 'var shop = "' . SHOP . '";';
echo '</script>';


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


      <section class="page-header -type-1 mt-60 bg-deep-green-1 text-white">
      <div class="overlay"></div>
        <div class="container">
          <div class="page-header__content">
            <div class="row justify-center text-left">
              <div class="col-auto">
                <div data-anim="slide-up delay-1">

                  <h1 class="page-header__title text-white">Shop Cart</h1>

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
              <table class="table w-1/1 d-non align-middle" id="cart-items-container2">
                <thead >
                  <tr>
                    <th class="">Image</th>
                    <th class="">Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th>Remove</th>
                  </tr>
                </thead>
                
                <tbody id="cartItems">
                 
                    <td>
                      <div style="width: 100px; height: 100px; background-image: url('${item.product_img}'); background-size: cover; background-position: center; border-radius: 8px;"></div>
                    </td>
                    <td>
                        <div class="fw-500 text-dark-1">${item.producttitle}</div>
                    </td>
                    <td>
                        <p>${item.price}</p>
                    </td>
                    <td>
                        <div class="input-counter">
                            <button class="input-counter__down" data-index="${item.cart_id}" data-product-id="${item.productid}">
                                <i class='fa-solid fa-minus'></i>
                            </button>
                            <input type="number" class="input-counter__counter" value="${item.quantity}" min="1" />
                            <button class="input-counter__up" data-index="${item.cart_id}" data-product-id="${item.productid}">
                                <i class='fa-solid fa-plus'></i>
                            </button>
                        </div>
                    </td>
                    <td>
                        <p>$1.298</p>
                    </td>
                    <td>
                        <i class='fa-solid fa-x'></i>
                    </td>
                   
                </tbody>
              </table>
            </div>

              <div class="shopCart-footer px-16 mt-30">
                <div class="row justify-between y-gap-30">
                  <div class="col-xl-5">
                    <form class="" action="<?php echo CART ?>">
                      <div class="d-flex justify-between border-dark">
                        <input class="rounded-8 px-25 py-20" type="text" name="coupon" placeholder="Coupon Code">
                        <button class="button text-white -md fw-500 -deep-green-1" type="submit">Apply coupon</button>
                      </div>
                    </form>
                  </div>

                  <div class="col-auto">
                    <div class="shopCart-footer__item">
                      <button class="button -md -deep-green-1 text-white">Update cart</button>
                    </div>
                  </div>
                </div>
              </div>
          

              <div class="row justify-end">
                  <div class="col-xl-4 col-lg-5 layout-pt-lg">
                      <div class="py-30 bg-light-4 rounded-8 border-light">
                          <h5 class="px-30 text-20 fw-500">Cart Total</h5>

                          <div class="d-flex justify-between px-30 item mt-25">
                              <div class="py-15 fw-500 text-dark-1">Subtotal</div>
                              <div class="py-15 fw-500 text-dark-1" id="subtotal">₦0.00</div>
                          </div>

                          <div class="d-flex justify-between px-30 item border-top-dark">
                              <div class="pt-15 fw-500 text-dark-1">Total</div>
                              <div class="pt-15 fw-500 text-dark-1" id="total-price2">₦0.00</div>
                          </div>
                      </div>

                      <a href="<?php echo CHECKOUT ?>" class="button -md -deep-green-1 text-white col-12 mt-30">Proceed to checkout</a>
                  </div>
              </div>
        </div>
      </section>



      <script>
        
    </script>


      <?php
  include_once "footer.php";
  include_once "tail.php";
?>