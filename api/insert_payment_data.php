<?php
require 'dbcon_open.php';
// Set headers
header("Content-Type: application/json");

// Get the JSON data sent
$paymentDataJSON = file_get_contents('php://input');

// Log or output the received data for testing purposes
file_put_contents('received_payment_data.log', $paymentDataJSON);

// Decode JSON data
$directory_data = json_decode($paymentDataJSON, true);

// Your logic to insert payment data into the database or perform any other actions
// Example:
// Assuming you have a function to insert payment data into the database
$result = insert_exhibitor_directory($directory_data,$link);

// Dummy response for demonstration
$result = array('success' => true, 'message' => 'Payment data received and inserted successfully.');

//result 


// Convert result to JSON
$resultJSON = json_encode($result);

// Output the JSON response
echo $resultJSON;

function insert_exhibitor_directory($data_exh,$link){
    print_r($data_exh);
foreach ($data_exh as $key => $value) {
    // Validate $key if it's a valid column name, you might need a stricter validation here
    if (!preg_match('/^[a-zA-Z_][a-zA-Z0-9_]*$/', $key)) {
        return array('success' => false, 'message' => 'Invalid column name');
    }

    // Sanitize $value, you might need a more sophisticated sanitization method
    $sanitized_value = mysqli_real_escape_string($link, $value);

    // Prepare the SQL statement
    $sql = "INSERT INTO sm_2024_exhibitors_dir_details_tbl_phase_1 (`$key`) VALUES (?)";
    $stmt = mysqli_prepare($link, $sql);

    // Bind the parameter and execute the statement
    mysqli_stmt_bind_param($stmt, 's', $sanitized_value);
    $result = mysqli_stmt_execute($stmt);

    // Check if the query was successful
    if (!$result) {
        return array('success' => false, 'message' => mysqli_error($link));
    }

    // Close the prepared statement
    mysqli_stmt_close($stmt);
}

// If all insertions were successful
return array('success' => true, 'message' => 'Data inserted successfully');
   
}

?>
