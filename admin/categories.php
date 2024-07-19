<script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuid.min.js"></script>

<?php 
    session_start();
    

    include_once "../inc/config.php"; 
    include_once "../inc/drc.php"; 

    

    if(!isset($_SESSION['user_id'])){
        header("location: ".ADMIN_LOGIN."?url=".$current_url."&t=".$pagetitle);// redirect to login page if not signed in
        exit; // Make sure to exit after sending the redirection header
    }else{
        $unique_id = $_SESSION['user_id'];
        
    }
    
    $pagetitle = "Categories";
    
    include_once "adm-head.php"; 
    include_once "adm-header.php"; 

    $sql = mysqli_query($conn, "SELECT * FROM bob_admin WHERE user_id = '{$_SESSION['user_id']}'");
    $row = mysqli_fetch_assoc($sql);
    $user_id = $row["user_id"];
  
    $fname = $row['fname'];

    $categories = mysqli_query($conn, "SELECT * FROM bob_categories");
    

?>






      <div class="content-wrapper js-content-wrapper">
        <div class="dashboard -home-9 js-dashboard-home-9">
            
          <?php include_once "adm-sidebar.php" ?>

          <div class="dashboard__main">
            <div class="dashboard__content bg-light-4">
              <div class="row pb-50 mb-10">
                <div class="col-auto">

                  <h1 class="text-30 lh-12 fw-700">Course Categories</h1>

                  <div class="breadcrumbs mt-10 pt-0 pb-0">
                    <div class="breadcrumbs__content">
                      <div class="breadcrumbs__item">
                        <a href="index.html">Home</a>
                      </div>
                      <div class="breadcrumbs__item">
                        <a href="<?php CATEGORIES ?>">Categories</a>
                      </div>
                      <div class="breadcrumbs__item">
                        <a href="<?php DASHBOARD ?>">Dashboard</a>
                      </div>
                      
                    </div>
                  </div>
                  

                </div>
              </div>

              

              <div class="row y-gap-30 pt-30">
                <div class="col-xl-12 col-md-12">
                  <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                    <div class="d-flex items-center py-20 px-30 border-bottom-light">
                      <h2 class="text-17 lh-1 fw-500">Add Product Category</h2>
                    </div>
                    <div class="py-30 px-30">
                        <form class="contact-form row y-gap-30" id="categoryForm" method="POST">
                          <h4 class="text-16 lh-1 fw-500 text-dark-1">Category Name <span class="text-error-1">*</span> </h4>
                          <!-- <div id="error-message"></div> -->
                          <div class="col-md-9 col-12" id="error-message">
                              <input type="text" name="categoryname" id="category" placeholder="Enter the name of the category" required>
                          </div>
                          <div class="col-md-3 col-12">

                              <button class="button -md -deep-green-1 text-white" type="submit" id="submit">
                                  Add Category
                              </button>
                          </div>
                      </form>
                      
                    </div>
                    
                  </div>
                </div>
              </div>
              



              <div class="row y-gap-30 pt-30">
                <div class="col-xl-12 col-md-12">
                  <div class="rounded-16 text-white shadow-4 h-100">
                    <!-- <div class="text-18 lh-1 text-dark-1 fw-500 mb-30">Table</div> -->
                    <table class="table w-1/1">
                      <thead>
                        <tr>
                          <th>Category Name</th>
                          <th>No. of Products</th>
                          <!-- <th>Quantity</th>  -->
                        </tr>
                      </thead>
                      <tbody id="categoryTableBody">
                        <?php

                          while ($row_categories = mysqli_fetch_assoc($categories)) {
                            $categoryname = $row_categories['categoryName'];
                            $category_id = $row_categories['categoryid'];


                            $products_cat = mysqli_query($conn, "SELECT * FROM products WHERE productcategory = '$category_id'");
                            // while ($prod_categories = mysqli_fetch_assoc($products_cat)) {
                              // $prod_categories = mysqli_fetch_assoc($products_cat);
                              $count_row_store = mysqli_num_rows($products_cat);
                        ?>
                        <tr>
                          <td><?php echo $categoryname?></td>
                          <td><?php echo $count_row_store ?></td>
                          <!-- <td>3</td> -->
                        </tr>

                        <?php
                          }
                        ?>

                      </tbody>
                    </table>


                  </div>
                </div>
              </div>


              

            </div>



    

            
<?php 
    include_once "adm-footer.php"; 
    include_once "adm-tail.php"; 
?>