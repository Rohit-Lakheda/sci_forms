<?php
exit;
ini_set('display_errors', 1);
require "includes/form_constants_both.php";

/*
{"api_key":"scan626246ff10216s477754768osk","event_id":"117859","name":"test test","email":"test@dfdtest.com","country_code":"91","mobile":"3242342343","company":"testrer","designation":"sdfsd@dfsd.com","category_id":"1885","qsn_366":"Delegate","country":"India"}
*/
$data = array(
    'api_key' => 'scan626246ff10216s477754768osk',
    'event_id' => '117859',
    'name' => 'Mr. Test testett',
    'category_id' => '1881',
    'email' => 'ceo1@test.com',
    'country_code' => '91',
    'mobile' => '1234567890',
    'company' => 'test',
    'designation' => 'Chief Executive Officer',
    'qsn_366' => 'Delegate',
    'country' => "India",
    'city' => "Chennai", 
);

echo sendchkdinapi($data);