<?php
date_default_timezone_set("Etc/GMT+8");
require_once'../dashboard/session.php';
require_once'../dashboard/class.php';
$db=new db_class(); 
if(ISSET($_POST['save'])){
    $db=new db_class();
    $firstname=$_POST['firstname'];
    $middlename=$_POST['middlename'];
    $lastname=$_POST['lastname'];
    $contact_no=$_POST['contact_no'];
    $address=$_POST['address'];
    $email=$_POST['email'];
    $tax_id=$_POST['tax_id'];
    $borrower=$db->get_borrower($contact_no);
    $fetch=$borrower->fetch_array();
    if ($fetch){
        header("Location: ../loan.php?status=exists&contact_no=" . $contact_no);
    }else{
        $db->save_borrower($firstname,$middlename,$lastname,$contact_no,$address,$email,$tax_id);
        header("Location: ../loan.php?status=success&contact_no=" . $contact_no);   
    }
}