<?php 
//setmax execution time
// ini_set('max_execution_time', 3000);
require 'dbcon_open.php';
// $tin_id = 'TIN-MHK2024-574156066';
//I have to fetch all tin_id from the database and send it to the API
//I will use the same function sendPaymentData() to send the data to the API

// $response = sendPaymentData($tin_id,$link);
// Fetch all tin_id from the database
// $query = "SELECT tin_no FROM sm_2024_reg_tbl WHERE pay_status = 'Paid'  AND srno > 0 AND srno < 1000";
$query = "SELECT tin_no FROM sm_2024_reg_tbl WHERE approved_status!='Pending' and srno > 25";

// $query = "SELECT tin_no FROM sm_2024_exhibitors_dir_payment_tbl WHERE pay_status = 'Paid' AND sector='Other'";
$result = mysqli_query($link, $query);
if(!$result){
    echo "Error: " . $query . "<br>" . mysqli_error($link);
    exit;
}
 require 'send_delegate_data.php';
// require 'send_exhibitors_data.php';

$tin_ids = [    
    "TIN-MHK2024-56369485",
    "TIN-MHK2024-563884309",
    "TIN-MHK2024-563938043",
    "TIN-MHK2024-565021623",
    "TIN-MHK2024-677667115",
    "TIN-MHK2024-709235467",
    "TIN-MHK2024-772042764",
    "TIN-MHK2024-785873238",
    "TIN-MHK2024-781732002",
    "TIN-MHK2024-79071034",
    "TIN-MHK2024-827654037",
    "TIN-MHK2024-855973467",
    "TIN-MHK2024-860314569",
    "TIN-MHK2024-923339571",
    "TIN-MHK2024-1006168356",
    "TIN-MHK2024-102082777",
    "TIN-MHK2024-1023547748",
    "TIN-MHK2024-1040571562",
    "TIN-MHK2024-1062047921",
    "TIN-MHK2024-107758317",
    "TIN-MHK2024-1092853608",
    "TIN-MHK2024-1176256473",
    "TIN-MHK2024-1186334373",
    "TIN-MHK2024-1196497092",
    "TIN-MHK2024-1252060951"
    // 'TIN-MHK2024-EXHST-SG-281387950'
    
];

// foreach ($tin_ids as $tin_id) {
//     $response = sendPaymentData($tin_id, $link);
//     // Process the response if needed
// }


// while ($row = mysqli_fetch_assoc($result)) {
//     $tin_id = $row['tin_no'];
    // $response = sendPaymentData($tin_id, $link);
    // echo $response;
//     // Process the response if needed
// }


// $tin_id = "TIN-MHK2024-623063116";
foreach ($tin_ids as $tin_id) {
    $response = sendPaymentData($tin_id, $link);
    // $response = sendExhibitordata($tin_id, $link);
    echo $response;
//     // Process the response if needed
}
