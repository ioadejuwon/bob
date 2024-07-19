<?php 
    session_start();
    

    include_once "../inc/config.php"; 
    include_once "../inc/drc.php"; 

    

    if(!isset($_SESSION['unique_id'])){
        header("location: ".LOGIN."?url=".$current_url."&t=".$pagetitle);// redirect to login page if not signed in
        exit; // Make sure to exit after sending the redirection header
    }else{
        $unique_id = $_SESSION['unique_id'];
        
    }
    
    $pagetitle = "Dashboard";
    
    include_once "dash-head.php"; 
    include_once "dash-header.php"; 
    // include_once "../inc/drc.php"; 


    $sql = mysqli_query($conn, "SELECT * FROM tera_users WHERE unique_id = '{$_SESSION['unique_id']}'");
    $row = mysqli_fetch_assoc($sql);
    $unique_id = $row["unique_id"];

    $instructor = $row["instructor"];
    $admin = $row["admin"];

?>






      <div class="content-wrapper js-content-wrapper">
        <div class="dashboard -home-9 js-dashboard-home-9">
            
          <?php include_once "dash-sidebar.php" ?>

          <div class="dashboard__main">
          <div class="dashboard__content bg-light-4">
              <div class="row pb-50 mb-10">
                <div class="col-auto">

                  <h1 class="text-30 lh-12 fw-700">Create New Course</h1>
                  
                  <div class="breadcrumbs mt-10 pt-0 pb-0">
                    <div class="breadcrumbs__content">
                      <div class="breadcrumbs__item">
                        <a href="index.html">Home</a>
                      </div>
                      <div class="breadcrumbs__item">
                        <a href="<?php DASHBOARD ?>">Dashboard</a>
                      </div>
                      
                    </div>
                  </div>

                </div>
              </div>


              <div class="row y-gap-60">

                <div class="col-12">
                  <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                    <div class="d-flex items-center py-20 px-30 border-bottom-light">
                      <h2 class="text-17 lh-1 fw-500">Media</h2>
                    </div>

                    <div class="py-30 px-30">
                      <div class="row y-gap-50">
                        <div class="col-12">
                          <form class="contact-form d-flex lg:flex-column">
                            <div class="relative shrink-0">
                              <img class="w-1/1" src="../assets/img/dashboard/media/1.png" alt="image">

                              <div class="absolute-full-center d-flex justify-end py-20 px-20">
                                <a href="#" class="d-flex justify-center items-center bg-white size-40 rounded-8 shadow-1">
                                  <i class="icon-bin text-16"></i>
                                </a>
                              </div>
                            </div>

                            <div class="w-1/1 ml-30 lg:ml-0 lg:mt-20">

                              <div class="form-upload col-12">
                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Course thumbnail*</label>
                                <div class="form-upload__wrap">
                                  <input type="text" name="name" placeholder="Cover-1.html">
                                  <button class="button -dark-3 text-white">Upload Files</button>
                                </div>
                              </div>

                              <p class="mt-10">Upload your course image here. It must meet our course image quality standards to be accepted. Important guidelines: 750x440 pixels; .jpg, .jpeg,. gif, or .png. no text on the image.</p>
                            </div>
                          </form>
                        </div>

                        <div class="col-12">
                          <form class="contact-form d-flex lg:flex-column">
                            <div class="relative shrink-0">
                              <img class="w-1/1" src="../assets/img/dashboard/media/2.png" alt="image">

                              <div class="absolute-full-center d-flex justify-end py-20 px-20">
                                <a href="#" class="d-flex justify-center items-center bg-white size-40 rounded-8 shadow-1">
                                  <i class="icon-bin text-16"></i>
                                </a>
                              </div>
                            </div>

                            <div class="w-1/1 ml-30 lg:ml-0 lg:mt-20">

                              <div class="form-upload col-12">
                                <label class="text-16 lh-1 fw-500 text-dark-1 mb-10">Video URL*</label>
                                <div class="form-upload__wrap">
                                  <input type="text" name="name" placeholder="Video-1.html">
                                  <button class="button -dark-3 text-white">Upload Files</button>
                                </div>
                              </div>

                              <p class="mt-10">Enter a valid video URL. Students who watch a well-made promo video are 5X more likely to enroll in your course.</p>
                            </div>
                          </form>
                        </div>
                      </div>

                      <div class="row y-gap-20 justify-between pt-30">
                        <div class="col-auto">
                          <button class="button -md -outline-terabyte-1 text-terabyte-1">Prev</button>
                        </div>

                        <div class="col-auto">
                          <button class="button -md -terabyte-1 text-white">Next</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>



    

            
<?php 
    include_once "dash-footer.php"; 
    include_once "dash-tail.php"; 
?>