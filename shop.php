<?php 
include_once "inc/config.php";
include_once "inc/drc.php";

$pagetitle = "Shop - ";
include_once "head.php";
include_once "header.php"

?>

      <section data-anim="fade" class="breadcrumbs d-none">
        <div class="container ">
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
        
        <div class="container">
          <div class="page-header__content">
            <div class="row justify-cente text-left">
              <div class="col-auto pt-30 pb-30">
                <div data-anim="slide-up delay-1">
                  <h1 class="page-header__title text-white">Our Collection</h1>
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
          <div class="row x-gap-60">
            <div class="col-lg-3 display-none">

              <div data-anim="slide-up delay-3" class="sidebar -shop">
                <div class="sidebar__item">

                  <div class="sidebar__search mb-30">
                    <div class="search">
                      <form action="https://creativelayers.net/themes/educrat-html/post">
                        <button class="submit" type="submit">
                          <i class="icon" data-feather="search">
</i>
                        </button>
                        <input class="field" type="text" placeholder="Search">
                      </form>
                    </div>
                  </div>

                  <h5 class="sidebar__title">Categories</h5>

                  <div class="sidebar-content -list">

                    <a class="text-dark-1" href="#">College</a>

                    <a class="text-dark-1" href="#">Gym</a>

                    <a class="text-dark-1" href="#">High School</a>

                    <a class="text-dark-1" href="#">Primary</a>

                    <a class="text-dark-1" href="#">School</a>

                    <a class="text-dark-1" href="#">University</a>

                  </div>
                </div>

                <div class="sidebar__item">
                  <h5 class="sidebar__title">Filter by price</h5>

                  <div class="sidebar-content -slider">
                    <div class="js-price-rangeSlider">
                      <div class="px-5">
                        <div class="js-slider">
</div>
                      </div>

                      <div class="mt-25">
                        <div class="d-flex items-center justify-between text-14">
                          <span>Min Price: <span class="js-lower">
</span>
</span>
                          <span>Max Price: <span class="js-upper">
</span>
</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="sidebar__item">
                  <h5 class="sidebar__title">Tags</h5>

                  <div class="sidebar-content -tags">

                    <div class="sidebar-tag">
                      <a class="text-11 fw-500 text-dark-1" href="#">Courses</a>
                    </div>

                    <div class="sidebar-tag">
                      <a class="text-11 fw-500 text-dark-1" href="#">Learn</a>
                    </div>

                    <div class="sidebar-tag">
                      <a class="text-11 fw-500 text-dark-1" href="#">Online</a>
                    </div>

                    <div class="sidebar-tag">
                      <a class="text-11 fw-500 text-dark-1" href="#">Education</a>
                    </div>

                    <div class="sidebar-tag">
                      <a class="text-11 fw-500 text-dark-1" href="#">LMS</a>
                    </div>

                    <div class="sidebar-tag">
                      <a class="text-11 fw-500 text-dark-1" href="#">Training</a>
                    </div>

                  </div>
                </div>
              </div>

            </div>

            <div class="col-lg-12">
              <div class="row y-gap-10 justify-between items-center">
                <div class="col-auto">
                  <div class="text-14">
                    Showing <span class="fw-500 text-dark-1">250</span> total results
                  </div>
                </div>

                <div class="col-auto">
                  <div class="d-flex items-center">
                    <div class="fw-500 text-dark-1 mr-20">
                      Sort by:
                    </div>

                    <div class="dropdown js-shop-dropdown">
                      <div class="d-flex items-center text-14">
                        <span class="js-dropdown-title">
                          Default Sorting
                        </span>
                        <i class="icon size-20 ml-40" data-feather="chevron-down">
