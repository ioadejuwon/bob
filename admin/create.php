<?php 
    session_start();
    

    include_once "../inc/config.php"; 
    $pagetitle = "Add New Course";
    include_once "../inc/drc.php"; 

    

    if(!isset($_SESSION['user_id'])){
      header("location: ".ADMIN_LOGIN."?url=".$current_url."&t=".$pagetitle);// redirect to login page if not signed in
      exit; // Make sure to exit after sending the redirection header
    }else{
        $user_id = $_SESSION['user_id'];
        
    }
  
  $pagetitle = "Add New Product";
  
  include_once "adm-head.php"; 
  include_once "adm-header.php"; 


    // include_once "../inc/add-course.php"; 


    $sql = mysqli_query($conn, "SELECT * FROM bob_admin WHERE user_id = '{$_SESSION['user_id']}'");
    $row = mysqli_fetch_assoc($sql);
    $user_id = $row["user_id"];

    $fname = $row['fname'];

    $categories = mysqli_query($conn, "SELECT * FROM bob_categories");

?>







            
          <?php include_once "adm-sidebar.php" ?>


          <div class="dashboard__content bg-light-4">
              <div class="row pb-50 mb-10">
                <div class="col-auto">

                  <h1 class="text-30 lh-12 fw-700">Add New Product</h1>
                  <div class="mt-10">You can enter the product information here.</div>

                </div>
              </div>

              <div class="row y-gap-60">
                <div class="col-12">
                  <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                    <div class="d-flex items-center py-20 px-30 border-bottom-light">
                      <h2 class="text-17 lh-1 fw-500">Product Information</h2>
                    </div>
                  

                    <div class="py-30 px-30">

                    <form id="product-details-form" class="contact-form row y-gap-30">
                        <div class="col-12">
                            <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Product Name<span class="text-red-1">*</span></label>
                            <input type="text" name="producttitle" value="<?php echo $producttitle ?>" placeholder="Enter the title of the course" required>
                            <input type="hidden" name="user_id" value="<?php echo $user_id ?>" placeholder="">
                        </div>
                        
                        <div class="col-md-6">
                            <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Available Quantity <span class="text-red-1">*</span></label>
                            <input type="number" name="qty" value="<?php echo $qty ?>" placeholder="Enter Available Qty." required>
                        </div>

                        <div class="col-md-6">
                            <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Course category <span class="text-red-1">*</span></label>
                            <select class="selectize wide js-selectize" name="productcategory" value="<?php echo $coursecategory ?>" required>
                                <option value="none">Choose category</option>
                                <?php
                                    while ($row_categories = mysqli_fetch_assoc($categories)) {
                                        $categoryname = $row_categories['categoryName'];
                                        $category_id = $row_categories["categoryid"];
                                ?>
                                <option value="<?php echo $category_id ?>"><?php echo $categoryname ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Product Price <span class="text-red-1">*</span></label>
                            <input type="number" name="price" value="<?php echo $qty ?>" placeholder="Amount the customer pays" required>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Discount Price <span class="text-red-1">*</span></label>
                            <input type="number" name="discount_price" value="<?php echo $qty ?>" placeholder="Usually the higher amount">
                        </div>

                        <div class="col-12">
                            <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Short Description <span class="text-red-1">*</span></label>
                            <textarea placeholder="Short Description" rows="4" name="shortdescription" value="<?php echo $shortdescription ?>" required></textarea>
                        </div>

                        <div class="col-12">
                            <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Product Description <span class="text-red-1">*</span></label>
                            <textarea placeholder="You can make this one longer" rows="7" name="productdescription" value="<?php echo $productdescription ?>" required></textarea>
                        </div>

                        <div class="row y-gap-20 justify-between pt-15">
                            
                            <div id="error-message" class="col-12 text-red-1">

                            </div> 

                            <div class="col-auto">
                                <a href="<?php echo PRODUCTS ?>" class="button -md -outline-deep-green-1 text-deep-green-1">

                                        <i class="text-20 fa-solid fa-angle-left"></i> &nbsp; Prev

                                </a>
                            </div>

                              <div class="col-auto">
                                  <button class="button -md -deep-green-1 text-white" type="submit" id="productFormSubmit">
                                      Next &nbsp; <i class="text-20 fa-solid fa-angle-right"></i>
                                  </button>
                              </div>
                          </div>
                      </form>

                      
                    </div>
                  </div>
                </div>
              </div>

            </div>



    

            
<?php 
    include_once "adm-footer.php"; 
    include_once "adm-tail.php"; 
?>