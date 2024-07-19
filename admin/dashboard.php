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
    
    $pagetitle = "Dashboard";
    
    include_once "adm-head.php"; 
    include_once "adm-header.php"; 
    // include_once "../inc/drc.php"; 


    $sql = mysqli_query($conn, "SELECT * FROM bob_admin WHERE unique_id = '{$_SESSION['user_id']}'");
    $row = mysqli_fetch_assoc($sql);
    $unique_id = $row["user_id"];

    $instructor = $row["instructor"];
    $admin = $row["admin"];

?>






      <div class="content-wrapper js-content-wrapper">
        <div class="dashboard -home-9 js-dashboard-home-9">
            
          <?php include_once "adm-sidebar.php" ?>

          <div class="dashboard__main">
            <div class="dashboard__content bg-light-4">
              <div class="row pb-50 mb-10">
                <div class="col-auto">

                  <h1 class="text-30 lh-12 fw-700">Dashboard</h1>

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


              <div class="row y-gap-30">
                
                
                <div class="col-xl-3 col-md-6">
                  <div class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
                    <div>
                      <div class="lh-1 fw-500">Total Sales</div>
                      <div class="text-24 lh-1 fw-700 text-dark-1 mt-20">$10,800</div>
                      <div class="lh-1 mt-25"><span class="text-purple-1">$50</span> New Sales</div>
                    </div>

                    <i class="text-40 icon-coupon text-purple-1"></i>
                  </div>
                </div>

                <div class="col-xl-3 col-md-6">
                  <div class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
                    <div>
                      <div class="lh-1 fw-500">Total Courses</div>
                      <div class="text-24 lh-1 fw-700 text-dark-1 mt-20">3,759</div>
                      <div class="lh-1 mt-25"><span class="text-purple-1">40+</span> New Courses</div>
                    </div>

                    <i class="text-40 icon-play-button text-purple-1"></i>
                  </div>
                </div>

                <div class="col-xl-3 col-md-6">
                  <div class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
                    <div>
                      <div class="lh-1 fw-500">Total Students</div>
                      <div class="text-24 lh-1 fw-700 text-dark-1 mt-20">129,786</div>
                      <div class="lh-1 mt-25"><span class="text-purple-1">90+</span> New Students</div>
                    </div>

                    <i class="text-40 icon-graduate-cap text-purple-1"></i>
                  </div>
                </div>

                <div class="col-xl-3 col-md-6">
                  <div class="d-flex justify-between items-center py-35 px-30 rounded-16 bg-white -dark-bg-dark-1 shadow-4">
                    <div>
                      <div class="lh-1 fw-500">Total Instructor</div>
                      <div class="text-24 lh-1 fw-700 text-dark-1 mt-20">22,786</div>
                      <div class="lh-1 mt-25"><span class="text-purple-1">290+</span> Instructors</div>
                    </div>

                    <i class="text-40 icon-online-learning text-purple-1"></i>
                  </div>
                </div>

              </div>

              <div class="row y-gap-30 pt-30">
                <div class="col-xl-8 col-md-6">
                  <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                    <div class="d-flex justify-between items-center py-20 px-30 border-bottom-light">
                      <h2 class="text-17 lh-1 fw-500">Earning Statistics</h2>
                      <div class="">

                        <div class="dropdown js-dropdown js-category-active">
                          <div class="dropdown__button d-flex items-center text-14 bg-white -dark-bg-dark-1 border-light rounded-8 px-20 py-10 text-14 lh-12" data-el-toggle=".js-category-toggle" data-el-toggle-active=".js-category-active">
                            <span class="js-dropdown-title">This Week</span>
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
                    </div>
                    <div class="py-40 px-30">
                      <!-- <canvas id="lineChart"></canvas> -->
                    </div>
                  </div>
                </div>

                <div class="col-xl-4 col-md-6">
                  <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                    <div class="d-flex justify-between items-center py-20 px-30 border-bottom-light">
                      <h2 class="text-17 lh-1 fw-500">Traffic</h2>
                      <div class="">

                        <div class="dropdown js-dropdown js-category-active">
                          <div class="dropdown__button d-flex items-center text-14 bg-white -dark-bg-dark-1 border-light rounded-8 px-20 py-10 text-14 lh-12" data-el-toggle=".js-category-toggle" data-el-toggle-active=".js-category-active">
                            <span class="js-dropdown-title">This Week</span>
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
                    </div>
                    <div class="py-40 px-30">
                      <!-- <canvas id="pieChart"></canvas> -->
                    </div>
                  </div>
                </div>
              </div>

              <div class="row y-gap-30 pt-30">
                <div class="col-xl-4 col-md-6">
                  <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                    <div class="d-flex justify-between items-center py-20 px-30 border-bottom-light">
                      <h2 class="text-17 fw-500">Popular Instructor</h2>
                      <a href="instructors-list-2.html" class="text-14 text-purple-1 underline">View All</a>
                    </div>
                    <div class="py-30 px-30">
                      <div class="y-gap-40">

                        <div class="d-flex ">
                          <img class="size-40" src="../assets/img/dashboard/avatars/1.png" alt="avatar">
                          <div class="ml-10 w-1/1">
                            <h4 class="text-15 lh-1 fw-500">Marvin McKinney</h4>
                            <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                              <div class="d-flex items-center">
                                <i class="icon-message text-15 mr-10"></i>
                                <div class="text-13 lh-1">23,987 Reviews</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-online-learning text-15 mr-10"></i>
                                <div class="text-13 lh-1">692 Students</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-play text-15 mr-10"></i>
                                <div class="text-13 lh-1">15 Course</div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="d-flex border-top-light">
                          <img class="size-40" src="../assets/img/dashboard/avatars/2.png" alt="avatar">
                          <div class="ml-10 w-1/1">
                            <h4 class="text-15 lh-1 fw-500">Albert Flores</h4>
                            <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                              <div class="d-flex items-center">
                                <i class="icon-message text-15 mr-10"></i>
                                <div class="text-13 lh-1">23,987 Reviews</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-online-learning text-15 mr-10"></i>
                                <div class="text-13 lh-1">692 Students</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-play text-15 mr-10"></i>
                                <div class="text-13 lh-1">15 Course</div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="d-flex border-top-light">
                          <img class="size-40" src="../assets/img/dashboard/avatars/3.png" alt="avatar">
                          <div class="ml-10 w-1/1">
                            <h4 class="text-15 lh-1 fw-500">Savannah Nguyen</h4>
                            <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                              <div class="d-flex items-center">
                                <i class="icon-message text-15 mr-10"></i>
                                <div class="text-13 lh-1">23,987 Reviews</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-online-learning text-15 mr-10"></i>
                                <div class="text-13 lh-1">692 Students</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-play text-15 mr-10"></i>
                                <div class="text-13 lh-1">15 Course</div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="d-flex border-top-light">
                          <img class="size-40" src="../assets/img/dashboard/avatars/4.png" alt="avatar">
                          <div class="ml-10 w-1/1">
                            <h4 class="text-15 lh-1 fw-500">Guy Hawkins</h4>
                            <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                              <div class="d-flex items-center">
                                <i class="icon-message text-15 mr-10"></i>
                                <div class="text-13 lh-1">23,987 Reviews</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-online-learning text-15 mr-10"></i>
                                <div class="text-13 lh-1">692 Students</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-play text-15 mr-10"></i>
                                <div class="text-13 lh-1">15 Course</div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="d-flex border-top-light">
                          <img class="size-40" src="../assets/img/dashboard/avatars/5.png" alt="avatar">
                          <div class="ml-10 w-1/1">
                            <h4 class="text-15 lh-1 fw-500">Guy Hawkins</h4>
                            <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                              <div class="d-flex items-center">
                                <i class="icon-message text-15 mr-10"></i>
                                <div class="text-13 lh-1">23,987 Reviews</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-online-learning text-15 mr-10"></i>
                                <div class="text-13 lh-1">692 Students</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-play text-15 mr-10"></i>
                                <div class="text-13 lh-1">15 Course</div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-4 col-md-6">
                  <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                    <div class="d-flex justify-between items-center py-20 px-30 border-bottom-light">
                      <h2 class="text-17 lh-1 fw-500">Recent Courses</h2>
                      <a href="#" class="text-14 text-purple-1 underline">View All</a>
                    </div>
                    <div class="py-30 px-30">
                      <div class="y-gap-40">

                        <div class="d-flex ">
                          <div class="shrink-0">
                            <img src="../assets/img/dashboard/recent-courses/1.png" alt="image">
                          </div>
                          <div class="ml-15">
                            <h4 class="text-15 lh-16 fw-500">Complete Python Bootcamp From Zero to Hero in Python</h4>
                            <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                              <div class="d-flex items-center">
                                <img class="size-16 object-cover mr-8" src="../assets/img/general/avatar-1.png" alt="icon">
                                <div class="text-14 lh-1">Ali Tufan</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-document text-16 mr-8"></i>
                                <div class="text-14 lh-1">6 lesson</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-clock-2 text-16 mr-8"></i>
                                <div class="text-14 lh-1">3h 56m</div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="d-flex border-top-light">
                          <div class="shrink-0">
                            <img src="../assets/img/dashboard/recent-courses/2.png" alt="image">
                          </div>
                          <div class="ml-15">
                            <h4 class="text-15 lh-16 fw-500">The Ultimate Drawing Course Beginner to Advanced</h4>
                            <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                              <div class="d-flex items-center">
                                <img class="size-16 object-cover mr-8" src="../assets/img/general/avatar-1.png" alt="icon">
                                <div class="text-14 lh-1">Ali Tufan</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-document text-16 mr-8"></i>
                                <div class="text-14 lh-1">6 lesson</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-clock-2 text-16 mr-8"></i>
                                <div class="text-14 lh-1">3h 56m</div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="d-flex border-top-light">
                          <div class="shrink-0">
                            <img src="../assets/img/dashboard/recent-courses/3.png" alt="image">
                          </div>
                          <div class="ml-15">
                            <h4 class="text-15 lh-16 fw-500">Instagram Marketing 2021: Complete Guide To Instagram Growth</h4>
                            <div class="d-flex items-center x-gap-20 y-gap-10 flex-wrap pt-10">
                              <div class="d-flex items-center">
                                <img class="size-16 object-cover mr-8" src="../assets/img/general/avatar-1.png" alt="icon">
                                <div class="text-14 lh-1">Ali Tufan</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-document text-16 mr-8"></i>
                                <div class="text-14 lh-1">6 lesson</div>
                              </div>
                              <div class="d-flex items-center">
                                <i class="icon-clock-2 text-16 mr-8"></i>
                                <div class="text-14 lh-1">3h 56m</div>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-xl-4 col-md-6">
                  <div class="rounded-16 bg-white -dark-bg-dark-1 shadow-4 h-100">
                    <div class="d-flex justify-between items-center py-20 px-30 border-bottom-light">
                      <h2 class="text-17 lh-1 fw-500">Notifications</h2>
                    </div>
                    <div class="py-30 px-30">
                      <div class="y-gap-40">

                        <div class="d-flex items-center ">
                          <div class="shrink-0">
                            <img src="../assets/img/dashboard/actions/1.png" alt="image">
                          </div>
                          <div class="ml-12">
                            <h4 class="text-15 lh-1 fw-500">Your resume updated!</h4>
                            <div class="text-13 lh-1 mt-10">1 Hours Ago</div>
                          </div>
                        </div>

                        <div class="d-flex items-center border-top-light">
                          <div class="shrink-0">
                            <img src="../assets/img/dashboard/actions/2.png" alt="image">
                          </div>
                          <div class="ml-12">
                            <h4 class="text-15 lh-1 fw-500">You changed password</h4>
                            <div class="text-13 lh-1 mt-10">1 Hours Ago</div>
                          </div>
                        </div>

                        <div class="d-flex items-center border-top-light">
                          <div class="shrink-0">
                            <img src="../assets/img/dashboard/actions/3.png" alt="image">
                          </div>
                          <div class="ml-12">
                            <h4 class="text-15 lh-1 fw-500">Your account has been created successfully</h4>
                            <div class="text-13 lh-1 mt-10">1 Hours Ago</div>
                          </div>
                        </div>

                        <div class="d-flex items-center border-top-light">
                          <div class="shrink-0">
                            <img src="../assets/img/dashboard/actions/4.png" alt="image">
                          </div>
                          <div class="ml-12">
                            <h4 class="text-15 lh-1 fw-500">You applied for a job Front-end Developer</h4>
                            <div class="text-13 lh-1 mt-10">1 Hours Ago</div>
                          </div>
                        </div>

                        <div class="d-flex items-center border-top-light">
                          <div class="shrink-0">
                            <img src="../assets/img/dashboard/actions/5.png" alt="image">
                          </div>
                          <div class="ml-12">
                            <h4 class="text-15 lh-1 fw-500">Your course uploaded successfully</h4>
                            <div class="text-13 lh-1 mt-10">1 Hours Ago</div>
                          </div>
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