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
  if ($status == 'success'){
    echo "<script type='text/javascript'>alert('Registration '+'$status');</script>";
  }
  if ($status == 'exists'){
    echo "<script type='text/javascript'>alert('User '+'$status' + '. Apply Loan');</script>";
  }
  if ($status == 'applied'){
    echo "<script type='text/javascript'>alert('Loan '+'$status' + '. Pending approval and disbursment');</script>";
  }
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
        <h1>Loan Sasa</h1>
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
                    <input type="hidden" value="<?php echo $contact_no?>" name="contact_no"/>
                    <select name="borrower" class="form-control borrow" required="required" style="width:100%;">
                        <?php
                              $tbl_borrower=$db->get_borrower($contact_no);
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
                      <input type="hidden" value="<?php echo $fetch['loan_id']?>" name="loan_id"/>

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
                    <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#collapseWidthExample" aria-expanded="false" aria-controls="collapseWidthExample">Check my loans</button>

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
                                            <th>Borrower</th>
                                            <th>Loan Detail</th>
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
										?>
										
                                        <tr>
											<td><?php echo $i++;?></td>
											<td>
												<p><small>Name: <strong><?php echo $fetch['lastname'].", ".$fetch['firstname']." ".substr($fetch['middlename'], 0, 1)."."?></strong></small></p>
												<p><small>Contact: <strong><?php echo $fetch['contact_no']?></strong></small></p>
												<p><small>Address: <strong><?php echo $fetch['address']?></strong></small></p>
											</td>
											<td>
												<p><small>Reference no: <strong><?php echo $fetch['ref_no']?></strong></small></p>
												<p><small>Loan Type: <strong><?php echo $fetch['ltype_name']?></strong></small></p>
												<p><small>Loan Plan: <strong><?php echo $fetch['lplan_month']." months[".$fetch['lplan_interest']."%, ".$fetch['lplan_penalty']."%]"?></strong> interest, penalty</small></p>
												<?php
													$monthly =($fetch['amount'] + ($fetch['amount'] * ($fetch['lplan_interest']/100))) / $fetch['lplan_month'];
													$penalty=$monthly * ($fetch['lplan_penalty']/100);
													$totalAmount=$fetch['amount']+$monthly;
												?>
												<p><small>Amount: <strong><?php echo "&#8369; ".number_format($fetch['amount'], 2)?></strong></small></p>
												<p><small>Total Payable Amount: <strong><?php echo "&#8369; ".number_format($totalAmount, 2)?></strong></small></p>
												<p><small>Monthly Payable Amount: <strong><?php echo "&#8369; ".number_format($monthly, 2)?></strong></small></p>
												<p><small>Overdue Payable Amount: <strong><?php echo "&#8369; ".number_format($penalty, 2)?></strong></small></p>
												<?php
													if (preg_match('/[1-9]/', $fetch['date_released'])){ 
														echo '<p><small>Date Released: <strong>'.date("M d, Y", strtotime($fetch['date_released'])).'</strong></small></p>';
													}
												?>
												
											</td>
											<td>
												<?php
													$payment=$db->conn->query("SELECT * FROM `payment` WHERE `loan_id`='$fetch[loan_id]'") or die($this->conn->error);
													$paid = $payment->num_rows;
													$offset = $paid > 0 ? " offset $paid ": "";
													
													
													if($fetch['status'] == 2){
														$next = $db->conn->query("SELECT * FROM `loan_schedule` WHERE `loan_id`='$fetch[loan_id]' ORDER BY date(due_date) ASC limit 1 $offset ")->fetch_assoc()['due_date'];
														$add = (date('Ymd',strtotime($next)) < date("Ymd") ) ?  $penalty : 0;
														echo "<p><small>Next Payment Date: <br /><strong>".date('F d, Y',strtotime($next))."</strong></small></p>";
														echo "<p><small>Montly Amount: <br /><strong>&#8369; ".number_format($monthly, 2)."</strong></small></p>";
														echo "<p><small>Penalty: <br /><strong>&#8369; ".$add."</strong></small></p>";
														echo "<p><small>Payable Amount: <br /><strong>&#8369; ".number_format($monthly+$add, 2)."</strong></small></p>";
													}
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
													}else if($fetch['status']==3){
														echo '<span class="badge badge-success">Completed</span>';
													}else if($fetch['status']==4){
														echo '<span class="badge badge-danger">Denied</span>';
													}
													
												?>
											</td>
                                           
                    </tr>
										
										
										<!-- Update User Modal -->
										<div class="modal fade" id="updateloan<?php echo $fetch['loan_id']?>" aria-hidden="true">
											<div class="modal-dialog modal-lg">
												<form method="POST" action="updateLoan.php">
													<div class="modal-content">
														<div class="modal-header bg-warning">
															<h5 class="modal-title text-white">Edit Loan</h5>
															<button class="close" type="button" data-dismiss="modal" aria-label="Close">
																<span aria-hidden="true">×</span>
															</button>
														</div>
														<div class="modal-body">
															<div class="form-row">
																<div class="form-group col-xl-6 col-md-6">
																	<label>Borrower</label>
																	<br />
																	<input type="hidden" value="<?php echo $fetch['loan_id']?>" name="loan_id"/>
																	<select name="borrower" class="borrow" required="required" style="width:100%;">
																		<?php
																			$tbl_borrower=$db->display_borrower();
																			while($row=$tbl_borrower->fetch_array()){
																		?>
																			<option value="<?php echo $row['borrower_id']?>" <?php echo ($fetch['borrower_id']==$row['borrower_id'])?'selected':''?>><?php echo $row['lastname'].", ".$row['firstname']." ".substr($row['middlename'], 0, 1)?>.</option>
																		<?php
																			}
																		?>
																	</select>
																</div>
																<div class="form-group col-xl-6 col-md-6">
																	<label>Loan type</label>
																	<br />
																	<select name="ltype" class="loan" required="required" style="width:100%;">
																		<?php
																			$tbl_ltype=$db->display_ltype();
																			while($row=$tbl_ltype->fetch_array()){
																		?>
																			<option value="<?php echo $row['ltype_id']?>" <?php echo ($fetch['ltype_id']==$row['ltype_id'])?'selected':''?>><?php echo $row['ltype_name']?></option>
																		<?php
																			}
																		?>
																	</select>
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col-xl-6 col-md-6">
																	<label>Loan Plan</label>
																	<select name="lplan" class="form-control" required="required" id="ulplan">
																		<?php
																			$tbl_lplan=$db->display_lplan();
																			while($row=$tbl_lplan->fetch_array()){
																		?>
																			<option value="<?php echo $row['lplan_id']?>" <?php echo ($fetch['lplan_id']==$row['lplan_id'])?'selected':''?>><?php echo $row['lplan_month']." months[".$row['lplan_interest']."%, ".$row['lplan_penalty']."%]"?></option>
																		<?php
																			}
																		?>
																	</select>
																	<label>Months[Interest%, Penalty%]</label>
																</div>
																<div class="form-group col-xl-6 col-md-6">
																	<label>Loan Amount</label>
																	<input type="number" name="loan_amount" class="form-control" id="uamount" value="<?php echo $fetch['amount']?>" required="required"/>
																</div>
															</div>
															<div class="form-row">
																<div class="form-group col-xl-6 col-md-6">
																	<label>Purpose</label>
																	<textarea name="purpose" class="form-control" style="resize:none; height:200px;" required="required"><?php echo $fetch['purpose']?></textarea>
																</div>
																<div class="form-group col-xl-6 col-md-6">
																	<button type="button" class="btn btn-primary btn-block" id="updateCalculate">Calculate Amount</button>
																</div>
															</div>
															<hr>
															<div class="row">
																<div class="col-xl-4 col-md-4">
																	<center><span>Total Payable Amount</span></center>
																	<center><span id="utpa"><?php echo "&#8369; ".number_format($totalAmount, 2)?></span></center>
																</div>
																<div class="col-xl-4 col-md-4">
																	<center><span>Monthly Payable Amount</span></center>
																	<center><span id="umpa"><?php echo "&#8369; ".number_format($monthly, 2)?></span></center>
																</div>
																<div class="col-xl-4 col-md-4">
																	<center><span>Penalty Amount</span></center>
																	<center><span id="upa"><?php echo "&#8369; ".number_format($penalty, 2)?></span></center>
																</div>
															</div>
															<hr>
															<div class="form-row">
																<div class="form-group col-xl-6 col-md-6">
																	<label>Status</label>
																	<select class="form-control" name="status">
																		<?php
																			if($fetch['status']==4){
																		?>
																			<option value="0" <?php echo ($fetch['status']==0)?'selected':''?>>For Approval</option>
																			<option value="1" <?php echo ($fetch['status']==1)?'selected':''?>>Approved</option>
																			<option value="4" <?php echo ($fetch['status']==4)?'selected':''?>>Denied</option>
																		<?php
																			}else if($fetch['status']==2){
																		?>
																			<option value="2" readonly="readonly">Released</option>
																		<?php
																			}else{
																		?>
																			<option value="0" <?php echo ($fetch['status']==0)?'selected':''?>>For Approval</option>
																			<option value="1" <?php echo ($fetch['status']==1)?'selected':''?>>Approved</option>
																			<option value="2" <?php echo ($fetch['status']==2)?'selected':''?>>Released</option>
																			<option value="4" <?php echo ($fetch['status']==4)?'selected':''?>>Denied</option>
																		<?php
																			}
																		?>
																	</select>
																</div>
															</div>
														</div>
														<div class="modal-footer">
															<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
															<button type="submit" name="update" class="btn btn-warning">Update</a>
														</div>
													</div>
												</form>
											</div>
										</div>
										
										
										
										<!-- Delete Loan Modal -->
										
										<div class="modal fade" id="deleteborrower<?php echo $fetch['loan_id']?>" tabindex="-1" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header bg-danger">
														<h5 class="modal-title text-white">System Information</h5>
														<button class="close" type="button" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">×</span>
														</button>
													</div>
													<div class="modal-body">Are you sure you want to delete this record?</div>
													<div class="modal-footer">
														<button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
														<a class="btn btn-danger" href="deleteLoan.php?loan_id=<?php echo $fetch['loan_id']?>">Delete</a>
													</div>
												</div>
											</div>
										</div>
										
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
																<p>Reference No:</p>
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
																<div class="col-sm-6 p-2 pl-5" style="border-bottom: 1px solid black;"><strong><?php echo "&#8369; ".number_format($monthly, 2); ?></strong></div>
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