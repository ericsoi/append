<?php
include '../class.php';
$db=new db_class();
try {
    $result = $db->conn->query("UPDATE loan SET `totalAmount` = 30/100*CAST(`amount` as FLOAT) + CAST(`amount` as FLOAT)");
    print_r($result);
} catch (Exception $th) {
    print_r($e);
}

?>