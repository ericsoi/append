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
    $target_dir = $_SERVER['DOCUMENT_ROOT'] . "/uploads/docs/" . $contact_no . "/";
    if( is_dir($target_dir) === false ){
        mkdir($target_dir, 0777, true);
    }
    if(isset($_FILES['id_doc'])){
        $file_type=explode("/",$_FILES['id_doc']['type'])[0];
        if( $file_type=="image"){
            $id_doc = $target_dir . "id_doc_" . basename($_FILES['id_doc']["name"]);
            move_uploaded_file($_FILES['id_doc']['tmp_name'], $id_doc);
        }else{
            // echo parse_url($_SERVER['HTTP_REFERER'])['path'];
            header("Location: ../register.php?status=error&message=upload image files&phone_number=" . $contact_no."&firstname=".$firstname."&middlename=".$middlename."&lastname=".$lastname."&address=".$address."&second_number=".$email."&tax_id=".$tax_id);  
            exit;
        }
    }else{
        $id_doc = $target_dir . "id_doc_id.jpg";
    }
    if(isset($_FILES['id_doc_back'])){
        $file_type=explode("/",$_FILES['id_doc_back']['type'])[0];
        if( $file_type=="image"){
            $id_doc_back = $target_dir . "id_doc_back_" . basename($_FILES['id_doc_back']["name"]);
            move_uploaded_file($_FILES['id_doc_back']['tmp_name'], $id_doc_back);
        }else{
            // echo parse_url($_SERVER['HTTP_REFERER'])['path'];
            header("Location: ../register.php?status=error&message=upload image files&phone_number=" . $contact_no."&firstname=".$firstname."&middlename=".$middlename."&lastname=".$lastname."&address=".$address."&second_number=".$email."&tax_id=".$tax_id);  
            exit;
        }

    }else{
        $id_doc_back = $target_dir . "id_doc_back_id.jpg";

    }
    if(isset($_FILES['signature_doc'])){
        $file_type=explode("/",$_FILES['signature_doc']['type'])[0];
        if( $file_type=="image"){
            $signature_doc = $target_dir . "signature_doc_" . basename($_FILES['signature_doc']["name"]);
            move_uploaded_file($_FILES['signature_doc']['tmp_name'], $signature_doc);
        }else{
            // echo parse_url($_SERVER['HTTP_REFERER'])['path'];
            header("Location: ../register.php?status=error&message=upload image files&phone_number=" . $contact_no."&firstname=".$firstname."&middlename=".$middlename."&lastname=".$lastname."&address=".$address."&second_number=".$email."&tax_id=".$tax_id);  
            exit;

        }
    }else{
        $signature_doc = $target_dir . "signature_doc_signature.jpg";
    }
    $id_doc = $id_doc . "_Splitter_" . $id_doc_back;
    $borrower=$db->get_borrower($contact_no);
    $fetch=$borrower->fetch_array();
    if ($fetch){
        header("Location: ../loan.php?status=exists&message=exists&contact_no=" . $contact_no);
    }else{
        $db->save_borrower($firstname,$middlename,$lastname,$contact_no,$address,$email,$id_doc,$signature_doc,$tax_id);
        header("Location: ../loan.php?status=success&message=success&contact_no=" . $contact_no);   
    }
}
