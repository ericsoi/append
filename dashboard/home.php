<?php
	// date_default_timezone_set("Etc/GMT+8");
	require_once'session.php';
	require_once'class.php';
	$db=new db_class(); 
    $currentDate = date("Y-m-d H:m:s");
    if(ISSET($_POST["mydate"])){
        $currentDate = $_POST["mydate"];
    }
    // $newDate = date("Y-m-d", strtotime($currentDate . " +0 day"));
    $newDate = date("Y-m-d", strtotime($currentDate . "-13 hour"));

    // echo $newDate;
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="image/favicon.png" rel="icon">

    <title>Matrick Credit</title>

    <link href="fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  
   
    <link href="css/sb-admin-2.css" rel="stylesheet">
    

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-secondary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="home.php">
                <div class="sidebar-brand-text mx-3">ADMIN PANEL</div>
            </a>


            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="../">
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    <span>Main</span></a>
            </li>

            <li class="nav-item active">
                <a class="nav-link" href="home.php">
                    <i class="fas fa-fw fa-home"></i>
                    <span>Home</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="loan.php">
                    <i class="fas fa-fw fas fa-comment-dollar"></i>
                    <span>Loans</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="payment.php">
                    <i class="fas fa-fw fas fa-coins"></i>
                    <span>Payments</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="borrower.php">
                    <i class="fas fa-fw fas fa-book"></i>
                    <span>Borrowers</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="loan_plan.php">
                    <i class="fas fa-fw fa-piggy-bank"></i>
                    <span>Loan Plans</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="loan_type.php">
                    <i class="fas fa-fw fa-money-check"></i>
                    <span>Loan Types</span></a>
            </li>
			<li class="nav-item">
                <a class="nav-link" href="user.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>Users</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="reports.php">
                    <i class="fas fa-fw fa-file"></i>
                    <span>Report</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="unpaid.php">
                    <i class="fas fa-fw fa-dollar-sign"></i>
                    <span>Today's Unpaid Loans</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
	
                   
					<!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $db->user_acc($_SESSION['user_id'])?></span>
                                <img class="img-profile rounded-circle"
                                    src="image/admin_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->

                    <div class="row">
                        <div class="col-6 text-left">
                            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        </div>
                        <div class="col-4 text-right ml-auto">
                            <!-- <button class="btn btn-secondary"><?php echo date("Y-m-d")?></button> -->
                            <form action="" method="post">
                                <div id="date-picker-example" class="md-form md-outline input-with-post-icon datepicker" inline="true">
                                    <input placeholder="Select date" type="date" name="mydate" id="example" class="form-control" value="<?php echo isset($_POST['mydate']) ? $_POST['mydate'] : date('Y-m-d'); ?>">
                                    <input type="submit" value="Submit" class="btn btn-secondary form-control" />
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- Content Row -->
                    <div class="row">

                     
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Active Loans</div>
                                            <div class="h1 mb-0 font-weight-bold text-gray-800">
												<?php 
													$tbl_loan=$db->conn->query("SELECT * FROM `loan` WHERE `status`='2'");
													echo $tbl_loan->num_rows > 0 ? $tbl_loan->num_rows : "0";
												?>
											</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fas fa-comment-dollar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<a class="small stretched-link" href="loan.php">View Loan List</a>
									<div class="small">
										<i class="fa fa-angle-right"></i>
									</div>
								</div>
                            </div>
                        </div>

                      
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Payments Today</div>
                                            <div class="h1 mb-0 font-weight-bold text-gray-800">
												<?php 
													$tbl_payment=$db->conn->query("SELECT sum(pay_amount) as total FROM `payment` WHERE date(date_created)='$newDate'");
													echo $tbl_payment->num_rows > 0 ? " ".number_format($tbl_payment->fetch_array()['total'],2) : " 0.00";
												?>
											</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fas fa-coins fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<a class="small stretched-link" href="payment.php">View Payments</a>
									<div class="small">
										<i class="fa fa-angle-right"></i>
									</div>
								</div>
                            </div>
                        </div>

                        
                        <div class="col-xl-4 col-md-4 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Borrowers
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800">
														<?php 
															$tbl_borrower=$db->conn->query("SELECT * FROM `borrower`");
															echo $tbl_borrower->num_rows > 0 ? $tbl_borrower->num_rows : "0";
														?>
													</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-fw fas fa-book fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
								<div class="card-footer d-flex align-items-center justify-content-between">
									<a class="small stretched-link" href="borrower.php">View Borrowers</a>
									<div class="small">
										<i class="fa fa-angle-right"></i>
									</div>
								</div>
                            </div>
                        </div>
                    </div>

                    <!--End of row 1-->
                    <div class="row">

                     
                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Todays Profit</div>
                                        <div class="h1 mb-0 font-weight-bold text-gray-800">
                                            <?php 
                                                $tbl_sum_loan=$db->conn->query("SELECT 
                                                        SUM((loan.totalAmount - loan.amount) / loan_plan.lplan_month) AS todays_profit,
                                                        SUM(paid_amount) - SUM((loan.totalAmount - loan.amount) / loan_plan.lplan_month) AS money_less_profit
                                                    FROM payment
                                                    INNER JOIN loan ON payment.loan_id = loan.loan_id
                                                    INNER JOIN loan_plan ON loan_plan.lplan_id = loan.lplan_id
                                                    WHERE DATE(payment.date_created) = '$newDate'");
                                                    echo $tbl_sum_loan->num_rows > 0 ? " ".number_format($tbl_sum_loan->fetch_array()['todays_profit'],2) : " 0.00";
                                                // echo $tbl_sum_loan->num_rows > 0 ? $tbl_sum_loan->num_rows : "0";
                                                
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fas fa-comment-dollar fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <div class="small">
                                    <i class="fa fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            Todays Interest-free</div>
                                            
                                        <div class="h1 mb-0 font-weight-bold text-gray-800">
                                        <?php 
                                                $tbl_sum_loan=$db->conn->query("SELECT 
                                                SUM(loan.amount / loan_plan.lplan_month) as total_daily
                                                    from payment INNER JOIN loan ON payment.loan_id = loan.loan_id INNER
                                                    JOIN loan_plan ON loan_plan.lplan_id = loan.lplan_id WHERE DATE(payment.date_created) = '$newDate'");
                                                    echo $tbl_sum_loan->num_rows > 0 ? " ".number_format($tbl_sum_loan->fetch_array()['total_daily'],2) : " 0.00";
                                                // echo $tbl_sum_loan->num_rows > 0 ? $tbl_sum_loan->num_rows : "0";
                                                
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fas fa-coins fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <div class="small">
                                    <i class="fa fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-xl-4 col-md-4 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Today's Unpaid loans
                                        </div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h1 mb-0 mr-3 font-weight-bold text-gray-800">
                                                    <?php 
                                                        // $tbl_unpaid = $db->conn->query("SELECT * FROM `loan` WHERE NOT `loan_id` IN (SELECT `loan_id` FROM `payment` WHERE DATE(`date_created`) = DATE(DATE_SUB(NOW(), INTERVAL 13 HOUR)) AND `status` IS NOT NULL)");

                                                        $tbl_unpaid = $db->conn->query("SELECT * FROM `loan` WHERE NOT `loan_id` IN (SELECT `loan_id` FROM `payment` WHERE DATE(`date_created`) = '$newDate') AND `status` IS NOT NULL");
                                                        
                                                        echo $tbl_unpaid->num_rows > 0 ? $tbl_unpaid->num_rows : "0";
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <i class="fas fa-fw fas fa-book fa-2x text-gray-300"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small stretched-link" href="unpaid.php?date=<?php echo $currentDate?>">View Loans</a>
                                <div class="small">
                                    <i class="fa fa-angle-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End of row 2-->
                
                <!--End of row 3-->
                <div class="row">

                     
                <div class="col-xl-4 col-md-4 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Unpaid Loans</div>
                                    <div class="h1 mb-0 font-weight-bold text-gray-800">
                                        <?php 
                                           $unpaid_loan=$db->conn->query("SELECT * from loan where paid_amount = 0 AND status IS NOT NULL");
                                           echo $unpaid_loan->num_rows > 0 ? $unpaid_loan->num_rows : "0";
                                            
                                        ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-fw fas fa-comment-dollar fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <div class="small">
                                <i class="fa fa-angle-right"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="stocky-footer">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Matrick Credit <?php echo date("Y")?></span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white">System Information</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Are you sure you want to logout?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-danger" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.bundle.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="js/jquery.easing.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.js"></script>
    <script>
        // Data Picker Initialization
        $('.datepicker').datepicker({
        inline: true
        });
    </script>


</body>

</html>