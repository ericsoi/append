<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bootstrap Table Example</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
<?php
require_once'/var/www/matrick/dashboard/class.php';
$db=new db_class(); 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
$tbl_unpaid = $db->conn->query("SELECT * from `loan` INNER JOIN `borrower` on borrower.borrower_id = loan.borrower_id INNER JOIN `loan_plan` on loan_plan.lplan_id = loan.lplan_id WHERE NOT `loan_id` IN (SELECT `loan_id` FROM `payment` WHERE DATE(`date_created`) = DATE(DATE_SUB(NOW(), INTERVAL 13 HOUR)))
AND `status` IS NOT NULL");$tbl_unpaid_yesterday = $db->conn->query("SELECT * from `loan` INNER JOIN `borrower` on borrower.borrower_id = loan.borrower_id INNER JOIN  `loan_plan` on loan_plan.lplan_id = loan.lplan_id where NOT `loan_id` in (select `loan_id` from `payment` WHERE DATE(`date_created`) = DATE(DATE_SUB(NOW(), INTERVAL 1 DAY))) AND `status` IS NOT NULL");

// Check if there are rows returned from the query
if ($tbl_unpaid->num_rows > 0) {
    // Initialize an empty array to store the fetched data
    $databaseData = array();

    while ($row = $tbl_unpaid->fetch_assoc()) {
        // Append each row to the $databaseData array
        $databaseData[] = $row;
    }

    // Create a table with the fetched data
    $tableHtml = '<div class="table-responsive"><table class="table table-success table-bordered table-striped table-hover">';
    $tableHtml .= '<thead class="thead-light"><tr><th scope="col">Names</th><th scope="col">Contact</th><th scope="col">Contact_2</th><th scope="col">Address</th><th scope="col">Date Approved</th></tr></thead><tbody>';

    foreach ($databaseData as $row) {
        $tableHtml .= '<tr scope="row">';
        $tableHtml .= '<td>' . $row['firstname'] . ' ' . $row['middlename'] .' '.$row['lastname'] . '</td>';
        $tableHtml .= '<td>' . $row['contact_no'] . '</td>';
        $tableHtml .= '<td>' . $row['email'] . '</td>';
        $tableHtml .= '<td>' . $row['address'] . '</td>';
        $tableHtml .= '<td>' . $row['date_released'] . '</td>';
        $tableHtml .= '</tr>';
    }

    $tableHtml .= '</tbody></table></div>';
} else {
    // Handle the case when no rows are returned from the query
    $tableHtml = '<div class="alert alert-warning" role="alert">No data found.</div>';
}

if ($tbl_unpaid_yesterday->num_rows > 0) {
    // Initialize an empty array to store the fetched data
    $databaseData_yesterday = array();

    while ($row1 = $tbl_unpaid_yesterday->fetch_assoc()) {
        // Append each row to the $databaseData array
        $databaseData_yesterday[] = $row1;
    }

    // Create a table with the fetched data
    $tableHtml_yesterday = '<div class="table-responsive"><table class="table table-bordered table-striped">';
    $tableHtml_yesterday .= '<thead class="thead-light"><tr><th scope="col">Names</th><th scope="col">Contact</th><th scope="col">Contact_2</th><th scope="col">Address</th><th scope="col">Date Approved</th></tr></thead><tbody>';

    foreach ($databaseData_yesterday as $row1) {
        $tableHtml_yesterday .= '<tr scope="row">';
        $tableHtml_yesterday .= '<td>' . $row1['firstname'] . ' ' . $row1['middlename'] .' '.$row1['lastname'] . '</td>';
        $tableHtml_yesterday .= '<td>' . $row1['contact_no'] . '</td>';
        $tableHtml_yesterday .= '<td>' . $row1['email'] . '</td>';
        $tableHtml_yesterday .= '<td>' . $row1['address'] . '</td>';
        $tableHtml_yesterday .= '<td>' . $row1['date_released'] . '</td>';
        $tableHtml_yesterday .= '</tr>';
    }

    $tableHtml_yesterday .= '</tbody></table></div><hr>';
} else {
    // Handle the case when no rows are returned from the query
    $tableHtml_yesterday = '<div class="alert alert-info" role="alert">All loans paid yesterday</div><hr>';
}


$date = date('Y-m-d H:i:s'); // Replace this with your date variable
$humanReadableDate = date('F j, Y, g:i a', strtotime($date));

$oneDayAgo = date('Y-m-d H:i:s', strtotime($date) - 86400); // 86400 seconds in a day
$yesterday = date('F j, Y, g:i a', strtotime($oneDayAgo));


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug  = 1;  
    $mail->isSMTP();         
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "matrickcredit@gmail.com";
    $mail->Password   = "fwlrhrwyygboxpqi";

    //Recipients
    $mail->setFrom('matrickcredit@gmail.com', 'Matrick Credit');
    $mail->addAddress('ericksoi3709@gmail.com', 'Matrick Developer');     //Add a recipient
    // $mail->addAddress('kyalomartin1990@gmail.com', 'Matrick Admin');     //Add a recipient

    $mail->addReplyTo('matrickcredit@gmail.com', 'Matrick Credit');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Unpaid Loans';
    $mail->Body = $yesterday . '<br/>Yesterday\'s unpaid loans<br/><br/>' . $tableHtml_yesterday.'<br/><br/><br/>' .$humanReadableDate .'<br/>Today\'s Unpaid loans <br/><br/>' . $tableHtml;
    // $mail->Body    = "<b>$names</b> of phone number <b>$contact_no </b>has requested a loan of <b>$loan_amount</b> on <b>$date_created</b>";
    // $mail->AltBody = 'Test mail body from matrick.co.ke';
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
</body>
</html>