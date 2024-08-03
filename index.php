<?php 
  include_once "inc/config.php";
  include_once "inc/drc.php";

  $pagetitle = "Home - ";
  include_once "head.php";
  include_once "header.php"

?>



    <div class="content-wrapper  js-content-wrapper">
      
      <section data-anim-wrap class="mainSlider -type-1 js-mainSlider">
        <div class="swiper-wrapper">
          <div class="swiper-slide">
            <div data-anim-child="fade" class="mainSlider__bg">
              <div class="bg-image js-lazy" data-bg="admin/assets/img/landing.jpg"></div>
            </div>
          </div>
          <div class="swiper-slide">
            <div data-anim-child="fade" class="mainSlider__bg">
              <div class="bg-image js-lazy" data-bg="admin/assets/img/landing.jpg"></div>
            </div>
          </div>
          <div class="swiper-slide">
            <div data-anim-child="fade" class="mainSlider__bg">
              <div class="bg-image js-lazy" data-bg="admin/assets/img/landing.jpg"></div>
            </div>
          </div>
        </div>

        <div class="container">
            <div class="row y-gap-50 justify-center items-center text-center">
              <div class="col-xl-6 col-lg-8">
                <div class="mainSlider__content">
                  <div data-anim-child="slide-up delay-2" class="masthead__subtitle fw-500 text-green-1 text-17 lh-15">
                    NEW ARRIVAL
                  </div>
                  <h1 data-anim-child="slide-up delay-3" class="mainSlider__title text-white">
                    Ego Builder
                  </h1>
                  <div data-anim-child="slide-up delay-2" class="masthead__subtitle fw-500 text-green-1 text-17 lh-15 mt-10">
                    Comfortability
                  </div>
                  <div data-anim-child="slide-up delay-4" class="masthead__button mt-20 mb-90">
                    <a href="<?php  echo SHOP ?>" class="button -md -white text-dark-1">Visit the shop</a>
                  </div>
                </div>
              </div>
            </div>

        <button class="d-none swiper-prev button -white-20 text-white size-60 rounded-full d-flex justify-center items-center js-prev d-none">
          <i class="icon icon-arrow-left text-24"></i>
        </button>

        <button class="d-none swiper-next button -white-20 text-white size-60 rounded-full d-flex justify-center items-center js-next d-none">
          <i class="icon icon-arrow-right text-24"></i>
        </button>
      </section>
      
      <!-- Hero Section Begin -->
      <div class="d-none" style="padding-top: 2%;;">
        <section data-anim-wrap class="masthead -type-2">
          <div class="masthead__bg">
            <div class="bg-image js-lazy" data-bg="admin/assets/img/landing.png"></div>
          </div>

          <div class="container">
            <div class="row y-gap-50 justify-center items-center">
              <div class="col-xl-10 col-lg-11">
                <div class="masthead__content text-center">
                  <div data-anim-child="slide-up delay-2" class="masthead__subtitle fw-500 text-green-1 text-17 lh-15">
                    NEW ARRIVAL
                  </div>
                  <h1 data-anim-child="slide-up delay-1" class="masthead__title text-white mt-10">
                    Ego Builder
                  </h1>
                  <div data-anim-child="slide-up delay-2" class="masthead__subtitle fw-500 text-green-1 text-17 lh-15 mt-10">
                    Comfortability
                  </div>
                  <div data-anim-child="slide-up delay-4" class="masthead__button mt-20">
                    <a href="<?php  echo SHOP ?>" class="button -md -white text-dark-1">Check the shop</a>
                  </div>
                </div>
              </div>

              
            </div>
          </div>
        </section>
      </div>
      <!-- Hero Section End -->

      <section class="layout-pt-md layout-pb-lg pt-">
        <div class="container">
          <div class="row x-gap-60">
            <div class="col-lg-12">
            <div class="row y-gap-30">
                <?php 
                    $prodsql = mysqli_query($conn, "SELECT * FROM products");
                    while ($row_prod = mysqli_fetch_assoc($prodsql)) {
                        $product_name = $row_prod['producttitle']; // Assuming the column name for the product name is 'product_name'
                        $price = $row_prod['price']; // Assuming the column name for the original price is 'original_price'
                        $dis_price = $row_prod['discount_price']; // Assuming the column name for the discounted price is 'discounted_price'
                        $original_price = '&#8358;' . number_format($price);
                        $discounted_price = '&#8358;' . number_format($dis_price);
                        $product_id = $row_prod['productid'];

                        // Get the thumbnail image
                        $prodsql_img_thumbnail = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 1");
                        $row_prod_img_thumbnail = mysqli_fetch_assoc($prodsql_img_thumbnail);
                        $image_path_thumbnail = $row_prod_img_thumbnail['image_path'];
                        $product_img = $image_path_thumbnail;

                        // Get the non-thumbnail images
                        $prodsql_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 0");
                        $other_images = [];
                        while ($row_prod_img = mysqli_fetch_assoc($prodsql_img)) {
                            $other_images[] = $row_prod_img['image_path'];
                        }
                    ?>
                        
                                
                        <div class="w-1/4 xl:w-1/3 lg:w-1/2 sm:w-1/2">

                            <form id="productForm" class="productCard -type-1 text-center" data-product-id="<?php echo $product_id; ?>" data-price="<?php echo $price; ?>" data-image="<?php echo $image_path_thumbnail; ?>" data-name="<?php echo $product_name; ?>" data-discounted-price="<?php echo $dis_price; ?>">
                                <div class="productCard__image">
                                    <div class="ratio ratio-63:57">
                                        <img class="absolute-full-center rounded-8" src="<?php echo $image_path_thumbnail; ?>" alt="product image">
                                    </div>
                                    <div class="productCard__controls z-3">
                                        <a href="#" class="productCard__icon">
                                            <i class="fa-regular fa-send"></i>
                                        </a>
                                        <a data-barba href="<?php echo $image_path_thumbnail; ?>" class="gallery__item js-gallery productCard__icon" data-gallery="<?php echo $product_id ?>">
                                            <i class="fa-regular fa-images"></i>
                                        </a>
                                        <a href="<?php echo PRODUCT_DETAIILS.'?id='.$product_id; ?>" class="productCard__icon">
                                            <i class="fa-regular fa-eye"></i>
                                        </a>    
                                    </div>
                                </div>
                                <!-- <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <input type="hidden" name="product_img" value="<?php echo $image_path_thumbnail; ?>">
                                <input type="hidden" name="price" value="<?php echo $price; ?>"> -->
                                <input type="hidden" name="quantity" value="1">
                                <div class="productCard__content mt-20">
                                    <h4 class="text-17 fw-500 mt-15"><?php echo $product_name; ?></h4>
                                    <div class="text-17 fw-500 text-deep-green-1 mt-15">
                                        <span class="line-through opac-50 text-14"><?php echo $discounted_price; ?></span> <?php echo $original_price; ?>
                                    </div>
                                    <div class="productCard__button d-inline-block add_to_cart_btn" style="width: 100% !important">
                                        <button type="button" class="button fs-16 w-100 -outline-deep-green-1 text-dark-1 mt-15 toggle-cart" style="width:100%; font-size: 16px; line-height: 18px; font-weight: 500; height: 60px;">Add To Cart</button>
                                    </div>
                                </div>
                            </form>

                            <?php foreach ($other_images as $image_path): ?>
                              <a data-barba href="<?php echo $image_path; ?>" class="gallery__item js-gallery " data-gallery="<?php echo $product_id ?>"></a>
                            <?php endforeach; ?>
                        </div>

                        
                        
                    <?php 
                    }
                    ?>
              </div>
              <div data-anim-child="slide-up delay-4" class="mt-20 mb-90">
                          <a href="<?php  echo SHOP ?>" class="button -md  text-dark-1">Visit the shop</a>
                        </div>
                      <a href="" class="button -md">button</a>
              <div class="row y-gap-30">
                <div class="col-lg-3 col-sm-6">
                  <div class="productCard -type-1 text-center">

                    <div class="productCard__image">

                        <div class="ratio ratio-63:57">
                          <img class="absolute-full-center rounded-8" src="admin/assets/img/shop/single/1.png" alt="project image">
                        </div>
                        <div class="productCard__controls z-3">
                          <a href="#" class="productCard__icon">
                          <i class="fa-regular fa-send"></i>
                          </a>
                          
                          <a data-barba href="admin/assets/img/shop/single/3.png" class="gallery__item js-gallery productCard__icon" data-gallery="gallery1">
                            <i class="fa-regular fa-eye"></i>
                          </a>
                          <a data-barba href="admin/assets/img/shop/single/3.png" class="gallery__item js-gallery " data-gallery="gallery2"></a>
                        </div>

                      
                  
                    </div>
                    <div class="productCard__content mt-20">
                      
                      <h4 class="text-17 fw-500 mt-15">Wall Clock Brown</h4>
                      <div class="text-17 fw-500 text-deep-green-1 mt-15"> <span class="line-through opac-50 text-14">$55.00</span> $55.00</div>

                      <div class="productCard__button d-inline-block">
                        <a href="#" class="button -md -outline-deep-green-1 text-dark-1 mt-15">Add To Cart</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="layout-pt-l layout-pb-l pt-50 pb-50 d-none">
        <div class="container">

          <div class="row y-gap-3">
           

            <div class="col-lg-3 col-md-6">
              <div class="row y-gap-3">
                <div class="col-12">
                  <div class="categoryCard -type-1">
                    <div class="categoryCard__image">
                      <div class="bg-image ratio ratio-30:35 js-lazy" data-bg="admin/assets/img/home-2/categories/5.png"></div>
                    </div>
                    <div class="categoryCard__content text-center">
                      <h4 class="categoryCard__title text-17 lh-15 fw-500 text-white">Personal Development</h4>
                      <div class="categoryCard__subtitle text-13 text-white lh-1 mt-5">573+ Courses </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-md-6">
              <div class="row y-gap-">
                <div class="col-12">
                  <div class="categoryCard -type-1">
                    <div class="categoryCard__image">
                      <div class="bg-image ratio ratio-30:35 js-lazy" data-bg="admin/assets/img/home-2/categories/5.png"></div>
                    </div>
                    <div class="categoryCard__content text-center">
                      <h4 class="categoryCard__title text-17 lh-15 fw-500 text-white">Personal Development</h4>
                      <div class="categoryCard__subtitle text-13 text-white lh-1 mt-5">573+ Courses </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          
          </div>
        </div>
      </section>


      <!-- Newsletter Section Begin -->
      <section class="layout-pt-l layout-pb-lg mb-90 section-bg d-none">
        <div class="section-bg__item">
          <img class="img-full rounded-16" src="admin/assets/img/home-3/cta/bg.png" alt="image">
        </div>

        <div class="container">
          <div class="row justify-center text-center">
            <div class="col-xl-5 col-lg-6 col-md-11">

              <div class="sectionTitle -light">

                <h2 class="sectionTitle__title ">Subscribe our Newsletter &</h2>

                <p class="sectionTitle__text ">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>

              </div>

            </div>
          </div>

          <div class="row mt-30 justify-center">
            <div class="col-lg-6">
              <form class="form-single-field -help" action="https://creativelayers.net/themes/educrat-html/post">
                <input type="text" placeholder="Your Email...">
                <button class="button -purple-1 text-white" type="submit">
                  Submit
                </button>
              </form>
            </div>
          </div>
        </div>
      </section>
      <!-- Newsletter Section End -->

   

<?php
 include_once "footer.php";
 include_once "tail.php";
?>