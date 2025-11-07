<?php 
require 'vendor/autoload.php';
require 'constants.php';
require 'dbcon.php';
require 'functions.php';
ini_set('display_errors', 0);

use PhpOffice\PhpSpreadsheet\IOFactory;

// Path to the Excel file
$inputFileName = 'Student Data.xlsx';

try {
    // Load the spreadsheet file
    $spreadsheet = IOFactory::load($inputFileName);
    $sheet = $spreadsheet->getActiveSheet();

    // Retrieve headers (assuming headers are in the first row)
    $headers = [];
    foreach ($sheet->getRowIterator(1, 5)->current()->getCellIterator() as $cell) {
        $headers[] = $cell->getValue();
    }

    // Array to hold all rows of data
    $allData = [];

    // Loop through each data row starting from the second row (skipping header)
    foreach ($sheet->getRowIterator(2) as $row) {
        $rowData = [];
        
        foreach ($row->getCellIterator() as $cell) {
            $value = $cell->getValue();
            if (\PhpOffice\PhpSpreadsheet\Shared\Date::isDateTime($cell)) {
                $value = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)->format('d M Y');
            }
            $rowData[] = $value;
        }

        // Store each row’s data in $allData array
        $allData[] = array_combine($headers, $rowData);

        // Optional: Check and insert into the database based on email
        $email = $rowData[2]; // Adjust index based on which column holds the email
        $emailExists = checkEmailExists($email); // Define this function to check your database
        if ($emailExists != 1) {
            // Insert row data into database
             insertRowData($rowData); // Define this function to handle insertion
        }
    }

    // Output all data for debugging
    //print_r($allData);

} catch (Exception $e) {
    echo 'Error loading file: ', $e->getMessage();
}

// Helper function to check if email exists in the database
function checkEmailExists($email) {
    global $link; // Ensure $link is available in this function (or pass it as a parameter)
    global $EVENT_DB_FORM_REG;

    // Sanitize the email to prevent SQL injection
    $email = mysqli_real_escape_string($link, $email);

    // SQL query to check if email exists in any of the email columns
    $query = "SELECT COUNT(*) as count FROM {$EVENT_DB_FORM_REG}
              WHERE email1 = '$email' 
              OR email2 = '$email' 
              OR email3 = '$email' 
              OR email4 = '$email' 
              OR email5 = '$email' 
              OR email6 = '$email' 
              OR email7 = '$email'";
//echo $query;
    // Execute the query
    $result = mysqli_query($link, $query);
    

    // Check if the query was successful
    if (!$result) {
        echo "Database query failed: " . mysqli_error($link);
        return false; // Consider email as non-existing if query fails
    }

    // Fetch the result
    $res = mysqli_fetch_assoc($result);
   // print_r($res);

    return $res['count'] > 0;
    // Return true if count is greater than 0, indicating email exists
    
}



function map_columns($columns) {
    $tin_no =  generateTinNo();
    $pin_no =  generatePinNo();
    // Map each index of the input array to a specific column in the database
    $mapped_columns = [
        'fname1' => $columns[0],
        'lname1' => $columns[1],
        'email1' => $columns[2],
        'cellno1' => $columns[3],
        'cata1' => $columns[4],
        'org' => $columns[5],
        'job_title1' => $columns[6],
        'event_name' => $columns[7],
        'reg_date' => $columns[8],
        'reg_time' => $columns[9],
        'selection_amt' => $columns[10],
        'membership_discount' => $columns[11],
        'gr_discount' => $columns[12],
        'admin_discount' => $columns[13],
        'tax' => $columns[14],
        'processing_charge' => $columns[15],
        'total' => $columns[16],
        'total_amt_received' => $columns[17],
        'city' => $columns[18],


        // Additional fields with default values
        'cata' => $columns[4],
        'nationality' => $columns[19] ?? 'Indian Organization',
        'curr' => $columns[20] ?? 'Indian',
        'amt_ext' => $columns[21] ?? 'Rs.',
        'gr_type' => $columns[22] ?? 'Single',
        'sub_delegates' => $columns[23] ?? '1',
        'paymode' => $columns[24] ?? 'Online',
        'pay_status' => $columns[25] ?? 'Paid',
        'pin_no' => $pin_no,
        'sp_msg' => 'Imported From Excel',
        'tin_no' => $tin_no,
        'adminDiscountPer' => ($columns[13] / $columns[10]) * 100,
        'amt1' => $columns[10],
        'badge1' => $columns[0]. " " . $columns[1],
    ];

    return $mapped_columns;
}

function insertRowData($rowData) {
    require 'constants.php';
    global $link;
    global $EVENT_DB_FORM_REG;

    // Map and sanitize the data
    $sanitizedRowData = array_map(function($value) use ($link) {
        return mysqli_real_escape_string($link, $value);
    }, map_columns($rowData));

    // Construct the SQL query to insert the data
    $columns = implode(', ', array_keys($sanitizedRowData));
    $values = "'" . implode("', '", $sanitizedRowData) . "'";

    $query = "INSERT INTO {$EVENT_DB_FORM_REG} ($columns) VALUES ($values)";
    //echo $query;
    
    // Execute the query (uncomment to perform actual insertion)
    //$result = mysqli_query($link, $query);

    $email1 = $sanitizedRowData['email1'];

    $sql2 = "SELECT * FROM {$EVENT_DB_FORM_REG} WHERE email1 = '{$email1}'";

    $result = mysqli_query($link, $sql2);
    $res = mysqli_fetch_assoc($result);
            

            require 'emailer_reg.php';
            $recipients = array($email1, 'test.interlinks@gmail.com');

            echo $mail_body;

           
            elastic_mail("Thank you for Registration with " . $EVENT_NAME . " " . $EVENT_YEAR, $mail_body, $recipients);

    // Check if the query was successful
    /*if (!$result) {
        echo "Database query failed: " . mysqli_error($link);
    }*/
}

