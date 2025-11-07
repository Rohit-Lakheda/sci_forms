<?php
require_once 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('display_errors', 1);
function sendEmailBatch($batchSize = 10) {
    require "form_includes/form_constants_both.php";
    require "dbcon_open.php";
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $dbusername, $dbpassword);
    $stmt = $pdo->prepare("SELECT * FROM `" . $ENQUIRY_TBL_NAME . "` WHERE emailSent=0 LIMIT :limit");
    $limit = 10; // Set your desired limit
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->execute();
    $emails = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (empty($emails)) {
        echo "No emails to send\n";
        return;
    }

    // Setup PHPMailer
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host       = 'smtp.cdac.in';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'sci-expo@cdac.in';
    $mail->Password   = 'CdacblR12!@3456789';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->SMTPKeepAlive = true;
    $mail->setFrom('sci-expo@cdac.in', 'Super Computing India 2025');
    $mail->isHTML(true);

    foreach ($emails as $email) {
        try {
            $mail->clearAddresses();
            $mail->addAddress($email['email']);
            $mail->Subject = "Enquiry for " . $email['event_name'];

            // Construct the email body
            $enq_str = '';
            $enquiry_keys = ['enq1', 'enq2', 'enq3', 'enq4', 'enq5', 'enq6', 'enq7', 'enq8', 'enq9'];
            foreach ($enquiry_keys as $key) {
                if (!empty($email[$key])) {
                    $enq_str .= $email[$key] . ",";
                }
            }
            $enq_str = rtrim($enq_str, ',');

           

           
            $know_from = $email['know_from'];
            $comments = $email['comments'];
            
            
            $title = $email['title'] ?? '';
            $fname = $email['fname'] ?? '';
            $lname = $email['lname'] ?? '';
            $name = $email['name'] ?? '';
            $company = $email['org'] ?? '';
            $desig = $email['desig'] ?? '';
            $city = $email['city'] ?? '';
            $country = $email['country'] ?? '';
            $fone = $email['fone'] ?? '';
            $emailUser = $email['email'] ?? ''  ?? '';
          
            if(empty($fname) && empty($lname)){
                $name = $name;
            } else {
                $name = trim($fname . ' ' . $lname);
            }
           // echo $know_from, $comments;
           // exit;
            $enq_str = $enq_str;
            $EVENT_WEBSITE_LINK = $EVENT_WEBSITE_LINK;
            $EVENT_LOGO_EMAILER = $EVENT_LOGO_EMAILER;
            $EVENT_NAME = $EVENT_NAME;
            $EVENT_NAME1 = $EVENT_NAME1;
            $EVENT_YEAR = $EVENT_YEAR;
            $EVENT_DATE = $EVENT_DATE;
            $EVENT_FORM_LINK = $EVENT_FORM_LINK;
            $EVENT_LOGO_LINK1 = $EVENT_LOGO_LINK1;
            $EVENT_LOGO_URL = $EVENT_LOGO_URL;
            $EVENT_LOGO_EMAILER = $EVENT_LOGO_EMAILER;

            
            require "cron_enq_emailer_admin.php";
            require "cron_enq_emailer_user.php";

            //add $email['email'] to user mail
            $ENQUIRY_RECIPIENTS_USER_MAIL[] = $emailUser;

            

            //for each email in $ENQUIRY_RECIPIENTS_ADMIN_MAIL, send the email
            foreach ($ENQUIRY_RECIPIENTS_ADMIN_MAIL as $adminEmail) {
                if (!empty($adminEmail)) { // Check if the email is not empty or null
                    $mail->clearAddresses();
                    $mail->addAddress($adminEmail);
                    $mail->Subject = $ENQUIRY_FROM_SUBJECT_ADMIN_MAIL;
                    $mail->Body = $enq_mail_msg_admin;

                    if ($mail->send()) {
                        // Send user email only if admin email is sent successfully
                        foreach ($ENQUIRY_RECIPIENTS_USER_MAIL as $userEmail) {
                            if (!empty($userEmail)) { // Check if the email is not empty or null
                                $mail->clearAddresses();
                                $mail->addAddress($userEmail);
                                $mail->Subject = $ENQUIRY_FROM_SUBJECT_USER_MAIL;
                                $mail->Body = $enq_emailer_mail_msg_user;
                                if ($mail->send()) {
                                    // Update the database only if both emails are sent successfully
                                    $pdo->query("UPDATE `" . $ENQUIRY_TBL_NAME . "` SET emailSent=1 WHERE del_srno=" . $email['del_srno']);
                                }
                            }
                        }
                    }
                }
            }
            
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    $mail->smtpClose();
}

sendEmailBatch();
