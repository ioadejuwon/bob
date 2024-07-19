<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>


<style>
.dz-message{
    /* padding: 3rem 1rem; */
}
.dropzone-previews{

/* f:d; */
}
.dz-errormessage{
    background-color: #fff;
}
</style>
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






      <div class="content-wrapper js-content-wrapper">
        <div class="dashboard -home-9 js-dashboard-home-9">
            
          <?php include_once "adm-sidebar.php" ?>

          <div class="dashboard__main">
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
                      <form action="#"  class="dropzone bg-transparent border-0 contact-form row y-gap-30" id="my-dropzone"  enctype="multipart/form-data">

                        <div class="col-12">
                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Product Name<span class="text-red-1">*</span> </label>
                          <input type="text" name="producttitle" value="<?php echo $producttitle ?>" placeholder="Enter the title of the course">
                          <input type="hidden" name="user_id" value="<?php echo $user_id ?>" placeholder="">
                        </div>
                        
                        <div class="col-md-6">
                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Available Quantity  <span class="text-red-1">*</span></label>
                          <input  type="number" name="qty" value="<?php echo $qty ?>" placeholder="Enter Available Qty.">
                        </div>


                        <div class="col-md-6">
                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Course category <span class="text-red-1">*</span></label>

                          <select class="selectize wide js-selectize" name="productcategory" value="<?php echo $coursecategory ?>">
                            <option value="">Choose category</option>
                            <?php
                                while ($row_categories = mysqli_fetch_assoc($categories)) {
                                  $categoryname = $row_categories['categoryName'];
                                  $category_id = $row_categories["categoryid"];
                              ?>
                              <tr>
                                <option value="<?php echo $category_id?>"><?php echo $categoryname?></option>

                              <?php
                                }
                              ?>
                          </select>

                        </div>

                        <div class="col-md-6">
                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Product Price  <span class="text-red-1">*</span></label>
                          <input  type="number" name="price" value="<?php echo $qty ?>" placeholder="Enter Price">
                        </div>
                        <div class="col-md-6">
                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Discount Price  <span class="text-red-1">*</span></label>
                          <input  type="number" name="discount_price" value="<?php echo $qty ?>" placeholder="Enter Discount Price">
                        </div>
                   


                        <div class="col-12">

                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Product Description  <span class="text-red-1">*</span></label>

                          <textarea placeholder="Description" rows="7" name="productdescription" value="<?php echo $productdescription ?>"></textarea>
                        </div>


                        <div class="col-12">
                          <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Product Images <span class="text-red-1">*</span></label>
                          <div class="dropzone-previews" > </div>
                            <div class="rounded-2" style="border:1px dotted ; color: #95aac9;">
                                <div class="dz-default dz-message">Upload your product images here</div>
                            </div>
                            <div class="form-text text-muted mt-4 ">Max file size is 3MB and max number of files is 5.</div>
                            <div id="pimageError" class="form-text error-message text-danger"></div>

                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </div>

                        <div class="row y-gap-20 justify-between pt-15">
                          
                          <div id="error-message"></div>

                          <div class="col-auto">
                            <!-- <i class="text-20 fa- mr-15"></i> -->
                            
                            <a href="#">
                            <button class="button -md -outline-deep-green-1 text-deep-green-1">
                              <i class="text-20 fa-solid fa-angle-left"></i>&nbsp;
                              Prev
                            </button>
                            </a>
                          </div>

                          <div class="col-auto">
                            <button class="button -md -deep-green-1 text-white" type="submit" id="submit">
                              Next
                              &nbsp;
                              <i class="text-20 fa-solid fa-angle-right"></i>
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