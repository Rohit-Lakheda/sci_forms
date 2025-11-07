<?php
// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $headers = getallheaders();

    $postData = json_decode($postData, true);
    if ($postData) {
    // echo "HI";
    // die;
    $postData = file_get_contents('php://input');
   
    //store all postData into a file
    $file = 'webhook_data.json';
    file_put_contents($file, ($postData));

    // Convert the data to JSON
    // $jsonResponse = ($postData);
    // //store this response in a file
    // $file = 'webhook_response23.json';
    // file_put_contents($file, $jsonResponse);


    // Set the Content-Type header to application/json
    header('Content-Type: application/json');

    // Send the JSON response
    }
    else {
        echo "Failed to decode JSON data";
    }
} else {
    // If the request method is not GET, return a 405 Method Not Allowed error
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
