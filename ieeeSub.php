<?php
require  'form_includes/form_constants_both.php';
session_start();
// ini_set('display_errors', 1);
require "dbcon_open.php"; // should define $link or $conn (MySQL connection)
include 'csrf_token.php';

// Function to validate CSRF token
function validateCsrfToken($token)
{
    return isset($_SESSION['csrf_token']) && $_SESSION['csrf_token'] === $token;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formToken = $_POST['csrf_token'] ?? '';

    // Optional CSRF check
    /*
    if (!validateCsrfToken($formToken)) {
        echo '<script type="text/javascript">
                alert("An error occurred. Please try again.");
                window.location.href = "https://sci25.supercomputingindia.org";
              </script>';
        exit;
    }
    */

    // Collect form data
    $ArtTitle  = $_POST['ArtTitle'] ?? '';
    $AuthName  = $_POST['AuthName'] ?? '';
    $ArtId     = $_POST['ArtId'] ?? '';
    $ArtSource = $_POST['ArtSource'] ?? '';
    $AuthEmail = $_POST['AuthEmail'] ?? '';
    $vercode   = $_POST['vercode'] ?? '';
    $test      = '';
    $rtrnurl   = $_POST['rtrnurl'] ?? '';

    // ✅ 1. Check if ArtId already exists
    $checkStmt = $link->prepare("SELECT 1 FROM articles WHERE ArtId = ?");
    if ($checkStmt) {
        $checkStmt->bind_param("s", $ArtId);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
//             $url = $EVENT_FORM_LINK . "ieeeReg.php";
             $url = 'http://192.168.30.111:1542/ieeeReg.php';
            // Article already exists
            echo '<script type="text/javascript">
                    alert("Article ID already exists. Please use a different ID.");
                    window.location.href = "'.$url.'";
                  </script>';
            $checkStmt->close();
            mysqli_close($link);
            exit;
        }
        $checkStmt->close();
    } else {
        echo '<script type="text/javascript">
                alert("Database error while checking for duplicates.");
              </script>';
        mysqli_close($link);
        exit;
    }

    // ✅ 2. Proceed with insert if no duplicate found
    $stmt = $link->prepare("INSERT INTO articles (ArtTitle, AuthName, ArtId, ArtSource, AuthEmail, vercode, test, rtrnurl)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    if ($stmt) {
        $stmt->bind_param("ssisssss",
            $ArtTitle,
            $AuthName,
            $ArtId,
            $ArtSource,
            $AuthEmail,
            $vercode,
            $test,
            $rtrnurl
        );

        if ($stmt->execute()) {
            // Save session info
            $_SESSION['ArtId'] = $ArtId;
            $_SESSION['AuthName'] = $AuthName;

            header("Location: ieeeSubmissionSuccess.php");
            exit;
        } else {
            echo '<script type="text/javascript">
                    alert("Database error: Unable to insert record.");
                  </script>';
        }

        $stmt->close();
    } else {
        echo '<script type="text/javascript">
                alert("Failed to prepare SQL statement.");
              </script>';
    }

    mysqli_close($link);
    exit;
}
?>
