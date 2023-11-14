<?php        
    include "./session.php";
    function generateOTP() {
        // Generate a random four-digit number
        $otp = rand(1000, 9999);
        return $otp;
    }
    if(ISSET($_POST['otp'])||ISSET($_GET["otp"])){
        $otp = generateOTP();
        $_SESSION['otp'] = $otp;
        include "../otp_mail.php";
        header("location: ./home.php?otp=true"); 
    }
?>