<?php
require_once'/var/www/matrick/dashboard/class.php';
$db=new db_class(); 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
$tbl_unpaid = $db->conn->query("SELECT * from `loan` INNER JOIN `borrower` on borrower.borrower_id = loan.borrower_id INNER JOIN `loan_plan` on loan_plan.lplan_id = loan.lplan_id WHERE NOT `loan_id` IN (SELECT `loan_id` FROM `payment` WHERE DATE(`date_created`) = DATE(DATE_SUB(NOW(), INTERVAL 6 HOUR)))
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
    $tableHtml = '<table border="1">';
    $tableHtml .= '<tr><th>Names</th><th>Contact</th><th>Contact_2</th><th>Address</th><th>Date Aproved</th></tr>';

    foreach ($databaseData as $row) {
        $tableHtml .= '<tr>';
        $tableHtml .= '<td>' . $row['firstname'] . ' ' . $row['middlename'] .' '.$row['lastname'] . '</td>';
        $tableHtml .= '<td>' . $row['contact_no'] . '</td>';
        $tableHtml .= '<td>' . $row['email'] . '</td>';
        $tableHtml .= '<td>' . $row['address'] . '</td>';
        $tableHtml .= '<td>' . $row['date_released'] . '</td>';
        $tableHtml .= '</tr>';
    }

    $tableHtml .= '</table>';
} else {
    // Handle the case when no rows are returned from the query
    $tableHtml = 'No data found.';
}

if ($tbl_unpaid_yesterday->num_rows > 0) {
    // Initialize an empty array to store the fetched data
    $databaseData_yesterday = array();

    while ($row1 = $tbl_unpaid_yesterday->fetch_assoc()) {
        // Append each row to the $databaseData array
        $databaseData_yesterday[] = $row1;
    }

    // Create a table with the fetched data
    $tableHtml_yesterday = '<table border="1">';
    $tableHtml_yesterday .= '<tr><th>Names</th><th>Contact</th><th>Contact_2</th><th>Address</th><th>Date Aproved</th></tr>';

    foreach ($databaseData_yesterday as $row1) {
        $tableHtml_yesterday .= '<tr>';
        $tableHtml_yesterday .= '<td>' . $row1['firstname'] . ' ' . $row1['middlename'] .' '.$row1['lastname'] . '</td>';
        $tableHtml_yesterday .= '<td>' . $row1['contact_no'] . '</td>';
        $tableHtml_yesterday .= '<td>' . $row1['email'] . '</td>';
        $tableHtml_yesterday .= '<td>' . $row1['address'] . '</td>';
        $tableHtml_yesterday .= '<td>' . $row1['date_released'] . '</td>';
        $tableHtml_yesterday .= '</tr>';
    }

    $tableHtml_yesterday .= '</table><hr>';
} else {
    // Handle the case when no rows are returned from the query
    $tableHtml_yesterday = 'All loans paid yesterday <hr>';
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
    $mail->Password   = "jflmaweyiulbrccy";

    //Recipients
    $mail->setFrom('matrickcredit@gmail.com', 'Matrick Credit');
    $mail->addAddress('ericksoi3709@gmail.com', 'Erick');     //Add a recipient
    $mail->addAddress('kyalomartin1990@gmail.com', 'Matrick Credit');     //Add a recipient

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