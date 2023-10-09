<?php
	date_default_timezone_set("Etc/GMT+8");
	require_once'./dashboard/session.php';
	require_once'./dashboard/class.php';
	$db=new db_class(); 
if (isset($_GET['contact_no'])){
  $contact_no = $_GET['contact_no'];
}else{
  $contact_no ='';
}
if (isset($_GET['status'])){
  $status = $_GET['status'];
  echo "<script type='text/javascript'>alert('Registration '+'$status');</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Apply Loan</title>
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
  <link href="dashboard/css/sb-admin-2.css" rel="stylesheet">
    
    <!-- Custom styles for this page -->
      <link href="dashboard/css/dataTables.bootstrap4.css" rel="stylesheet">
      <link href="dashboard/css/select2.css" rel="stylesheet">

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
        <h1>Append</h1>
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
            <li class="current">Loan</li>
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
                <h4>Loan Application</h4>
                <form action=".\dashboard\save_loan.php" method="POST">
                  <div class="row">
                    <div class="col-md-6 form-group">
                    <label>Borrower</label>
                    <br/>
                    <input type="hidden" value="<?php echo $fetch['loan_id']?>" name="loan_id"/>
                    <select name="borrower" class="form-control borrow" required="required" style="width:100%;">
                        <?php
                              $tbl_borrower=$db->get_borrower($contact_no);
                              while($fetch=$tbl_borrower->fetch_array()){
                        ?>
                          <option value="<?php echo $fetch['borrower_id']?>"><?php echo $fetch['lastname'].", ".$fetch['firstname']." ".substr($fetch['middlename'], 0, 1)?>.</option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-6 form-group">
                      <label>Loan type</label>
                      <br />
                      <select name="ltype" class="form-control loan" required="required" style="width:100%;">
                        <?php
                          $tbl_ltype=$db->display_ltype();
                          while($fetch=$tbl_ltype->fetch_array()){
                        ?>
                          <option value="<?php echo $fetch['ltype_id']?>"><?php echo $fetch['ltype_name']?></option>
                        <?php
                          }
                        ?>
                      </select>
                      </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Loan Plan</label>
                        <select name="lplan" class="form-control" required="required" id="lplan">
                            <option value="">Please select an option</option>
                          <?php
                            $tbl_lplan=$db->display_lplan();
                            while($fetch=$tbl_lplan->fetch_array()){
                          ?>
                            <option value="<?php echo $fetch['lplan_id']?>"><?php echo $fetch['lplan_month']." months[".$fetch['lplan_interest']."%, ".$fetch['lplan_penalty']."%]"?></option>
                          <?php
                            }
                          ?>
                        </select>
                        <label>Months[Interest%, Penalty%]</label>
                      </div>
                    <div class="col-md-6 form-group">
                      <label>Loan Amount</label>
                      <input type="number" name="loan_amount" class="form-control" id="amount" required="required"/>
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-xl-6 col-md-6">
                      <label>Purpose</label>
                      <textarea name="purpose" class="form-control" style="resize:none; height:100px;" required="required"></textarea>
                    </div>
                    <div class="form-group col-xl-6 col-md-6">
                      <label>.</label>
                      <button type="button" class="btn btn-primary btn-block" id="calculate">Calculate Amount</button>
                    </div>
                  </div>
                  <hr>
                  <div class="row" id="calcTable">
                    <div class="col-xl-4 col-md-4">
                      <center><span>Total Payable Amount</span></center>
                      <center><span id="tpa"></span></center>
                    </div>
                    <div class="col-xl-4 col-md-4">
                      <center><span>Monthly Payable Amount</span></center>
                      <center><span id="mpa"></span></center>
                    </div>
                    <div class="col-xl-4 col-md-4">
                      <center><span>Penalty Amount</span></center>
                      <center><span id="pa"></span></center>
                    </div>
                  </div>
              

                  <div class="text-center">
                    <button type="submit" name="apply" class="btn btn-primary">Apply</button>
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
        <span>Loan Sasa</span>
      </a>
      <p>
        Your financial well-being is our top priority. Join the thousands of satisfied customers who have already experienced the difference with Loan Sasa. Discover a partner you can trust, and let us help you achieve your financial goals.
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
  <p>&copy; <span>Copyright</span> <strong class="px-1">Loan Sasa</strong> <span>All Rights Reserved</span></p>
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
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="dashboard/js/jquery.easing.js"></script>
  <script src="dashboard/js/select2.js"></script>
  <script>
		
		$(document).ready(function() {
			$("#calcTable").hide();
			
			
			$('.borrow').select2({
				placeholder: 'Select an option'
			});
			
			$('.loan').select2({
				placeholder: 'Select an option'
			});
			
			
			
			$("#calculate").click(function(){
				if($("#lplan").val() == "" || $("#amount").val() == ""){
					alert("Please enter a Loan Plan or Amount to Calculate")
				}else{
					var lplan=$("#lplan option:selected").text();
					var months=parseFloat(lplan.split('months')[0]);
					var splitter=lplan.split('months')[1];
					var findinterest=splitter.split('%')[0];
					var interest=parseFloat(findinterest.replace(/[^0-9.]/g, ""));
					var findpenalty=splitter.split('%')[1];
					var penalty=parseFloat(findpenalty.replace(/[^0-9.]/g, ""));
					
					var amount=parseFloat($("#amount").val());
					
					var monthly =(amount + (amount * (interest/100))) / months;
					var penalty=monthly * (penalty/100);
					var totalAmount=amount+monthly;
					
					
					
					$("#tpa").text("\u20B1 "+totalAmount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2}));
					$("#mpa").text("\u20B1 "+monthly.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2}));
					$("#pa").text("\u20B1 "+penalty.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2}));
					
					$("#calcTable").show();
				}
				
			});
			
			
			$("#updateCalculate").click(function(){
				if($("#ulplan").val() == "" || $("#uamount").val() == ""){
					alert("Please enter a Loan Plan or Amount to Calculate")
				}else{
					var lplan=$("#ulplan option:selected").text();
					var months=parseFloat(lplan.split('months')[0]);
					var splitter=lplan.split('months')[1];
					var findinterest=splitter.split('%')[0];
					var interest=parseFloat(findinterest.replace(/[^0-9.]/g, ""));
					var findpenalty=splitter.split('%')[1];
					var penalty=parseFloat(findpenalty.replace(/[^0-9.]/g, ""));
					
					var amount=parseFloat($("#uamount").val());
					
					var monthly =(amount + (amount * (interest/100))) / months;
					var penalty=monthly * (penalty/100);
					var totalAmount=amount+monthly;
					
					
					
					$("#utpa").text("\u20B1 "+totalAmount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2}));
					$("#umpa").text("\u20B1 "+monthly.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2}));
					$("#upa").text("\u20B1 "+penalty.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2}));
					

				}
				
			});
			
			$('#dataTable').DataTable();
		});
	</script>


</body>

</html>