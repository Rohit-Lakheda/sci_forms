<?php 

require_once "form_includes/form_constants_both.php";

$subject = "Test Email";
$message = "This is a test email";
$to = ["manish.sharma@interlinks.in", "shikham@cdac.in"];
$frm = "sci-expo@cdac.in";

//calculate the time taken to send the email
$start_time = microtime(true);  
elastic_mail_frm($subject, $message, $to, $frm);
$end_time = microtime(true);
$time_taken = $end_time - $start_time;
echo "Time taken to send the email: " . $time_taken . " seconds";

// make a json file with the time taken to send the email 
$data = [
    "time_taken" => $time_taken
];
file_put_contents("email_time.json", json_encode($data));

// if the file email_time.json exists then append the data to the file
if (file_exists("email_time.json")) {
    $data = json_decode(file_get_contents("email_time.json"), true);
    $data["time_taken"] = $time_taken;
    file_put_contents("email_time.json", json_encode($data));
}

// if the file email_time.json does not exist then create the file and add the data
