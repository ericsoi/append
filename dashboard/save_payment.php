<?php
	// date_default_timezone_set("Etc/GMT+8");
	require_once'class.php';
	if(ISSET($_POST['save'])){
		$db=new db_class();
		$loan_id=$_POST['loan_id'];
		$payee=$_POST['payee'];
		$penalty=$_POST['penalty'];
		$payable=str_replace(",", "", $_POST['payable']);
		$payment=$_POST['payment'];
		$month=$_POST['month'];
		
		if($penalty == 0){
			$overdue=0;
		}else{
			$overdue=1;
		}
		
		
	
		// if($payable != $payment){
		// 	$i=1;
			// echo "<script>alert('Please enter a correct amount to pay!')</script>";
			// echo "<script>window.location='payment.php'</script>";	
	

			$originalDate = date("Y-m-d"); // Get the current date in "Y-m-d" format
			$date = date("Y-m-d", strtotime($originalDate . ' +0 day')); // Add one day

			// echo $date;
			// echo $loan_id;
			$db->save_payment($loan_id, $payee, $payment, $penalty, $overdue);
			$count_pay = $db->conn->query("SELECT * FROM `payment` WHERE `loan_id`='$loan_id'")->num_rows;
			
			if($count_pay===$month){
				$db->conn->query("UPDATE `loan` SET `status`='3' WHERE `loan_id`='$loan_id'") or die($db->conn->error);
			}
			 $sum_payment=$db->conn->query("SELECT SUM(pay_amount) FROM `payment` INNER JOIN `loan` ON payment.loan_id=loan.loan_id WHERE loan.loan_id = $loan_id");
			 $sum_fetch=$sum_payment->fetch_array();
			 $db->conn->query("UPDATE `loan` SET `paid_amount`='$sum_fetch[0]' WHERE `loan_id`='$loan_id'") or die($db->conn->error);
			 $db->conn->query("UPDATE `loan_schedule` SET `status`='1', `amount_paid`='$payment' WHERE `loan_id`='$loan_id' AND `due_date`='$date'") or die($db->conn->error);
			header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	
	
?>