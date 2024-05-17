<?php
include '/var/www/matrick/dashboard/class.php';
$db=new db_class(); 
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
$currentDate = date("Y-m-d H:m:s");
$newDate = date("Y-m-d", strtotime($currentDate));
$tbl_unpaid=$db->conn->query("SELECT * FROM `loan` INNER JOIN `borrower` ON borrower.borrower_id = loan.borrower_id INNER JOIN  `loan_plan` ON loan_plan.lplan_id = loan.lplan_id WHERE loan.paid_amount < CAST(((loan_plan.lplan_interest/100 * loan.amount) + loan.amount) AS FLOAT) AND NOT `loan_id` IN (SELECT `loan_id` FROM `payment` WHERE DATE(`date_created`) = '$newDate') AND `status` IS NOT NULL");


// Check if there are rows returned from the query
if ($tbl_unpaid->num_rows > 0) {
    // Initialize an empty array to store the fetched data
    $databaseData = array();

    while ($row = $tbl_unpaid->fetch_assoc()) {
        // Append each row to the $databaseData array
        $databaseData[] = $row;
    }

    // Create a table with the fetched data
    $tableHtml = '<div style="margin: 20px auto; width: 100%; font-family: Arial, sans-serif;">';
    $tableHtml .= '<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid #dee2e6; border-radius: 0.25rem;">';
    $tableHtml .= '<thead style="background-color: #f8f9fa; color: #212529;">';
    $tableHtml .= '<tr>';
    $tableHtml .= '<th style="padding: 8px; border: 1px solid #dee2e6;">Names</th>';
    $tableHtml .= '<th style="padding: 8px; border: 1px solid #dee2e6;">Contact</th>';
    $tableHtml .= '<th style="padding: 8px; border: 1px solid #dee2e6;">Contact_2</th>';
    $tableHtml .= '<th style="padding: 8px; border: 1px solid #dee2e6;">Address</th>';
    $tableHtml .= '<th style="padding: 8px; border: 1px solid #dee2e6;">Date Approved</th>';
    $tableHtml .= '</tr>';
    $tableHtml .= '</thead>';
    $tableHtml .= '<tbody>';

    foreach ($databaseData as $row) {
        $tableHtml .= '<tr>';
        $tableHtml .= '<td style="padding: 8px; border: 1px solid #dee2e6;">' . $row['firstname'] . ' ' . $row['middlename'] . ' ' . $row['lastname'] . '</td>';
        $tableHtml .= '<td style="padding: 8px; border: 1px solid #dee2e6;">' . $row['contact_no'] . '</td>';
        $tableHtml .= '<td style="padding: 8px; border: 1px solid #dee2e6;">' . $row['email'] . '</td>';
        $tableHtml .= '<td style="padding: 8px; border: 1px solid #dee2e6;">' . $row['address'] . '</td>';
        $tableHtml .= '<td style="padding: 8px; border: 1px solid #dee2e6;">' . $row['date_released'] . '</td>';
        $tableHtml .= '</tr>';
    }

    $tableHtml .= '</tbody>';
    $tableHtml .= '</table>';
    $tableHtml .= '</div>';
} else {
    // Handle the case when no rows are returned from the query
    $tableHtml = '<div style="margin: 20px auto; width: 100%; font-family: Arial, sans-serif;">';
    $tableHtml .= '<div style="padding: 20px; background-color: #f8f9fa; color: #721c24; border: 1px solid #f5c6cb; border-radius: 0.25rem;">';
    $tableHtml .= 'No data found.';
    $tableHtml .= '</div>';
    $tableHtml .= '</div>';
}

// Your existing code to create $tableHtml_yesterday goes here...

// Your existing code to send the email goes here...



