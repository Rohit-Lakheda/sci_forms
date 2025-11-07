<?php


// Check if the request method is GET
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $headers = getallheaders();
    // $jsonResponse = '';
    // $jsonResponse .= json_encode(['headers' => $headers]);

if (isset($headers['Accesstoken'])) {

    $authCode = $headers['Accesstoken'];
    if ($authCode == '1234567') {
        // Authorization successful
        http_response_code(200);
        echo json_encode(['success' => 'Authorized']);
        // $jsonResponse .= json_encode(['success' => 'Authorized']);
    } else {
        // Authorization failed
        http_response_code(401);
        echo json_encode(['error' => 'Unauthorized1']);
        exit;
    }
} else {
    // No Authorization header sent
    http_response_code(401);
    echo json_encode(['error' => 'Unauthorized2']);
    $file = 'webhook_response.json';
    file_put_contents($file, $jsonResponse);

    exit;
}

    // $postData = json_decode(file_get_contents('php://input'), true);
    $postData = file_get_contents('php://input');

// Breakdown the postdata into key-value pairs
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];

    // create post data array for this exhibitor_id,exhibitor_name
    $postData = array(
        'exhibitor_id' => $_POST['exhibitor_id'],
        'exhibitor_name' => $_POST['exhibitor_name'],
        'cp_title' => $_POST['cp_title'],
        'cp_fname' => $_POST['cp_fname'],
        'cp_lname' => $_POST['cp_lname'],
        'cp_desig' => $_POST['cp_desig'],
        'cntry_code_mob' => $_POST['cntry_code_mob'],
        'mob' => $_POST['mob'],
        'email' => $_POST['email'],
        'website' => $_POST['website'],
        'address_line_1' => $_POST['address_line_1'],
        'address_line_2' => $_POST['address_line_2'],
        'city' => $_POST['city'],
        'state' => $_POST['state'],
        'country' => $_POST['country'],
        'zip' => $_POST['zip'],
        'exhi_profile' => $_POST['exhi_profile'],
        'booth_no' => $_POST['booth_no'],
        'fascia_name' => $_POST['fascia_name'],
        'category' => $_POST['category'],
        'logo' => $_POST['logo'],
        'focused_sector' => $_POST['focused_sector']
    );

    //concanetate this data and insert 
   
    $data = json_encode($postData);
    //store above variable in new webhooks_response.json file
    $file = 'webhook_response2.json';
    
    file_put_contents($file, $data);


    // Convert the data to JSON
    $jsonResponse .= $postData;

    //store this response in a file
    $file = 'webhook_response.json';
    file_put_contents($file, $jsonResponse);


    // Set the Content-Type header to application/json
    header('Content-Type: application/json');

    // Send the JSON response
    echo $jsonResponse;
} else {
    // If the request method is not GET, return a 405 Method Not Allowed error
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>
