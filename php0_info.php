<?php
// Show all information, defaults to INFO_ALL
// phpinfo();

//list file of /etc/httpd also display type of file type
$files = scandir('/etc/httpd/conf/');
foreach ($files as $file) {
    $filePath = '/etc/httpd/' . $file;
    $fileType = filetype($filePath);
    echo "File: $file | Type: $fileType<br>";
}
$confFile = '/etc/httpd/conf/extra';
$confContent = file_get_contents($confFile);
echo "<pre>";
echo $confContent;
echo "</pre>";
// $files = scandir('/var/www/error/');
// echo "<pre>";
// print_r($files);
// echo "</pre>";
//open conf file of httpd
// $conf = file_get_contents('/etc/httpd/conf/httpd.conf');
// echo "<pre>";
// print_r($conf);
// echo "</pre>";

// phpinfo();
