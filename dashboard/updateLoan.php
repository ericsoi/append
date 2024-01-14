<?php
	// date_default_timezone_set("Etc/GMT+8");
	require_once'class.php';
	if(ISSET($_POST['update'])){
		$db=new db_class();
		$loan_id=$_POST['loan_id'];
		$borrower=$_POST['borrower'];
		$ltype=$_POST['ltype'];
		$lplan=$_POST['lplan'];
		$loan_amount=$_POST['loan_amount'];
		$purpose=$_POST['purpose'];
		$status=$_POST['status'];
		$date_released=NULL;
		
		$tbl_loan=$db->check_loan($loan_id);
		$fetch=$tbl_loan->fetch_array();
		$tbl_lplan=$db->check_lplan($lplan);
		$fetch1=$tbl_lplan->fetch_array();
		$month=$fetch1['lplan_month'];
		if (preg_match('/[1-9]/', $fetch['date_released'])){ 
			$date_released=$fetch['date_released'];
		}else{
			if($status==2){
				$date_released=date("Y-m-d H:i:s");
				// for($i=0; $i<$month; $i++){
				// 	$date_schedule=date("Y-m-d", strtotime("+".$i."day"));
					

				// 	$db->save_date_sched($loan_id, $date_schedule);
				// }
			}else{
				$date_released=NULL;
			}
		}
		
		
		$db->update_loan($loan_id, $borrower, $ltype, $lplan, $loan_amount, $purpose, $status, $date_released);
		
		
		echo"<script>alert('Update Loan successfully')</script>";
		echo"<script>window.location='loan.php'</script>";
	}
	if(ISSET($_POST['update_form'])){
		$db=new db_class();
		$contact_no = $_POST['Contact_no'];
		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/loan_form/" . $contact_no . "/" . date("Y-m-d") . "/" . rand(0, 999999) . "/";
		$loan_id = $_POST['Loan_id'];
		if(isset($_FILES['loan_form'])){
			if( is_dir($target_dir) === false ){
				mkdir($target_dir, 0777, true);
			}
			$loan_form = $target_dir . basename($_FILES['loan_form']["name"]);
			move_uploaded_file($_FILES['loan_form']['tmp_name'], $loan_form);
		}else{
			$loan_form = $target_dir."loan_form.png";
		}
		$db->update_form($loan_id, $loan_form);
		echo"<script>alert('Update Form successfully')</script>";
		echo"<script>window.location='loan.php'</script>";
	}

	
?>