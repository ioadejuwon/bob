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

                                // Get the thumbnail image
                                $prodsql_img_thumbnail = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 1");
                                $row_prod_img_thumbnail = mysqli_fetch_assoc($prodsql_img_thumbnail);
                                $image_path_thumbnail = '../'.$row_prod_img_thumbnail['image_path'];

                                // Get the non-thumbnail images
                                $prodsql_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 0");
                                $other_images = [];
                                while ($row_prod_img = mysqli_fetch_assoc($prodsql_img)) {
                                    $other_images[] = '../'.$row_prod_img['image_path'];
                                }
                            ?>
                        
                                
                                <div class="w-1/4 xl:w-1/3 lg:w-1/2 sm:w-1/1">
                                    <div class="productCard -type-1 text-center">
                                        <div class="productCard__image">
                                            <div class="ratio ratio-63:57">
                                                <img class="absolute-full-center rounded-8" src="<?php echo $image_path_thumbnail; ?>" alt="product image">
                                            </div>
                                            <div class="productCard__controls z-3">
                                                <a href="#" class="productCard__icon">
                                                    <i class="fa-regular fa-send"></i>
                                                </a>
                                                <a data-barba href="<?php echo $image_path_thumbnail; ?>" class="gallery__item js-gallery productCard__icon" data-gallery="<?php echo $product_id ?>">
                                                    <i class="fa-regular fa-eye"></i>
                                                </a>
                                                <a data-el-toggle="<?php echo '.'.$product_id ?>" class=" productCard__icon" >
                                                    <i class="fa-regular fa-edit"></i>
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

                                    <?php foreach ($other_images as $image_path): ?>
                                  <a data-barba href="<?php echo $image_path; ?>" class="gallery__item js-gallery " data-gallery="<?php echo $product_id ?>"></a>
                                <?php endforeach; ?>
                                </div>



                                

                                
                            <?php 
                            }
                            ?>




                            


                            

                           

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
                                $image_path_thumbnail = '../'.$row_prod_img_thumbnail['image_path'];

                                // Get the non-thumbnail images
                                $prodsql_img = mysqli_query($conn, "SELECT * FROM product_images WHERE product_id = '$product_id' AND thumbnail = 0");
                                $other_images = [];
                                while ($row_prod_img = mysqli_fetch_assoc($prodsql_img)) {
                                    $other_images[] = '../'.$row_prod_img['image_path'];
                                }
                            ?>
                                <aside class="sidebar-menu toggle-element js-dsbh-sidebar-menu -is-el-visibl <?php echo $product_id ?>">
                                  <div class="sidebar-menu__bg"></div>

                                  <div class="sidebar-menu__content scroll-bar-1 py-30 px-40 sm:py-25 sm:px-20 bg-white -dark-bg-dark-1">
                                    <div class="row items-center justify-between mb-30">
                                      <div class="col-auto">
                                        <div class="-sidebar-buttons">
                                          <button data-sidebar-menu-button="<?php echo 'messages-'.$product_id ?>" class="text-17 text-dark-1 fw-500 -is-button-active">
                                            <?php echo $product_name ?>
                                            <?php  echo $product_id?>
                                          </button>

                                          <button data-sidebar-menu-button="<?php echo 'messages-2-'.$product_id ?>" data-sidebar-menu-target="<?php echo 'messages-'.$product_id ?>" class="d-flex items-center text-17 text-dark-1 fw-500">
                                            <i class="icon-chevron-left text-11 text-purple-1 mr-10"></i>
                                            Messages
                                          </button>

                                          <button data-sidebar-menu-button="<?php echo 'settings-'.$product_id ?>" data-sidebar-menu-target="<?php echo 'messages-'.$product_id ?>" class="d-flex items-center text-17 text-dark-1 fw-500">
                                            <i class="icon-chevron-left text-11 text-purple-1 mr-10"></i>
                                            Settings
                                          </button>

                                          <button data-sidebar-menu-button="<?php echo 'contacts-'.$product_id ?>" data-sidebar-menu-target="<?php echo 'messages-'.$product_id ?>" class="d-flex items-center text-17 text-dark-1 fw-500">
                                            <i class="icon-chevron-left text-11 text-purple-1 mr-10"></i>
                                            Contacts
                                          </button>
                                        </div>
                                      </div>

                                      <div class="col-auto">
                                        <div class="row x-gap-10">
                                          <div class="col-auto">
                                            <button data-sidebar-menu-target="<?php echo 'settings-'.$product_id ?>" class="button -purple-3 text-purple-1 size-40 d-flex items-center justify-center rounded-full">
                                              <i class="icon-setting text-16"></i>
                                            </button>
                                          </div>
                                          <div class="col-auto">
                                            <button data-sidebar-menu-target="<?php echo 'contacts-'.$product_id ?>" class="button -purple-3 text-purple-1 size-40 d-flex items-center justify-center rounded-full">
                                              <i class="icon-friend text-16"></i>
                                            </button>
                                          </div>
                                          <div class="col-auto">
                                            <button data-el-toggle="<?php echo '.'.$product_id ?>" class="button -purple-3 text-purple-1 size-40 d-flex items-center justify-center rounded-full">
                                              <i class="icon-close text-14"></i>
                                            </button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="relative js-menu-switch">
                                      <div data-sidebar-menu-open="<?php echo 'messages-'.$product_id ?>" class="sidebar-menu__item -sidebar-menu -sidebar-menu-opened">
                                        <form class="search-field rounded-8 h-50" action="https://creativelayers.net/themes/educrat-html/post">
                                          <input class="bg-light-3 pr-50" type="text" placeholder="Search Courses">
                                          <button class="" type="submit">
                                            <i class="icon-search text-light-1 text-20"></i>
                                          </button>
                                        </form>

                                        <div class="accordion -block text-left pt-20 js-accordion">

                                          <div class="accordion__item border-light rounded-16">
                                            <div class="accordion__button">
                                              <div class="accordion__icon size-30 -dark-bg-dark-2 mr-10">
                                                <div class="icon d-flex items-center justify-center">
                                                  <span class="lh-1 fw-500">2</span>
                                                </div>
                                                <div class="icon d-flex items-center justify-center">
                                                  <span class="lh-1 fw-500">2</span>
                                                </div>
                                              </div>
                                              <span class="text-17 fw-500 text-dark-1 pt-3">Starred</span>
                                            </div>

                                            <div class="accordion__content">
                                              <div class="accordion__content__inner pl-20 pr-20 pb-20">
                                                <div data-sidebar-menu-target="messages-2" class="row x-gap-10 y-gap-10 pointer">
                                                  <div class="col-auto">
                                                    <img src="img/dashboard/right-sidebar/messages/1.png" alt="image">
                                                  </div>
                                                  <div class="col">
                                                    <div class="text-15 lh-12 fw-500 text-dark-1 pt-8">Darlene Robertson</div>
                                                    <div class="text-14 lh-1 mt-5"><span class="text-dark-1">You:</span> Hello</div>
                                                  </div>
                                                  <div class="col-auto">
                                                    <div class="text-13 lh-12 pt-8">35 mins</div>
                                                  </div>
                                                </div>

                                                <div data-sidebar-menu-target="messages-2" class="row x-gap-10 y-gap-10 pt-15 pointer">
                                                  <div class="col-auto">
                                                    <img src="img/dashboard/right-sidebar/messages/1.png" alt="image">
                                                  </div>
                                                  <div class="col">
                                                    <div class="text-15 lh-12 fw-500 text-dark-1 pt-8">Darlene Robertson</div>
                                                    <div class="text-14 lh-1 mt-5"><span class="text-dark-1">You:</span> Hello</div>
                                                  </div>
                                                  <div class="col-auto">
                                                    <div class="text-13 lh-12 pt-8">35 mins</div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="accordion__item border-light rounded-16">
                                            <div class="accordion__button">
                                              <div class="accordion__icon size-30 -dark-bg-dark-2 mr-10">
                                                <div class="icon d-flex items-center justify-center">
                                                  <span class="lh-1 fw-500">2</span>
                                                </div>
                                                <div class="icon d-flex items-center justify-center">
                                                  <span class="lh-1 fw-500">2</span>
                                                </div>
                                              </div>
                                              <span class="text-17 fw-500 text-dark-1 pt-3">Group</span>
                                            </div>

                                            <div class="accordion__content">
                                              <div class="accordion__content__inner pl-20 pr-20 pb-20">
                                                <div data-sidebar-menu-target="messages-2" class="row x-gap-10 y-gap-10 pointer">
                                                  <div class="col-auto">
                                                    <img src="img/dashboard/right-sidebar/messages/1.png" alt="image">
                                                  </div>
                                                  <div class="col">
                                                    <div class="text-15 lh-12 fw-500 text-dark-1 pt-8">Darlene Robertson</div>
                                                    <div class="text-14 lh-1 mt-5"><span class="text-dark-1">You:</span> Hello</div>
                                                  </div>
                                                  <div class="col-auto">
                                                    <div class="text-13 lh-12 pt-8">35 mins</div>
                                                  </div>
                                                </div>

                                                <div data-sidebar-menu-target="messages-2" class="row x-gap-10 y-gap-10 pt-15 pointer">
                                                  <div class="col-auto">
                                                    <img src="img/dashboard/right-sidebar/messages/1.png" alt="image">
                                                  </div>
                                                  <div class="col">
                                                    <div class="text-15 lh-12 fw-500 text-dark-1 pt-8">Darlene Robertson</div>
                                                    <div class="text-14 lh-1 mt-5"><span class="text-dark-1">You:</span> Hello</div>
                                                  </div>
                                                  <div class="col-auto">
                                                    <div class="text-13 lh-12 pt-8">35 mins</div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>

                                          <div class="accordion__item border-light rounded-16">
                                            <div class="accordion__button">
                                              <div class="accordion__icon size-30 -dark-bg-dark-2 mr-10">
                                                <div class="icon d-flex items-center justify-center">
                                                  <span class="lh-1 fw-500">2</span>
                                                </div>
                                                <div class="icon d-flex items-center justify-center">
                                                  <span class="lh-1 fw-500">2</span>
                                                </div>
                                              </div>
                                              <span class="text-17 fw-500 text-dark-1 pt-3">Private</span>
                                            </div>

                                            <div class="accordion__content">
                                              <div class="accordion__content__inner pl-20 pr-20 pb-20">
                                                <div data-sidebar-menu-target="messages-2" class="row x-gap-10 y-gap-10 pointer">
                                                  <div class="col-auto">
                                                    <img src="img/dashboard/right-sidebar/messages/1.png" alt="image">
                                                  </div>
                                                  <div class="col">
                                                    <div class="text-15 lh-12 fw-500 text-dark-1 pt-8">Darlene Robertson</div>
                                                    <div class="text-14 lh-1 mt-5"><span class="text-dark-1">You:</span> Hello</div>
                                                  </div>
                                                  <div class="col-auto">
                                                    <div class="text-13 lh-12 pt-8">35 mins</div>
                                                  </div>
                                                </div>

                                                <div data-sidebar-menu-target="messages-2" class="row x-gap-10 y-gap-10 pt-15 pointer">
                                                  <div class="col-auto">
                                                    <img src="img/dashboard/right-sidebar/messages/1.png" alt="image">
                                                  </div>
                                                  <div class="col">
                                                    <div class="text-15 lh-12 fw-500 text-dark-1 pt-8">Darlene Robertson</div>
                                                    <div class="text-14 lh-1 mt-5"><span class="text-dark-1">You:</span> Hello</div>
                                                  </div>
                                                  <div class="col-auto">
                                                    <div class="text-13 lh-12 pt-8">35 mins</div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                          </div>

                                        </div>
                                      </div>


                                      <div data-sidebar-menu-open="<?php echo 'messages-2-'.$product_id ?>" class="sidebar-menu__item -sidebar-menu">
                                        <div class="row x-gap-10 y-gap-10">
                                          <div class="col-auto">
                                            <img src="img/dashboard/right-sidebar/messages-2/1.png" alt="image">
                                          </div>
                                          <div class="col">
                                            <div class="text-15 lh-12 fw-500 text-dark-1 pt-8">Arlene McCoy</div>
                                            <div class="text-14 lh-1 mt-5">Active</div>
                                          </div>
                                        </div>

                                        <div class="mt-20 pt-30 border-top-light">
                                          <div class="row y-gap-20">
                                            <div class="col-12">
                                              <div class="row x-gap-10 y-gap-10 items-center">
                                                <div class="col-auto">
                                                  <img src="img/dashboard/right-sidebar/messages-2/2.png" alt="image">
                                                </div>
                                                <div class="col-auto">
                                                  <div class="text-15 lh-12 fw-500 text-dark-1">Albert Flores</div>
                                                </div>
                                                <div class="col-auto">
                                                  <div class="text-14 lh-1 ml-3">35 mins</div>
                                                </div>
                                              </div>
                                              <div class="bg-light-3 rounded-8 px-30 py-20 mt-15">
                                                How likely are you to recommend our company to your friends and family?
                                              </div>
                                            </div>

                                            <div class="col-12">
                                              <div class="row x-gap-10 y-gap-10 items-center justify-end">
                                                <div class="col-auto">
                                                  <div class="text-14 lh-1 mr-3">35 mins</div>
                                                </div>
                                                <div class="col-auto">
                                                  <div class="text-15 lh-12 fw-500 text-dark-1">You</div>
                                                </div>
                                                <div class="col-auto">
                                                  <img src="img/dashboard/right-sidebar/messages-2/3.png" alt="image">
                                                </div>
                                              </div>
                                              <div class="text-right bg-light-7 -dark-bg-dark-2 text-purple-1 rounded-8 px-30 py-20 mt-15">
                                                How likely are you to recommend our company to your friends and family?
                                              </div>
                                            </div>

                                            <div class="col-12">
                                              <div class="row x-gap-10 y-gap-10 items-center">
                                                <div class="col-auto">
                                                  <img src="img/dashboard/right-sidebar/messages-2/3.png" alt="image">
                                                </div>
                                                <div class="col-auto">
                                                  <div class="text-15 lh-12 fw-500 text-dark-1">Cameron Williamson</div>
                                                </div>
                                                <div class="col-auto">
                                                  <div class="text-14 lh-1 ml-3">35 mins</div>
                                                </div>
                                              </div>
                                              <div class="bg-light-3 rounded-8 px-30 py-20 mt-15">
                                                Ok, Understood!
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="mt-30 pb-20">
                                          <form class="contact-form row y-gap-20" action="https://creativelayers.net/themes/educrat-html/post">

                                            <div class="col-12">

                                              <textarea placeholder="Write a message" rows="7"></textarea>
                                            </div>

                                            <div class="col-12">
                                              <button type="submit" class="button -md -purple-1 text-white">Send Message</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                      <div data-sidebar-menu-open="<?php echo 'contacts-'.$product_id ?>" class="sidebar-menu__item -sidebar-menu">
                                        <div class="tabs -pills js-tabs">
                                          <div class="tabs__controls d-flex js-tabs-controls">

                                            <button class="tabs__button px-15 py-8 rounded-8 text-dark-1 js-tabs-button is-active" data-tab-target=".-tab-item-1" type="button">Contacts</button>

                                            <button class="tabs__button px-15 py-8 rounded-8 text-dark-1 js-tabs-button " data-tab-target=".-tab-item-2" type="button">Request</button>

                                          </div>

                                          <div class="tabs__content pt-30 js-tabs-content">

                                            <div class="tabs__pane -tab-item-1 is-active">
                                              <div class="row x-gap-10 y-gap-10 items-center">
                                                <div class="col-auto">
                                                  <img src="img/dashboard/right-sidebar/contacts/1.png" alt="image">
                                                </div>
                                                <div class="col-auto">
                                                  <div class="text-15 lh-12 fw-500 text-dark-1">Darlene Robertson</div>
                                                </div>
                                              </div>
                                            </div>

                                            <div class="tabs__pane -tab-item-2 ">
                                              <div class="row x-gap-10 y-gap-10 items-center">
                                                <div class="col-auto">
                                                  <img src="img/dashboard/right-sidebar/contacts/1.png" alt="image">
                                                </div>
                                                <div class="col-auto">
                                                  <div class="text-15 lh-12 fw-500 text-dark-1">Darlene Robertson</div>
                                                </div>
                                              </div>
                                            </div>

                                          </div>
                                        </div>
                                      </div>


                                      <div data-sidebar-menu-open="<?php echo 'settings-'.$product_id ?>" class="sidebar-menu__item -sidebar-menu">
                                        <div class="text-17 text-dark-1 fw-500">Privacy</div>
                                        <div class="text-15 mt-5">You can restrict who can message you</div>
                                        <div class="mt-30">

                                          <div class="form-radio d-flex items-center ">
                                            <div class="radio">
                                              <input type="radio">
                                              <div class="radio__mark">
                                                <div class="radio__icon"></div>
                                              </div>
                                            </div>
                                            <div class="lh-1 text-13 text-dark-1 ml-12">My contacts only</div>
                                          </div>


                                          <div class="form-radio d-flex items-center mt-15">
                                            <div class="radio">
                                              <input type="radio">
                                              <div class="radio__mark">
                                                <div class="radio__icon"></div>
                                              </div>
                                            </div>
                                            <div class="lh-1 text-13 text-dark-1 ml-12">My contacts and anyone in my courses</div>
                                          </div>


                                          <div class="form-radio d-flex items-center mt-15">
                                            <div class="radio">
                                              <input type="radio">
                                              <div class="radio__mark">
                                                <div class="radio__icon"></div>
                                              </div>
                                            </div>
                                            <div class="lh-1 text-13 text-dark-1 ml-12">Anyone on the site</div>
                                          </div>

                                        </div>

                                        <div class="text-17 text-dark-1 fw-500 mt-30 mb-30">Notification preferences</div>
                                        <div class="form-switch d-flex items-center">
                                          <div class="switch">
                                            <input type="checkbox">
                                            <span class="switch__slider"></span>
                                          </div>
                                          <div class="text-13 lh-1 text-dark-1 ml-10">Email</div>
                                        </div>

                                        <div class="text-17 text-dark-1 fw-500 mt-30 mb-30">General</div>
                                        <div class="form-switch d-flex items-center">
                                          <div class="switch">
                                            <input type="checkbox">
                                            <span class="switch__slider"></span>
                                          </div>
                                          <div class="text-13 lh-1 text-dark-1 ml-10">Use enter to send</div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </aside>

                                

                                <?php } ?>
<?php 
    include_once "adm-footer.php"; 
    include_once "adm-tail.php"; 
?>