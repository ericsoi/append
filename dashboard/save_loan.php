<?php
	// date_default_timezone_set("Etc/GMT+8");
	require_once'class.php';
	if(ISSET($_POST['apply'])){
		$db=new db_class();
		$borrower=$_POST['borrower'];
		$ltype=$_POST['ltype'];
		$lplan=$_POST['lplan'];
		$loan_amount=$_POST['loan_amount'];
		$purpose=$_POST['purpose'];
		$date_created=date("Y-m-d H:i:s");
		$paid_amount=0;
		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/loan_form/" . $borrower . "/" . date("Y-m-d") . "/" . rand(0, 999999) . "/";
		$loan_plan=$db->check_lplan($lplan);
		$fetch=$loan_plan->fetch_array();
		$totalAmount = $fetch['lplan_interest']/100 * $loan_amount+ $loan_amount;
		// echo $totalAmount;
		$tbl_borrowe=$db->get_borrower_id($borrower);
		$fetch_borrower=$tbl_borrowe->fetch_array();
		$names = $fetch_borrower['firstname'] . ' ' . $fetch_borrower['middlename'];
		$contact_no = $fetch_borrower['contact_no'];
		
		if (isset($_FILES['loan_form']) && $_FILES['loan_form']['error'] === 0 && $_FILES['loan_form']['size'] > 0) {
			$file_type=explode("/",$_FILES['loan_form']['type'])[0];
			if( $file_type=="image"){
				if( is_dir($target_dir) === false ){
					mkdir($target_dir, 0777, true);
				}
				$loan_form = $target_dir . basename($_FILES['loan_form']["name"]);
				move_uploaded_file($_FILES['loan_form']['tmp_name'], $loan_form);
			}else{
				if(parse_url($_SERVER['HTTP_REFERER'])['path'] == "/loan.php"){
					$contact_no=$_POST["contact_no"];
					header("location: ../loan.php?status=error&message=Upload image files&contact_no=".$contact_no);
				}else{
					header("location: loan.php?status=error&message=Upload an image file");
					exit;
				}
				exit;
			}
			


			
		}else{
			$loan_form = $target_dir."loan_form.png";
		}
		print_r($_POST);
		$tbl_unpaid=$db->conn->query("SELECT * FROM `loan` WHERE `borrower_id`='$borrower' AND CAST(`paid_amount` AS FLOAT) < CAST(`totalAmount` AS FLOAT)");
		if($tbl_unpaid->num_rows > 0){
			$status="error";
			$message="Loan application Failure, Your loan is active or pending for aproval";
		}else{
			$db->save_loan($borrower,$ltype,$lplan,$loan_amount,$purpose,$loan_form,$paid_amount,$totalAmount,$date_created);		
			$status="applied";
			$message="Loan application Successfull, awaiting aproval";
			include '../mail.php';
		}
		if(parse_url($_SERVER['HTTP_REFERER'])['path'] == "/loan.php"){
			$contact_no=$_POST["contact_no"];
			header("location: ../loan.php?status=".$status."&message=".$message."&contact_no=".$contact_no);
		}else{
			header("location: loan.php?status=".$status."&message=".$message);
		}
		// $db->save_loan($borrower,$ltype,$lplan,$loan_amount,$purpose,$loan_form,$paid_amount,$totalAmount,$date_created);		
		// include '../mail.php';
		// if(parse_url($_SERVER['HTTP_REFERER'])['path'] == "/loan.php"){
		// 	$contact_no=$_POST["contact_no"];
		// 	header("location: ../loan.php?status=applied&contact_no=".$contact_no);
		// }else{
		// 	header("location: loan.php?");
		// 	return;
		// }
	}
?>