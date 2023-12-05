<?php
require_once'../dashboard/class.php';
$startDate = date("Y-m-d");
$endDate = date("Y-m-d", strtotime($startDate . ' +1 day'));
$currentDate = date("Y-m-d H:m:s");
echo $startDate;

//2023-12-01

$db=new db_class();
$sum_payment=$db->conn->query("SELECT SUM(paid_amount), SUM(totalAmount), SUM(amount), count(*) FROM loan WHERE CAST(paid_amount AS DECIMAL) < CAST(totalAmount AS DECIMAL) AND date_released >= CAST('$startDate' AS DATE) AND date_released <= CAST('$endDate' AS DATE)");
$sum_expected=$db->conn->query("SELECT SUM(amount + (amount * loan_plan.lplan_interest)/100)/26 from loan inner join loan_plan on loan.lplan_id = loan_plan.lplan_id where status = 2");
$sum_expected_fetch = $sum_expected->fetch_array();
$expected = $sum_expected_fetch[0];
$sum_fetch=$sum_payment->fetch_array();
$sum_amount_out = $sum_fetch[2];
$sum_totalAmount_out = $sum_fetch[1];
$sum_paid_amount = $sum_fetch[0];
$total_loans= $sum_fetch[3];

$remaining = $expected - $sum_paid_amount;
echo $remaining;

