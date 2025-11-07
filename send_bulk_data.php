<?php
ini_set('display_errors', 1);
require "includes/form_constants_both.php";

// max execution time
#ini_set('max_execution_time', 600);

// db con 
$servername = "localhost";
$username = "bengaluruite";
$password = "Disl#vhfj#Af#DhW65";
$dbname = "bengaluruite";

// Connect to MySQL
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Initialize batch processing
// $batch_size = 1;  // Process 100 rows per batch
// $offset = 0;        // Start from the first row

// while (true) {
// Fetch a batch of rows
// $sql = "SELECT * FROM it_2024_badge_data WHERE sent != 1 OR sent IS NULL LIMIT $offset, $batch_size";
$sql = "SELECT * FROM it_2024_reg_tbl WHERE tin_no = 'TIN-BTS2024-109079898'";

$result = mysqli_query($link,$sql);

if (!$result) {
    die("Error executing query: " . mysqli_error($link));
}

// Check if there are any rows left
if (mysqli_num_rows($result) == 0) {
    break;  // No more rows to process
}
$total_delegates = 0;
// Process the current batch
while ($row = mysqli_fetch_assoc($result)) {
    $lmt = (int) $row['sub_delegates'];
    $tin_no1 = $row['tin_no'];
    $total_delegates += $lmt;



    for ($i = 1; $i <= $lmt; $i++) {
        echo "id: " . " - Name: " . $row["fname" . $i] . " " . $row["lname" . $i] . " " . $row["email" . $i] . "<br>";
        $name = $row["fname" . $i] . " " . $row["lname" . $i];
        $email = $row["email" . $i];
        $mobile = $row["cellno" . $i];
        $company = $row["org"];
        $designation = $row["job_title" . $i];
        $country = $row["country"];
        $city = $row["city"];
        $qsn_366 = "Delegate";
        $category_id = "1886";
        $country_code = "91";

        $data = array(
            'api_key' => 'scan626246ff10216s477754768osk',
            'event_id' => '117859',
            'name' => $name,
            'category_id' => $category_id,
            'email' => $email,
            'country_code' => $country_code,
            'mobile' => $mobile,
            'company' => $company,
            'designation' => $designation,
            'qsn_366' => $qsn_366,
            'country' => $country,
            'city' => $city,
        );
        print_r($data);

        $api_result = sendchkdinapi($data);
        $api_result = json_decode($api_result);
        $guest_id = $api_result->guest_id;

        if ($api_result->status == 1) {
            $email = mysqli_real_escape_string($link,$email);

            // Build and execute the query
            $update_sql = "UPDATE it_2024_badge_data 
                        SET sent = 1, guest_id = $guest_id 
                        WHERE email = '$email'";

            if (mysqli_query($link,$update_sql)) {
                echo "Record updated successfully for " . $email . "<br>";
            } else {
                echo "Error updating record: " . mysqli_error($link) . "<br>";
            }
        } else {
            echo "Failed for " . $email . "<br>";
        }
    }
}

// Increment the offset for the next batch
//$offset += $batch_size;

// }

// Close connection
mysqli_close($conn);
?>