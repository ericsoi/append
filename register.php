<?php
if (isset($_GET['phone_number'])){
  $phone_number = $_GET['phone_number'];
}else{
  $phone_number ='';
}
if (isset($_GET['status'])){
  $status = $_GET['status'];
  $message =  $_GET['message'];
  echo "<script type='text/javascript'>alert('Registration '+'$status $message');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Append
  * Updated: Sep 18 2023 with Bootstrap v5.3.2
  * Template URL: https://bootstrapmade.com/append-bootstrap-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="blog-details-page" data-bs-spy="scroll" data-bs-target="#navmenu">

  <!-- ======= Header ======= -->
  <header id="header" class="header sticky-top d-flex align-items-center">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.png" alt=""> -->
        <h1>Matrick Credit</h1>
        <span>.</span>
      </a>

      <!-- Nav Menu -->
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html#hero" class="active">Home</a></li>
          <li><a href="index.html#about">About</a></li>
          <li><a href="index.html#packages">Packages</a></li>
          <li><a href="index.html#team">Team</a></li>

          <li><a href="dashboard/">Dashboard</a></li>
        </ul>

        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav><!-- End Nav Menu -->

      <a class="btn-getstarted" href="index.html#about">Get Started</a>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- Blog Details Page Title & Breadcrumbs -->
    <div data-aos="fade" class="page-title">
      
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Register</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Blog-details Section - Blog Details Page -->
    <section id="blog-details" class="blog-details">

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row g-1">
          <div class="col-lg-8">
            <div class="comments">
              <div class="reply-form">
                <h4>Registration</h4>
                <p>Your Contact information will not be published. Required fields are marked * </p>
                <form action=".\processing\register.php" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 form-group">
                    <input name="firstname" type="text" class="form-control" <?php if(isset($_GET['firstname'])) { echo 'value="' . $_GET['firstname'] . '"'; } ?> placeholder="First Name*" required/>
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="middlename" type="text" class="form-control" <?php if(isset($_GET['middlename'])) { echo 'value="' . $_GET['middlename'] . '"'; } ?>  placeholder="Middle Name*" required/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 form-group">
                      <input name="lastname" type="text" class="form-control" <?php if(isset($_GET['lastname'])) { echo 'value="' . $_GET['lastname'] . '"'; } ?>  placeholder="Last Name*" required/>
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="email" type="text" class="form-control"<?php if(isset($_GET['second_number'])) { echo 'value="' . $_GET['second_number'] . '"'; } ?>  placeholder="Second Number"/>
                    </div>
                  </div>
                  <div class="row">
                   <div class="col-md-6 form-group">
                      <input name="address" type="text" class="form-control" <?php if(isset($_GET['address'])) { echo 'value="' . $_GET['address'] . '"'; } ?> placeholder="Plot Name - Floor No - House No*" required/>
                    </div>
                    <div class="col-md-6 form-group">
                      <input name="tax_id" type="text" class="form-control" <?php if(isset($_GET['tax_id'])) { echo 'value="' . $_GET['tax_id'] . '"'; } ?> placeholder="Id Number*" required/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 form-group">
                    <label>Upload Front Id</label>
                      <input name="id_doc" type="file" class="form-control" placeholder="Upload Id" accept="image/*" required/>
                    </div>
                    <div class="col-md-4 form-group">
                    <label>Upload Back Id</label>
                      <input name="id_doc_back" type="file" class="form-control" placeholder="Upload Id" accept="image/*" required/>
                    </div>
                    <div class="col-md-4 form-group">
                      <label>Upload KRA Doc</label>
                      <input name="signature_doc" type="file" class="form-control" placeholder="Upload KRA" accept="image/*"/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group">
                      <input name="contact_no" type="text" class="form-control" placeholder="Phone Number" value="<?php echo $phone_number?>" readonly>
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" name="save" class="btn btn-primary">Register</button>
                  </div>

                </form>

              </div>

            </div><!-- End blog comments -->

          </div>



        </div>

      </div>

    </section><!-- End Blog-details Section -->

  </main>

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

<div class="container footer-top">
  <div class="row gy-4">
    <div class="col-lg-5 col-md-12 footer-about">
      <a href="index.html" class="logo d-flex align-items-center">
        <span>Matrick Credit</span>
      </a>
      <p>
        Your financial well-being is our top priority. Join the thousands of satisfied customers who have already experienced the difference with Matrick Credit. Discover a partner you can trust, and let us help you achieve your financial goals.
      </p>
      <div class="social-links d-flex mt-4">
        <a href=""><i class="bi bi-twitter"></i></a>
        <a href=""><i class="bi bi-facebook"></i></a>
        <a href=""><i class="bi bi-instagram"></i></a>
        <a href=""><i class="bi bi-linkedin"></i></a>
      </div>
    </div>

    <div class="col-lg-2 col-6 footer-links">
      <h4>Useful Links</h4>
      <ul>
        <li><a href="#">Home</a></li>
        <li><a href="#">About us</a></li>
        <li><a href="#">Products</a></li>
        <li><a href="#">Terms of service</a></li>
        <li><a href="#">Privacy policy</a></li>
      </ul>
    </div>

   

    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
      <h4>Contact Us</h4>
      <p>Embakasi</p>
      <p>Nairobi</p>
      <p>Kenya</p>
      <p class="mt-4"><strong>Phone:</strong> <span>+07123456789</span></p>
      <p><strong>Email:</strong> <span>info@example.com</span></p>
    </div>

  </div>
</div>

<div class="container copyright text-center mt-4">
  <p>&copy; <span>Copyright</span> <strong class="px-1">Matrick Credit</strong> <span>All Rights Reserved</span></p>
  <div class="credits">
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you've purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
    Designed by <a href="#">Erick Soi</a>
  </div>
</div>

</footer><!-- End Footer -->

  <!-- Scroll Top Button -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
  </div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>