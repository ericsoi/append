<?php
	require_once'class.php';
  $db=new db_class();
  foreach($_POST as $x => $val) {
      print_r(explode('name', $x));
      $date = explode("name",$x)[0];
      $loan_id = explode("name",$x)[1];
      $payment = explode("name",$x)[2];

      $db->conn->query("UPDATE `loan_schedule` SET `status`='1', `amount_paid`='$payment' WHERE `loan_id`='$loan_id' AND `due_date`='$date'") or die($db->conn->error);
    }
    header('Location: ' . $_SERVER['HTTP_REFERER'] . '?updated=loans updated successfully');

?>