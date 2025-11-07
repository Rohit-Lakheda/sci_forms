<?php
// $servername = "localhost";
// $dbusername = "bengaluruite";
// $dbpassword = "Disl#vhfj#Af#DhW65";
// $dbname     = "bengaluruite";

// // Create mysqli connection
// $link = new mysqli($servername, $dbusername, $dbpassword, $dbname);

// // Check connection
// if ($link->connect_error) {
//     die("Connection failed: " . $link->connect_error);
// }
// require "dbcon_open.php";

function sendApiRequest($data) {
    // API Endpoint
    $url = 'https://edge.metroleads.com/callbacks/forms/MMactiv/companies/f6e80d20-4454-49f7-b334-4f8aca8634f3';

    // Initialize cURL
    $ch = curl_init($url);

    // Set cURL options
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/json'
    ]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Execute request
    $response = curl_exec($ch);

    // Check for errors
    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);

         // Save to database with Error
         saveApiLog($data, $error, 'Error');

        return [
            "success" => false,
            "message" => "cURL Error: $error"
        ];
    }
 // Save the successful response to the database
 saveApiLog($data, $response, 'Success');

    // Close cURL
    curl_close($ch);

    // Return response
    return [
        "success" => true,
        "response" => $response
    ];
}

// Function to save API request and response into database
function saveApiLog($requestData, $responseData, $status) {
    global $link; // Use the DB connection from dbcon_open.php
    if (!$link) {
        die("Database connection failed: " . mysqli_connect_error());
    }
    
    // Prepare the statement
    if (!$stmt = $link->prepare("INSERT INTO metroleads_api (request_data, response_data, status) VALUES (?, ?, ?)")) {
        die("Prepare statement failed: " . $link->error);
    }
    
    // Convert request data and response data to JSON format
    $requestJson = json_encode($requestData);
    $responseJson = json_encode($responseData);

    // Bind parameters
    $stmt->bind_param("sss", $requestJson, $responseJson, $status);

    // Execute the statement
    $stmt->execute();
    $stmt->close();
}

?>