if ($tbl_unpaid_yesterday->num_rows > 0) {
    // Initialize an empty array to store the fetched data
    $databaseData_yesterday = array();

    while ($row1 = $tbl_unpaid_yesterday->fetch_assoc()) {
        // Append each row to the $databaseData array
        $databaseData_yesterday[] = $row1;
    }

    // Create a table with the fetched data
    $tableHtml_yesterday = '<div style="margin: 20px auto; width: 100%; font-family: Arial, sans-serif;">';
    $tableHtml_yesterday .= '<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px; border: 1px solid #dee2e6; border-radius: 0.25rem;">';
    $tableHtml_yesterday .= '<thead style="background-color: #f8f9fa; color: #155724;">';
    $tableHtml_yesterday .= '<tr>';
    $tableHtml_yesterday .= '<th style="padding: 8px; border: 1px solid #dee2e6;">Names</th>';
    $tableHtml_yesterday .= '<th style="padding: 8px; border: 1px solid #dee2e6;">Contact</th>';
    $tableHtml_yesterday .= '<th style="padding: 8px; border: 1px solid #dee2e6;">Contact_2</th>';
    $tableHtml_yesterday .= '<th style="padding: 8px; border: 1px solid #dee2e6;">Address</th>';
    $tableHtml_yesterday .= '<th style="padding: 8px; border: 1px solid #dee2e6;">Date Approved</th>';
    $tableHtml_yesterday .= '</tr>';
    $tableHtml_yesterday .= '</thead>';
    $tableHtml_yesterday .= '<tbody>';

    foreach ($databaseData_yesterday as $row1) {
        $tableHtml_yesterday .= '<tr>';
        $tableHtml_yesterday .= '<td style="padding: 8px; border: 1px solid #dee2e6;">' . $row1['firstname'] . ' ' . $row1['middlename'] . ' ' . $row1['lastname'] . '</td>';
        $tableHtml_yesterday .= '<td style="padding: 8px; border: 1px solid #dee2e6;">' . $row1['contact_no'] . '</td>';
        $tableHtml_yesterday .= '<td style="padding: 8px; border: 1px solid #dee2e6;">' . $row1['email'] . '</td>';
        $tableHtml_yesterday .= '<td style="padding: 8px; border: 1px solid #dee2e6;">' . $row1['address'] . '</td>';
        $tableHtml_yesterday .= '<td style="padding: 8px; border: 1px solid #dee2e6;">' . $row1['date_released'] . '</td>';
        $tableHtml_yesterday .= '</tr>';
    }

    $tableHtml_yesterday .= '</tbody>';
    $tableHtml_yesterday .= '</table>';
    $tableHtml_yesterday .= '<hr>';
    $tableHtml_yesterday .= '</div>';
} else {
    // Handle the case when no rows are returned from the query
    $tableHtml_yesterday = '<div style="margin: 20px auto; width: 100%; font-family: Arial, sans-serif;">';
    $tableHtml_yesterday .= 'All loans paid yesterday';
    $tableHtml_yesterday .= '</div>';
    $tableHtml_yesterday .= '<hr>';
    $tableHtml_yesterday .= '</div>';
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
    $mail->Password   = "dvqsrjqmdvufiorz";

    //Recipients
    $mail->setFrom('matrickcredit@gmail.com', 'Matrick Credit');
    $mail->addAddress('kyalomartin1990@gmail.com', 'Matrick Admin');     //Add a recipient
    $mail->addReplyTo('matrickcredit@gmail.com', 'Matrick Credit');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Unpaid Loans';
    $mail->Body = $yesterday . '<br/><b>Yesterday\'s unpaid loans</b><br/>' . $tableHtml_yesterday.'<br/><br/>' .$humanReadableDate .'<br/><b>Today\'s Unpaid loans </b><br/><br/>' . $tableHtml;
    // $mail->Body    = "<b>$names</b> of phone number <b>$contact_no </b>has requested a loan of <b>$loan_amount</b> on <b>$date_created</b>";
    // $mail->AltBody = 'Test mail body from matrick.co.ke';
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
