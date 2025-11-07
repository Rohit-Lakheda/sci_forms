<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
require "dbcon_open.php";

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $promoCode = $link->real_escape_string($_POST['promoCode']);
    $attendeesCount = isset($_POST['attendeesCount']) ? (int)$_POST['attendeesCount'] : 1;

    // Check for hardcoded test promocode first
    if ($promoCode === 'TEST51') {
        $response = [
            'valid' => true,
            'discount' => 99, // 15% discount for testing
            'promoCode' => $promoCode,
            'message' => 'Promocode applied'
        ];
        echo json_encode($response);
        $link->close();
        exit;
    }

    // Use a case-sensitive collation
    $query = "SELECT * FROM promo_codes WHERE BINARY code = '$promoCode'";
    $result = $link->query($query);

    if ($result && $result->num_rows > 0) {
        $promo = $result->fetch_assoc();

        // Check if the promocode is active
        if ($promo['is_active'] == 1 && $promo['remaining'] > 0) {
            // Check if attendees count exceeds the remaining count
            if ($attendeesCount > $promo['remaining']) {
                $response = [
                    'valid' => false,
                    'message' => 'Invalid promocode'
                ];
            } else {
                $response = [
                    'valid' => true,
                    'discount' => $promo['discount'],
                    'promoCode' => $promoCode, // Return the promo code
                ];

                // Check if the ticket_flag is 1 and include ticket details
                if ($promo['ticket_flag'] == 1) {
                    $response['ticket_category'] = $promo['ticket_category'];
                    $response['venue'] = $promo['venue'];
                    $response['message'] = 'Promo code valid for ' . $promo['ticket_category'] . ' at ' . $promo['venue'] . '.';
                }
            }
        } else {
            $response = [
                'valid' => false,
                'message' => 'This promocode is no longer valid.'
            ];
        }
    } else {
        $response = [
            'valid' => false,
            'message' => 'Invalid promocode.'
        ];
    }

    echo json_encode($response);
    $link->close();
}
?>