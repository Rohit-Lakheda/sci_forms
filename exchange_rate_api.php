<?php
function getDollarRate()
{
    // $api_url = "https://v6.exchangerate-api.com/v6/303f4de10b784cbb27e4a065/latest/USD"; // Example API
    $api_url = "https://v6.exchangerate-api.com/v6/2cee7d43ad3628f2cb8dec29/latest/USD"; // New API
    $response = @file_get_contents($api_url);

    if ($response) {
        $data = json_decode($response, true);

        // Check if 'conversion_rates' and 'INR' exist in the response
        if (isset($data['conversion_rates']['INR'])) {
            return $data['conversion_rates']['INR']; // Get INR rate from the response
        }
    }

    return 87.5; // Default value if API fails
}

$DOLLAR_RATE = getDollarRate();
?>