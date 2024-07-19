<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js"></script>

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
                    
                      <form action="../api/upload_images.php" class="dropzone" id="product-images-dropzone">
                          <input type="hidden" name="productid" id="product_id" value="<?php echo $_GET['productid']; ?>">
                      </form>
                      <!-- <button type="button" id="upload-button">Upload Images</button> -->

                      <div class="row justify-end">
                          
                          <div id="error-message"></div>
                          <div class="col-auto">
                            <button class="button -md -deep-green-1 text-white" type="submit" id="upload-button">
                              Upload Product
                            </button>
                          </div>
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