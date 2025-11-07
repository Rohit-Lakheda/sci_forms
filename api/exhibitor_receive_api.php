<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Check for authorization with bearer token
    $headers = getallheaders();
    if (isset($headers['Authorization']) && strpos($headers['Authorization'], 'Bearer ') === 0) {
        $bearerToken = substr($headers['Authorization'], 7); // Adjusted to start from index 7
        
        // Your authorization logic here
        if ($bearerToken === '123456') { // Replace '123456' with your actual authorization token
            
            // Get the POST data
            $postData = json_decode(file_get_contents('php://input'), true);
            
            // Store the received data into a file
            $file = 'webhook_data_exhibitor.json';
            file_put_contents($file, json_encode($postData));
            
            // Prepare a response
            $response = json_encode(['message' => 'Data received successfully']);
            
            // Set the Content-Type header to application/json
            header('Content-Type: application/json');
            
            // Send the JSON response
            echo $response;
        } else {
            // If the bearer token is invalid, return a 401 Unauthorized error
            http_response_code(401);
            echo json_encode(['error' => 'Unauthorized']);
        }
    } else {
        // If the Authorization header is missing or not in the correct format, return a 401 Unauthorized error
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized']);
    }
} else {
    // If the request method is not POST, return a 405 Method Not Allowed error
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>