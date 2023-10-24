<?php
print_r($_POST);
require_once'class.php';
if(ISSET($_POST['save'])){

    // $startDate = date("Y-m-d H:i:s", strtotime($startDateString . ' 00:00:00'));

    $startDateString =$_POST['from'];
    $startDate = date("Y-m-d", strtotime($startDateString));
    $endDateString = $_POST['to'];
    $endDate = date("Y-m-d", strtotime($endDateString . ' +1 day'));
    echo $startDate;
    echo "<br>";
    echo $endDate;
    $db=new db_class();
    if ($_POST["status"]=="Complete Loans"){
        // $sum_payment=$db->conn->query("SELECT SUM(paid_amount), SUM(totalAmount), SUM(amount), count(*) FROM loan WHERE  paid_amount >= totalAmount AND (date_released BETWEEN '$startDate' AND '$endDate')");
        $sum_payment=$db->conn->query("SELECT SUM(paid_amount), SUM(totalAmount), SUM(amount), count(*) FROM loan WHERE CAST(paid_amount AS DECIMAL) >= CAST(totalAmount AS DECIMAL) AND date_released >= CAST('$startDate' AS DATE) AND date_released <= CAST('$endDate' AS DATE)");
        $sum_fetch=$sum_payment->fetch_array();
        print_r($sum_fetch);
        if ($sum_fetch[3]>0){
        // print_r($sum_fetch);
            $sum_amount_out =$sum_fetch[2];
            $sum_paid_amount = $sum_fetch[0];
            $total_loans= $sum_fetch[3];
            header('Location: reports.php?sum_amount_out='.$sum_amount_out.'&sum_paid_amount='.$sum_paid_amount.'&total_loans='.$total_loans.'&startDate='.$startDate.'&endDate='.$endDate);
        }else{
            header('Location: reports.php?status=no records&startDate='.$startDate.'&endDate='.$endDate);
        }
    }
    if ($_POST["status"]=="Active Loans"){
        // $sum_payment=$db->conn->query("SELECT SUM(paid_amount), SUM(totalAmount), SUM(amount), count(*) FROM loan WHERE  paid_amount < totalAmount AND (date_released BETWEEN '$startDate' AND '$endDate')");
        $sum_payment=$db->conn->query("SELECT SUM(paid_amount), SUM(totalAmount), SUM(amount), count(*) FROM loan WHERE CAST(paid_amount AS DECIMAL) < CAST(totalAmount AS DECIMAL) AND date_released >= CAST('$startDate' AS DATE) AND date_released <= CAST('$endDate' AS DATE)");

        $sum_fetch=$sum_payment->fetch_array();
        $sum_amount_out = $sum_fetch[2];
        $sum_totalAmount_out = $sum_fetch[1];
        $sum_paid_amount = $sum_fetch[0];
        $total_loans= $sum_fetch[3];
        if ($sum_fetch[3]>0){
            header('Location: reports.php?sum_amount_out='.$sum_amount_out.'&sum_totalAmount_out='.$sum_totalAmount_out.'&sum_paid_amount='.$sum_paid_amount.'&total_loans='.$total_loans.'&startDate='.$startDate.'&endDate='.$endDate);
        }else{
            header('Location: reports.php?status=no records&startDate='.$startDate.'&endDate='.$endDate);
        }
    }
}

?>

<!-- $sql = "SELECT * FROM your_table WHERE date_column BETWEEN '$startDate' AND '$endDate'"; -->
