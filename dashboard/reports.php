<?php
	date_default_timezone_set("Etc/GMT+8");
	require_once'session.php';
	require_once'class.php';
	$db=new db_class(); 
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
	
	<!-- Custom styles for this page -->
    <link href="css/dataTables.bootstrap4.css" rel="stylesheet">
    

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
            <li class="nav-item">
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
			<li class="nav-item active">
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
                    <i class="fas fa-fw fa-user"></i>
                    <span>Report</span></a>
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
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Reports</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card">
                                <div class="card-body">
									<form method="POST" action="calculate_reports.php">
										<div class="form-group">
											<label>From </label>
											<input type="date" class="form-control" name="from" required="required" value="<?php echo date('Y-m-d'); ?>"/>
										</div>
										<div class="i-group">
											<label>To</label>
											<input type="date" class="form-control" name="to" required="required" value="<?php echo date('Y-m-d'); ?>"/>
										</div>
										<div class="i-group">
                                        <label>Select an option to continue</label>

                                            <select class="form-control" name="status">
                                                <option class="form-control" >Complete Loans</option>
                                                <option class="form-control" >Active Loans</option>
                                            </select>
										</div>
										<button type="submit" class="btn btn-primary btn-block" name="save">Check</button>
									</form>
                                </div>
                            </div>
                        </div>
						<div class="col-xl-9  mb-4">
                            <div class="card">
                                <div class="card-body">
									 <div class="table-responsive">
										<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <?php if(ISSET($_GET["startDate"])){?>
                                                <div><b> <?php echo $_GET["startDate"] . " to " .date("Y-m-d", strtotime($_GET["endDate"] . ' -1 day')) ?></b></div>
                                                <?php
                                                }?>
                                            <tbody>
                                            <?php if(ISSET($_GET['status'])){?>
                                                <div><b> <?php echo $_GET["status"] ?></b></div>

                                                
                                                <?php
                                            }
                                            ?>
                                                <?php if(ISSET($_GET['sum_totalAmount_out'])){?>
                                                <tr>
                                                    <td>Total money lend </td>
                                                    <td><?php echo $_GET["sum_amount_out"]?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Money expected</td>
                                                    <td><?php echo $_GET["sum_totalAmount_out"]?></td>
                                                </tr>
                                                <tr>
                                                    <td>Paid Amount</td>
                                                    <td><?php echo $_GET["sum_paid_amount"]?></td>
                                                </tr>
                                                <tr>
                                                    <td>Deficit Amount</td>
                                                    <td><?php echo $_GET["sum_totalAmount_out"] - $_GET["sum_paid_amount"]?></td>
                                                </tr>
                                                <tr>
                                                    <td>Profit Out</td>
                                                    <td><?php echo $_GET["sum_totalAmount_out"] - $_GET["sum_amount_out"] - $_GET["sum_paid_amount"]?></td>
                                                </tr>
                                                <tr>
                                                    <td>Profit Expected</td>
                                                    <td><?php echo $_GET["sum_totalAmount_out"] - $_GET["sum_amount_out"]?></td>
                                                </tr>
                                                <tr>
                                                    <td>Active Loans</td>
                                                    <td><?php echo $_GET["total_loans"]?></td>
                                                </tr>
                                                <?php
                                                } elseif(!ISSET($_GET['sum_totalAmount_out']) && (ISSET($_GET["total_loans"]))){?>
                                                                                                <tr>
                                                    <td>Total money lend </td>
                                                    <td><?php echo $_GET["sum_amount_out"]?></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>Paid Amount</td>
                                                    <td><?php echo $_GET["sum_paid_amount"]?></td>
                                                </tr>
                                                <tr>
                                                    <td>Total Profit</td>
                                                    <td><?php echo $_GET["sum_paid_amount"] - $_GET["sum_amount_out"]?></td>
                                                </tr>
                                                
                                                <tr>
                                                    <td>Paid Active Loans</td>
                                                    <td><?php echo $_GET["total_loans"]?></td>
                                                </tr>
                                                <?php
                                                }?>
                                            </tbody>
										</table>
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
	
	<!-- Page level plugins -->
	<script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap4.js"></script>
	
	<script>
		$(document).ready(function() {
			$('#dataTable').DataTable({
				"order": [[1 , "asc" ]]
			});
		});
	</script>

</body>

</html>