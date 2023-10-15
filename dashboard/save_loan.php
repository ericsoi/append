<?php
	date_default_timezone_set("Etc/GMT+8");
	require_once'class.php';
	if(ISSET($_POST['apply'])){
		$db=new db_class();
		$borrower=$_POST['borrower'];
		$ltype=$_POST['ltype'];
		$lplan=$_POST['lplan'];
		$loan_amount=$_POST['loan_amount'];
		$purpose=$_POST['purpose'];
		$date_created=date("Y-m-d H:i:s");
		$contact_no=$_POST["contact_no"];
		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/Append/uploads/loan_form/" . $contact_no . "/" . date("Y-m-d") . "/" . rand(0, 999999) . "/";
		if(isset($_FILES['loan_form'])){
			if( is_dir($target_dir) === false ){
				mkdir($target_dir, 0777, true);
			}
			$loan_form = $target_dir . basename($_FILES['loan_form']["name"]);
			move_uploaded_file($_FILES['loan_form']['tmp_name'], $loan_form);
		}else{
			$loan_form = $target_dir."loan_form.png";
		}
		$db->save_loan($borrower,$ltype,$lplan,$loan_amount,$purpose,$loan_form,$date_created);		
		if(parse_url($_SERVER['HTTP_REFERER'])['path'] == "/append/loan.php"){
			header("location: ../loan.php?status=applied&contact_no=".$contact_no);
		}else{
			header("location: loan.php?");
		}
	}
?>