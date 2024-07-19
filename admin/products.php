<?php 
    session_start();

    include_once "../inc/config.php"; 
    $pagetitle = "All Products";
    include_once "../inc/drc.php"; 

    

    if(!isset($_SESSION['user_id'])){
        header("location: ".ADMIN_LOGIN."?url=".$current_url."&t=".$pagetitle);// redirect to login page if not signed in
        exit; // Make sure to exit after sending the redirection header
    }else{
        $unique_id = $_SESSION['user_id'];
        
    }
  
  include_once "adm-head.php"; 
  include_once "adm-header.php"; 


  
  $sql = mysqli_query($conn, "SELECT * FROM bob_admin WHERE user_id = '{$_SESSION['user_id']}'");
  $row = mysqli_fetch_assoc($sql);
  $user_id = $row["user_id"];

  $fname = $row['fname'];

  // $categories = mysqli_query($conn, "SELECT * FROM bob_categories");

  // $product_id = $_GET['productid'];


?>






      <div class="content-wrapper js-content-wrapper">
        <div class="dashboard -home-9 js-dashboard-home-9">
            
          <?php include_once "adm-sidebar.php" ?>
          
          <div class="dashboard__main">
            <div class="dashboard__content bg-light-4">
              <div class="row pb-50 mb-10">
                <div class="col-auto">

                  <h1 class="text-30 lh-12 fw-700">My Courses</h1>
                  <div class="mt-10">Lorem ipsum dolor sit amet, consectetur.</div>

                </div>
              </div>


              <div class="row y-gap-30">
                <div class="col-12">
                  <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                    <div class="tabs -active-purple-2 js-tabs">
                      <div class="tabs__controls d-flex items-center pt-20 px-30 border-bottom-light js-tabs-controls">
                        <button class="text-light-1 lh-12 tabs__button js-tabs-button is-active" data-tab-target=".-tab-item-1" type="button">
                          All Courses
                        </button>
                        <button class="text-light-1 lh-12 tabs__button js-tabs-button ml-30" data-tab-target=".-tab-item-2" type="button">
                          Finished
                        </button>
                        <button class="text-light-1 lh-12 tabs__button js-tabs-button ml-30" data-tab-target=".-tab-item-3" type="button">
                          Not enrolled
                        </button>
                      </div>

                      <div class="tabs__content py-30 px-30 js-tabs-content">
                        <div class="tabs__pane -tab-item-1 is-active">
                          <div class="row y-gap-10 justify-between">
                            <div class="col-auto">
                              <form class="search-field border-light rounded-8 h-50" action="https://creativelayers.net/themes/educrat-html/post">
                                <input class="bg-white -dark-bg-dark-2 pr-50" type="text" placeholder="Search Courses">
                                <button class="" type="submit">
                                  <i class="icon-search text-light-1 text-20"></i>
                                </button>
                              </form>
                            </div>

                            <div class="col-auto">
                              <div class="d-flex flex-wrap y-gap-10 x-gap-20">
                                <div>

                                  <div class="dropdown js-dropdown js-category-active">
                                    <div class="dropdown__button d-flex items-center text-14 bg-white -dark-bg-dark-2 border-light rounded-8 px-20 py-10 text-14 lh-12" data-el-toggle=".js-category-toggle" data-el-toggle-active=".js-category-active">
                                      <span class="js-dropdown-title">Categories</span>
                                      <i class="icon text-9 ml-40 icon-chevron-down"></i>
                                    </div>

                                    <div class="toggle-element -dropdown -dark-bg-dark-2 -dark-border-white-10 js-click-dropdown js-category-toggle">
                                      <div class="text-14 y-gap-15 js-dropdown-list">

                                        <div><a href="#" class="d-block js-dropdown-link">Animation</a></div>

                                        <div><a href="#" class="d-block js-dropdown-link">Design</a></div>

                                        <div><a href="#" class="d-block js-dropdown-link">Illustration</a></div>

                                        <div><a href="#" class="d-block js-dropdown-link">Business</a></div>

                                      </div>
                                    </div>
                                  </div>

                                </div>
                                <div>

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
                                  $image_path = '../'.$row_prod_img['image_path'];
                                  $image_id = $row_prod_img['img_id'];
                                  // $is_thumbnail = $row_prod_img['thumbnail'] == 1 ? 'thumbnail-selected' : '';
                                
                            ?>

                            <div class="w-1/4 xl:w-1/3 lg:w-1/2 sm:w-1/1">
                                <div class="productCard -type-1 text-center">
                                    <div class="productCard__image">
                                        <div class="ratio ratio-63:57">
                                            <img class="absolute-full-center rounded-8" src="<?php echo $image_path; ?>" alt="product image">
                                        </div>
                                        <div class="productCard__controls z-3">
                                            <a href="#" class="productCard__icon">
                                                <i class="fa-regular fa-send"></i>
                                            </a>
                                            <a data-barba href="<?php echo $image_path; ?>" class="gallery__item js-gallery productCard__icon" data-gallery="gallery1">
                                                <i class="fa-regular fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="productCard__content mt-20">
                                        <h4 class="text-17 fw-500 mt-15"><?php echo $product_name; ?></h4>
                                        <div class="text-17 fw-500 text-deep-green-1 mt-15">
                                            <span class="line-through opac-50 text-14"><?php echo $discounted_price; ?></span> <?php echo $original_price; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php } ?>



                            


                            

                           

                          </div>

                          <div class="row justify-center pt-30 d-none">
                            <div class="col-auto">
                              <div class="pagination -buttons">
                                <button class="pagination__button -prev">
                                  <i class="icon icon-chevron-left"></i>
                                </button>

                                <div class="pagination__count">
                                  <a href="#">1</a>
                                  <a class="-count-is-active" href="#">2</a>
                                  <a href="#">3</a>
                                  <span>...</span>
                                  <a href="#">67</a>
                                </div>

                                <button class="pagination__button -next">
                                  <i class="icon icon-chevron-right"></i>
                                </button>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="tabs__pane -tab-item-2"></div>
                        <div class="tabs__pane -tab-item-3"></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>



    

            
<?php 
    include_once "adm-footer.php"; 
    include_once "adm-tail.php"; 
?>