<?php
	require_once'class.php';
  $db=new db_class();
  if(ISSET($_POST["update_schedule"])){
    foreach($_POST as $x => $val) {
        print_r(explode('name', $x));
        $date = explode("name",$x)[0];
        $loan_id = explode("name",$x)[1];
        $payment = explode("name",$x)[2];

        $db->conn->query("UPDATE `loan_schedule` SET `status`='1', `amount_paid`='$payment' WHERE `loan_id`='$loan_id' AND `due_date`='$date'") or die($db->conn->error);
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