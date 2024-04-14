<?php
try{
    //Set the response content type to application/json
    header("Content-Type:application/json");
   
    $postData = file_get_contents('php://input');

    $jdata = json_decode($postData);
    
        $myfile = fopen($_SERVER['DOCUMENT_ROOT']."/transactions/success.log", "a") or die("Unable to open file!");
        fwrite($myfile, $postData);
        fwrite($myfile, "\r\n\n");
        fclose($myfile);

} catch (Exception $ex){
    //append exception to errorLog
    $logErr = fopen($_SERVER['DOCUMENT_ROOT'].'/transactions/error.log','a');
    fwrite($logErr, $ex->getMessage());
    fwrite($logErr,"\r\n\n");
    fclose($logErr);
}
    //echo response
?>