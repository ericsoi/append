<?php
	require_once'class.php';
  $db=new db_class();
  if(ISSET($_POST["update_schedule"])){
    UNSET($_POST["update_schedule"]);
    print_r($_POST);
    foreach($_POST as $x => $val) {
        echo "<br/>";
        $date = explode("name",$val)[0];
        $loan_id = explode("name",$val)[1];
        $payment = explode("name",$val)[2];
        $payee = explode("name",$val)[3];
        $penalty = 0;
        $overdue = 0;
        $payment_date = date('Y-m-d H:i:s', strtotime($date));
        echo $payee;
        $db->conn->query("UPDATE `loan_schedule` SET `status`='1', `amount_paid`='$payment' WHERE `loan_id`='$loan_id' AND `due_date`='$date'") or die($db->conn->error);
        $db->save_payment1($loan_id, $payee, $payment, $penalty, $overdue, $payment_date);
        $sum_payment=$db->conn->query("SELECT SUM(pay_amount) FROM `payment` INNER JOIN `loan` ON payment.loan_id=loan.loan_id WHERE loan.loan_id = $loan_id");
        $sum_fetch=$sum_payment->fetch_array();
        $db->conn->query("UPDATE `loan` SET `paid_amount`='$sum_fetch[0]' WHERE `loan_id`='$loan_id'") or die($db->conn->error);

      }
      header('Location: ' . $_SERVER['HTTP_REFERER'] . '?updated=loans updated successfully');
  }
  if(ISSET($_GET["reset_schedule"])){
    $month=$_GET['lplan_month'];
    $date_released = $_GET['date_released'];
    $loan_id =$_GET['loan_id'];
    $db->conn->query("DELETE FROM `loan_schedule` WHERE `loan_id`='$loan_id'") or die($db->conn->error);
    for($i=0; $i<$month; $i++){
      $date_schedule=date("Y-m-d", strtotime($date_released."+".$i."day"));
      $db->save_date_sched($loan_id, $date_schedule);
    }
    $tbl_schedule=$db->conn->query("SELECT * FROM `payment` WHERE `loan_id`='$loan_id'") or die($db->conn->error);
    while($row=$tbl_schedule->fetch_array()){
      $date_schedule=date('Y-m-d', strtotime($row["date_created"]));
      $amount_paid= $row['pay_amount'];
      $db->conn->query("UPDATE `loan_schedule` SET `status`='1', `amount_paid`='$amount_paid' WHERE `loan_id`='$loan_id' AND `due_date`='$date_schedule'") or die($db->conn->error);
    }

    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?updated=schedule updated successfully');

  }

?>