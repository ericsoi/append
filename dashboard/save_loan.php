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
		
		$db->save_loan($borrower,$ltype,$lplan,$loan_amount,$purpose, $date_created);		
		if(parse_url($_SERVER['HTTP_REFERER'])['path'] == "/append/loan.php"){
			header("location: ../loan.php?status=applied&contact_no=".$contact_no);
		}else{
			header("location: loan.php?");
		}
	}
?>