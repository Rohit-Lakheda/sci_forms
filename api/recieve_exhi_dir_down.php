<?php

// Read the JSON data from the request body
$json_data = file_get_contents('php://input');

// Decode JSON data
$data = json_decode($json_data, true);

// Check if data is valid
if ($data === null) {
    http_response_code(400);
    echo json_encode(array("message" => "Invalid JSON data"));
    exit();
}

// Include database connection
require 'dbcon_open.php';

// Prepare SQL statement to insert data into exhibitors table
$sql_insert = "INSERT INTO exhibitors (exhibitor_id, exhibitor_name, cp_desig, logo, fascia_name, cp_title, cp_fname, cp_lname, focused_sector, country_code, mob, email, website, address_line_1, address_line_2, city, state, country, zip, category, exhi_profile)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

// Prepare and bind parameters for insertion
$stmt_insert = $link->prepare($sql_insert);
$stmt_insert->bind_param("sssssssssssssssssssss", $data['exhibitor_id'], $data['exhibitor_name'], $data['cp_desig'], $data['logo'], $data['fascia_name'], $data['cp_title'], $data['cp_fname'], $data['cp_lname'], $data['focused_sector'], $data['country_code'], $data['mob'], $data['email'], $data['website'], $data['address_line_1'], $data['address_line_2'], $data['city'], $data['state'], $data['country'], $data['zip'], $data['category'], $data['exhi_profile']);

// Execute the insertion statement
$insert_success = $stmt_insert->execute();

// Log the insertion status
$log_message = $insert_success ? "Data inserted successfully" : "Error inserting data: " . $link->error;
$log_sql = "INSERT INTO exhibitor_api_log (message, status, receive_data) VALUES (?, ?, ?)";
$stmt_log = $link->prepare($log_sql);
$status = $insert_success ? "success" : "failed";
$stmt_log->bind_param("sss", $log_message, $status, $json_data);
$stmt_log->execute();

// Close log statement
$stmt_log->close();

// Close insertion statement
$stmt_insert->close();

// Close database connection
$link->close();

// Return response based on insertion status
if ($insert_success) {
    http_response_code(201);
    echo json_encode(array("message" => $log_message));
} else {
    http_response_code(500);
    echo json_encode(array("message" => $log_message));
}

?>