</i>
                      </div>

                      <div class="dropdown__item">
                        <div class="text-14 y-gap-15 js-dropdown-list">
                          <div>
                            <a class="d-block decoration-none js-dropdown-link" href="#">Default Sorting</a>
                          </div>
                          <div>
                            <a class="d-block decoration-none js-dropdown-link" href="#">Clothing</a>
                          </div>
                          <div>
                            <a class="d-block decoration-none js-dropdown-link" href="#">Glasses</a>
                          </div>
                          <div>
                            <a class="d-block decoration-none js-dropdown-link" href="#">T-Shirts</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="row y-gap-30 pt-30">
              <?php 
                  $prodsql = mysqli_query($conn, "SELECT * FROM products");
                  while ($row_prod = mysqli_fetch_assoc($prodsql)) {
                      $product_name = $row_prod['producttitle']; // Assuming the column name for the product name is 'product_name'
                      $price = $row_prod['price']; // Assuming the column name for the original price is 'original_price'
                      $dis_price = $row_prod['discount_price']; // Assuming the column name for the discounted price is 'discounted_price'
                      $original_price = '&#8358;' . number_format($price);
                      $discounted_price = '&#8358;' . number_format($dis_price);

                      $product_id = $row_prod['productid'];

                      $prodsql_img = mysqli_query($conn, "SELECT * FROM product_images WHERE thumbnail = 1 AND product_id = '$product_id'");
                        $row_prod_img = mysqli_fetch_assoc($prodsql_img);
                        // while ($row_prod_img = mysqli_fetch_assoc($prodsql_img)) {
                        $image_path = $row_prod_img['image_path'];
                        $image_id = $row_prod_img['img_id'];
                        // $is_thumbnail = $row_prod_img['thumbnail'] == 1 ? 'thumbnail-selected' : '';
                      
                  ?>

                <div class="col-lg-3 col-sm-6">
                  <div class="productCard -type-1 text-center">

                    <div class="productCard__image">
                        <div class="d-flex justify-between py-10 px-10 absolute-full-center z-3">
                          <div>
                            <div class="px-10 rounded-8 bg-orange-1">
                              <span class="text-11 lh-1 uppercase fw-500 text-white">Popular</span>
                            </div>
                          </div>

                          <div class="display-none">
                            <div class="px-15 rounded-8 bg-green-1">
                              <span class="text-11 lh-1 uppercase fw-500 text-dark-1">Best sellers</span>
                            </div>
                          </div>

                        </div>

                        <div class="ratio ratio-63:57">
                          <img class="absolute-full-center rounded-8" src="<?php echo $image_path; ?>" alt="product image">
                        </div>
                        <!-- <img src="assets/img/shop/products/1.png" alt="Product image"> -->
                        
                        <div class="productCard__controls z-3">
                         
                          <a href="#" class="productCard__icon">
                          <i class="fa-regular fa-send"></i>
                          </a>
                          
                          <a data-barba href="assets/img/shop/single/3.png" class="gallery__item js-gallery productCard__icon" data-gallery="gallery1">
                            <i class="fa-regular fa-eye"></i>
                          </a>
                          <a data-barba href="assets/img/shop/single/3.png" class="gallery__item js-gallery " data-gallery="gallery2"></a>
                          
                          
                        </div>

                      
                  
                    </div>
                    <div class="productCard__content mt-20">
                      
                      <h4 class="text-17 fw-500 mt-15"><?php echo $product_name ?></h4>
                      <div class="text-17 fw-500 text-deep-green-1 mt-15"> <span class="line-through opac-50 text-14"><?php echo $discounted_price ?></span> <?php echo $original_price ?></div>

                      <div class="productCard__button d-inline-block">
                        <a href="#" class="button -md -outline-deep-green-1 text-dark-1 mt-15">Add To Cart</a>
                      </div>
                    </div>
                  </div>
                </div>

                <?php
                  }
                ?>
              </div>

              <div class="row justify-center pt-60 lg:pt-40">
                <div class="col-auto">
                  <div class="pagination -buttons">
                    <button class="pagination__button -prev">
                      <i class="icon icon-chevron-left">
</i>
                    </button>

                    <div class="pagination__count">
                      <a href="#">1</a>
                      <a class="-count-is-active" href="#">2</a>
                      <a href="#">3</a>
                      <span>...</span>
                      <a href="#">67</a>
                    </div>

                    <button class="pagination__button -next">
                      <i class="icon icon-chevron-right">
</i>
                    </button>
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