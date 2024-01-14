<?php
	// date_default_timezone_set("Etc/GMT+8");
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
  if ($status == 'success'){
    echo "<script type='text/javascript'>alert('Registration '+'$status');</script>";
  }
  if ($status == 'exists'){
    echo "<script type='text/javascript'>alert('User '+'$status' + '. Apply');</script>";
  }
  if ($status == 'applied'){
    echo "<script type='text/javascript'>alert('Request '+'$status' + '. Pending approval and disbursment');</script>";
  }
  if ($status == 'error'){
    $message = $_GET["message"];
    echo "<script type='text/javascript'>alert('Error '+'$message');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Apply</title>
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="dashboard/css/sb-admin-2.css" rel="stylesheet">
    
    <!-- Custom styles for this page -->
      <link href="dashboard/css/dataTables.bootstrap4.css" rel="stylesheet">
      <link href="dashboard/css/select2.css" rel="stylesheet">
      

  <!-- =======================================================
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
        <h1>Matrick Consultancies</h1>
        <span>.</span>
      </a>

      <!-- Nav Menu -->
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html#hero" class="active">Home</a></li>
          <!-- <li><a href="index.html#about">About</a></li>
          <li><a href="index.html#packages">Packages</a></li>
          <li><a href="index.html#team">Team</a></li> -->

          <li><a href="dashboard/">Dashboard</a></li>
        </ul>

        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav><!-- End Nav Menu -->

      <a class="" href="index.html#about"></a>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- Blog Details Page Title & Breadcrumbs -->
    <div data-aos="fade" class="page-title">
      
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.html">Home</a></li>
            <li class="current">Request</li>
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
                <h4>Request Application</h4>
                <form action=".\dashboard\save_loan.php" method="POST"  enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-6 form-group">
                    <label>Borrower</label>
                    <br/>
                    <input type="hidden" value="<?php echo $contact_no?>" name="contact_no"/>
                    <select name="borrower" class="form-control borrow" required="required" style="width:100%;">
                        <?php
                            echo "123";
                              $tbl_borrower=$db->get_borrower($contact_no);
                              print_r($tbl_borrower);
                              while($fetch=$tbl_borrower->fetch_array()){
                                $borrower_id=$fetch['borrower_id'];

                        ?>
                          <option value="<?php echo $fetch['borrower_id']?>"><?php echo $fetch['lastname'].", ".$fetch['firstname']." ".substr($fetch['middlename'], 0, 1)?>.</option>
                        <?php
                          }
                        ?>
                      </select>
                    </div>
                    <div class="col-md-6 form-group">
                      <label>request type</label>
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
                        <label>Request Plan</label>
                        <select name="lplan" class="form-control" required="required" id="lplan">
                            <!-- <option value="">Please select an option</option> -->
                          <?php
                            $tbl_lplan=$db->display_lplan();
                            while($fetch=$tbl_lplan->fetch_array()){
							  $plan = $fetch['lplan_month'];
							  $fetch['lplan_month'] =1;
                          ?>
							<option value="<?php echo $fetch['lplan_id']?>" name="<?php echo $fetch['lplan_month']." months[".$fetch['lplan_interest']."%,".$fetch['lplan_penalty']."%]"?>"><?php echo $plan." Days"?></option>

                            <!-- <option value="<?php echo $fetch['lplan_id'] - 26?>" name="<?php echo $fetch['lplan_month']." months[".$fetch['lplan_interest']."%,".$fetch['lplan_penalty']."%]"?>"><?php echo $fetch['lplan_month']." Days"?></option> -->
							<!-- <option value="<?php echo $fetch['lplan_id']?>"><?php echo $fetch['lplan_month']." Days"?></option> -->
 
						  <?php
                            }
                          ?>
                        </select>
                        <!-- <label>Days</label> -->
                      </div>
                    <div class="col-md-6 form-group">
                      <label>Request Amount</label>
                      <input type="number" name="loan_amount" class="form-control" id="amount" required="required"/>

                    </div>
                  </div>
                  <!-- <div class="row">
                    <div class="form-group col-xl-12 col-md-12">
                      <label>Upload Loan Form</label>
                      <input type="file" name="loan_form" class="form-control btn-primary btn-block" id="loan_form" accept="image/*"/>
                    </div>
                  </div> -->
                  <div class="row">
                    <div class="form-group col-xl-6 col-md-6">
                      <label>Purpose</label>
                      <input name="purpose" class="form-control" value="Business Request" required="required"/>
                    </div>
                    <div class="form-group col-xl-6 col-md-6">
                      <label>.</label>
                      <button type="button" class="btn btn-primary btn-block" id="calculate">Calculate Amount</button>
                    </div>
                  </div>
                  
                  <hr>
                  <div class="row" id="calcTable">
                    <!-- <div class="col-xl-4 col-md-4"> -->
                      <!-- <center><span>Total Payable Amount</span></center> -->
                      <!-- <center><span id="tpa"></span></center> -->
                    <!-- </div> -->
                    <div class="col-xl-6 col-md-6">
                      <center><span>Total Payable Amount</span></center>
                      <center><span id="mpa"></span></center>
                    </div>
                    <div class="col-xl-6 col-md-6">
                      <center><span>Daily Payment</span></center>
                      <center><span id="pa"></span></center>
                    </div>
                  </div>
              

                  <div class="text-center">
                    <button type="submit" name="apply" class="btn btn-primary">Apply</button>
                    <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">Check my Requests</button>
                          
                  </div>
                  <div class="row">
                    <div class="collapse collapse-horizontal" id="collapseWidthExample"> 
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Requester</th>
                                            <th>Request Detail</th>
                                            <th>Payment Detail</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                          // $tbl_loan=$db->display_loan();
                                          $tbl_loan=$db->get_loans($borrower_id);
                                          $i=1;
                                          while($fetch=$tbl_loan->fetch_array()){
                                            $ref_no = $fetch['ref_no'];
                                            $sum_payment=$db->conn->query("SELECT SUM(pay_amount) FROM `payment` INNER JOIN `loan` ON payment.loan_id=loan.loan_id WHERE loan.ref_no = $ref_no");
                                            $sum_fetch=$sum_payment->fetch_array();
                                            
                                        ?>
                                        <tr>
											<td><?php echo $i++;?></td>
											<td>
												<p><small>Name: <strong><?php echo $fetch['lastname'].", ".$fetch['firstname']." ".substr($fetch['middlename'], 0, 1)."."?></strong></small></p>
												<p><small>Contact: <strong><?php echo $fetch['contact_no']?></strong></small></p>
												<p><small>Address: <strong><?php echo $fetch['address']?></strong></small></p>
											</td>
											<td>
												<p><small>Request Reference no: <strong><?php echo $fetch['ref_no']?></strong></small></p>
												<p><small>Request Type: <strong><?php echo $fetch['ltype_name']?></strong></small></p>
												<!-- <p><small>Request Plan: <strong><?php echo $fetch['lplan_month']." months[".$fetch['lplan_interest']."%, ".$fetch['lplan_penalty']."%]"?></strong> interest, penalty</small></p> -->
												<p><small>Request Plan: <strong>26 Days</strong></small></p>

												<?php
													$monthly =($fetch['amount'] + ($fetch['amount'] * ($fetch['lplan_interest']/100))) / $fetch['lplan_month'];
													$penalty=$monthly * ($fetch['lplan_penalty']/100);
													$totalAmount=$fetch['totalAmount'];
												?>
												<p><small>Amount: <strong><?php echo " ".number_format($fetch['amount'], 2)?></strong></small></p>
												<p><small>Total Payable: <strong><?php echo " ".number_format($totalAmount, 2)?></strong></small></p>
												<!-- <p><small>Monthly Payable Amount: <strong><?php echo " ".number_format($monthly, 2)?></strong></small></p> -->
												<!-- <p><small>Overdue Payable: <strong><?php echo " ".number_format($penalty, 2)?></strong></small></p> -->
												<?php
													if (preg_match('/[1-9]/', $fetch['date_released'])){ 
														echo '<p><small>Date Released: <strong>'.date("M d, Y", strtotime($fetch['date_released'])).'</strong></small></p>';
													}
												?>
												
											</td>
											<td>
                      <?php
                          $loanid = $fetch['loan_id'];                          
													$payment=$db->conn->query("SELECT * FROM `payment` WHERE `loan_id`='$loanid'") or die($this->conn->error);
													$paid = $payment->num_rows;
													$offset = $paid > 0 ? " offset $paid ": "";
													
													
													// if($fetch['status'] == 2){
														$next = $db->conn->query("SELECT * FROM `loan_schedule` WHERE `loan_id`='$loanid' ORDER BY date(due_date) DESC limit 1")->fetch_assoc()['due_date'];
														$add = (date('Ymd',strtotime($next)) < date("Ymd") ) ?  $penalty : 0;
														echo "<p><small>Due Payment Date: <br /><strong>".date('F d, Y',strtotime($next))."</strong></small></p>";
														echo "<p><small>Daily Amount: <br /><strong> ".number_format($monthly, 2)."</strong></small></p>";
														echo "<p><small>Amount Paid: <br /><strong> ".$sum_fetch[0]."</strong></small></p>";
														echo "<p><small>Payable Amount: <br /><strong> ".$fetch['lplan_interest']/100 * $fetch["amount"] + $fetch["amount"]."</strong></small></p>";
													// }
												?>
											</td>
											<td>
												<?php 
													if($fetch['status']==0){
														echo '<span class="badge badge-warning">For Approval</span>';
													}else if($fetch['status']==1){
														echo '<span class="badge badge-info">Approved</span>';
													}else if($fetch['status']==2){
														echo '<span class="badge badge-primary">Released</span>';
                            if (floatval($sum_fetch[0]) >= floatval($fetch['lplan_interest'] / 100 * $fetch["amount"] + $fetch["amount"])) {
                              echo '<div><span class="badge badge-success">Complete</span></div>';
                            } else {
                              echo '<div><span class="badge badge-danger">Active</span></div>';
                            } 
													}else if($fetch['status']==3){
														echo '<span class="badge badge-success">Completed</span>';
													}else if($fetch['status']==4){
														echo '<span class="badge badge-danger">Denied</span>';
													}
													
                          if($fetch['status'] == 2 || $fetch['status'] == 0){
                            // print_r($fetch);
                            $names= $fetch['firstname'] . ' ' . $fetch['middlename'] . ' ' .$fetch['lastname'];
                            $idno= $fetch['tax_id'];
                            $plot_name= $fetch['address'];
                            $phone_no= $fetch['contact_no'];
                            if (!$fetch['date_released']) {
                                $date = date('d, F, Y'); // Get the current date
                            } else {
                                $date = date("d, F, Y", strtotime($fetch['date_released']));
                            }
                            $due=date('d, F, Y',strtotime($next));
                            $agreement= number_format($totalAmount, 2);
                            $daily= number_format($monthly, 2);
                            $principal= number_format($fetch['amount'], 2);
                            $id_front = explode('_Splitter_', $fetch["id_doc"])[0];
                            $id_back = explode('_Splitter_', $fetch["id_doc"])[1];
                            $signature_doc = $fetch['signature_doc'];
                            $front_id = str_replace($_SERVER['DOCUMENT_ROOT'].'/', '', $id_front);
                            $back_id = str_replace($_SERVER['DOCUMENT_ROOT'].'/', '', $id_back);
                            $plan = $fetch['lplan_month'];
                            $interest = $fetch['lplan_interest'];
                            $search_string = '?front_id='.$front_id.'&back_id='.$back_id.'&names='.$names.'&idno='.$idno.'&due='.$due.'&plot_name='.$plot_name.'&phone_no='.$phone_no.'&date='.$date.'&agreement='.$agreement.'&daily='.$daily.'&principal='.$principal.'&plan='.$plan.'&interest='.$interest; 
												    ?>  
                              <br/><br/><a href="agreement.php<?php echo $search_string?>"><button class="badge badge-success" type="button">print Request agreement</button></a>
                            
                            <?php
                              
                          }  
                          ?>
											</td>
                      
                                           
                    </tr>
										
										
										<!-- Update User Modal -->
																			
										
										
										<!-- Delete Loan Modal -->
										
										
										
										<!-- View Payment Schedule -->
										<div class="modal fade" id="viewSchedule<?php echo $fetch['loan_id']?>" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header bg-info">
														<h5 class="modal-title text-white">Payment Schedule</h5>
														<button class="close" type="button" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
													</div>
													<div class="modal-body">
														<div class="row">
															<div class="col-md-5 col-xl-5">
																<p>Request Reference No:</p>
																<p><strong><?php echo $fetch['ref_no']?></strong></p>
															</div>
															<div class="col-md-7 col-xl-7">
																<p>Name:</p>
																<p><strong><?php echo $fetch['firstname']." ".substr($fetch['middlename'], 0, 1).". ".$fetch['lastname']?></strong></p>
															</div>
														</div>
														<hr />
														
														<div class="container">
															<div class="row">
																<div class="col-sm-6"><center>Months</center></div>
																<div class="col-sm-6"><center>Monthly Payment</center></div>
															</div>
															<hr />
															<?php 
																$tbl_schedule=$db->conn->query("SELECT * FROM `loan_schedule` WHERE `loan_id`='".$fetch['loan_id']."'");
																
																while($row=$tbl_schedule->fetch_array()){
															?>
															<div class="row">
																<div class="col-sm-6 p-2 pl-5" style="border-right: 1px solid black; border-bottom: 1px solid black;"><strong><?php echo date("F d, Y" ,strtotime($row['due_date']));?></strong></div>
																<div class="col-sm-6 p-2 pl-5" style="border-bottom: 1px solid black;"><strong><?php echo " ".number_format($monthly, 2); ?></strong></div>
															</div>
																<?php
																}
															?>
														
														</div>	
													</div>
													<div class="modal-footer">
														<button class="btn btn-secondary" type="button" data-dismiss="modal">Close</button>
													</div>
												</div>
											</div>
										</div>
										
										
										
										
										<?php
											}
										?>
                                    </tbody>
                                </table>
                            </div>
						</div>
                      </div>
                    </div>
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
            <span>Matrick</span>
          </a>
          <p>
            Your financial well-being is our top priority. Join the thousands of satisfied customers who have already experienced the difference with Matrick. Discover a partner you can trust, and let us help you achieve your financial goals.
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
            <!-- <li><a href="#">About us</a></li>
            <li><a href="#">Products</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li> -->
          </ul>
        </div>

       

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contact Us</h4>
          <p>Embakasi Nairobi Kenya</p>
          <!-- <p class="mt-4"><strong>Phone:</strong> <span>+254704470096</span></p>
          <p><strong>Email:</strong> <span>matrickcredit@gmail.com</span></p> -->
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>&copy; <span>Copyright</span> <strong class="px-1">Matrick</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        <span class="">Designed By<a href="http://52.5.53.186" class="" target="_blank"> SoNux Technologies</a> Distributed By <a href="https://triplesolutions.co.ke/" target="_blank">Triple Solutions</a></span>
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

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <script src="dashboard/js/jquery.easing.js"></script>
  <script src="dashboard/js/select2.js"></script>
  
  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <!-- <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script> -->



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
					alert("Please enter a Request Plan or Amount to Calculate")
				}else{
					var lplan=$("#lplan option:selected").attr("name");
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
					// console.log(monthly)
          console.log(amount)
          console.log(interest)
          console.log(months)
          var l_plan=$("#lplan option:selected").text();
          var l_plan_=parseFloat(l_plan.replace(/[^0-9.]/g, ""));
					var daily = monthly / l_plan_
					$("#tpa").text(totalAmount.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2}));
					$("#mpa").text(monthly.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2}));
					$("#pa").text(daily.toLocaleString(undefined, { minimumFractionDigits: 2, maximumFractionDigits: 2}));
					
					$("#calcTable").show();
				}
				
			});
			
			
			$("#updateCalculate").click(function(){
				if($("#ulplan").val() == "" || $("#uamount").val() == ""){
					alert("Please enter a Request Plan or Amount to Calculate")
				}else{
					var lplan=$("#ulplan option:selected").text();
					var months=parseFloat(lplan.split('months')[0]);
					var splitter=lplan.split('months')[1];
					var findinterest=splitter.split('%')[0];
					var interest=parseFloat(findinterest.replace(/[^0-9.]/g, ""));
					var findpenalty=splitter.split('%')[1];
					var penalty=parseFloat(findpenalty.replace(/[^0-9.]/g, ""));
					
					var amount=parseFloat($("#uamount").val());
					console.log(amount)
          console.log(interest)
          console.log(months)
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