<?php
	require_once'class.php';
	$db=new db_class();
	if(ISSET($_POST['update'])){
		$borrower_id=$_POST['borrower_id'];
		$firstname=$_POST['firstname'];
		$middlename=$_POST['middlename'];
		$lastname=$_POST['lastname'];
		$contact_no=$_POST['contact_no'];
		$address=$_POST['address'];
		$email=$_POST['email'];
		$tax_id=$_POST['tax_id'];
		$db->update_borrower($borrower_id,$firstname,$middlename,$lastname,$contact_no,$address,$email,$tax_id);
		echo"<script>alert('Update Borrower successfully')</script>";
		echo"<script>window.location='borrower.php'</script>";
	}
	if(ISSET($_POST["update_docs"])){
		$borrower_id = $_POST['borrower_id'];
		$contact_no = $_POST["contact_no"];
		$target_dir = $_SERVER['DOCUMENT_ROOT'] . "/append/uploads/" . $contact_no . "/";
		if( is_dir($target_dir) === false ){
			mkdir($target_dir, 0777, true);
		}
		if(isset($_FILES['id_doc'])){
			$id_doc = $target_dir . "id_doc_" . basename($_FILES['id_doc']["name"]);
			move_uploaded_file($_FILES['id_doc']['tmp_name'], $id_doc);
			
		}else{
			$id_doc = $target_dir . "id_doc_id.jpg";
		}
		if(isset($_FILES['id_doc_back'])){
			$id_doc_back = $target_dir . "id_doc_back_" . basename($_FILES['id_doc_back']["name"]);
			move_uploaded_file($_FILES['id_doc_back']['tmp_name'], $id_doc_back);
		}else{
			$id_doc_back = $target_dir . "id_doc_back_id.jpg";
		}
		if(isset($_FILES['signature_doc'])){
			$signature_doc = $target_dir . "signature_doc_" . basename($_FILES['signature_doc']["name"]);
			move_uploaded_file($_FILES['signature_doc']['tmp_name'], $signature_doc);
		}else{
			$signature_doc = $target_dir . "signature_doc_signature.jpg";
		}
		$id_doc = $id_doc . "_Splitter_" . $id_doc_back;
		$db->update_borrower_files($borrower_id,$id_doc,$signature_doc);
		// $db->update_borrower_files($borrower_id,$id_doc,$signature_doc);
		echo"<script>alert('Update Borrower Docs successfully')</script>";
		echo"<script>window.location='borrower.php'</script>";
	}
?>