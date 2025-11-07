<?php
require 'dbcon_open.php';

/*
user_name
vivek@interlinks.in
info@iicf.in
anoopsgraphics@gmail.com
monika.mmactiv@gmail.com
Bangalore_INDIA_BIO_admin
Bangalore_Nano_admin
Bangalore_IT_admin
India_International_Coffee_Festival
EDGE_admin
MMActiv_admin
Agro_admin
ISC_admin
kaustubh@mmactiv.com
manish.sharma@interlinks.in
rajkumar.ukarande@mmactiv.com
gurunath.angadi@mmactiv.in
prabha.mmactiv@gmail.com
ambika.kiran@mmactiv.in
yogesh.kulkarni@interlinks.in
vani.faustina@mmactiv.com
narayan.kulkarni@mmactiv.in
milind.kokje@mmactiv.in
bhavyanavaneetha@gmail.com
priyamvada.bhide@mmactiv.com
samanth.anikar@mmactiv.com
enquiry@nuffoodsspectrum.in
jagdish.patankar@mmactiv.in
gurunath.angadi@mmactiv.com
sagar.patil@interlinks.in
juhi.mmactiv@gmail.com
navneet.kaur@mmactiv.com
manasee.kurlekar@mmactiv.com
tejaswini.patil@interlinks.in
marilyn.fernandes@mmactiv.com
ankit.kankar@mmactiv.com
agrovisiontc@gmail.com
adarsh.accounts@mmactiv.com
sankalp.singh@mmactiv.com
manager@medcindia.com
vibha.bhatia@mmactiv.com
sneha.singh@mmactiv.com
corpcomm@acecec.com
marketing@acecec.com
contact@acecec.com
vijay.mashalkar@mmactiv.com
hemalatha.br@mmactiv.com
ketan.lashkare@mmactiv.com
pm.ta@karnatakadigital.in
pm.bb@karnatakadigital.in
associate@karnatakadigital.in
operations.blr@mmactiv.com
anjali.shivananda@in.ey.com
rajshree.bhadauria@outlook.com
tejas.rashinkar@interlinks.in
harsh.kumar@interlinks.in
*/


$admin_name = [
    'vivek@interlinks.in',
    'info@iicf.in',
    'anoopsgraphics@gmail.com',
    'monika.mmactiv@gmail.com',
    'Bangalore_INDIA_BIO_admin',
    'Bangalore_Nano_admin',
    'Bangalore_IT_admin',
    'India_International_Coffee_Festival',
    'EDGE_admin',
    'MMActiv_admin',
    'Agro_admin',
    'ISC_admin',
    'kaustubh@mmactiv.com',
    'manish.sharma@interlinks.in',
    'rajkumar.ukarande@mmactiv.com',
    'gurunath.angadi@mmactiv.in',
    'prabha.mmactiv@gmail.com',
    'ambika.kiran@mmactiv.in',
    'yogesh.kulkarni@interlinks.in',
    'vani.faustina@mmactiv.com',
    'narayan.kulkarni@mmactiv.in',
    'milind.kokje@mmactiv.in',
    'bhavyanavaneetha@gmail.com',
    'priyamvada.bhide@mmactiv.com',
    'samanth.anikar@mmactiv.com',
    'enquiry@nuffoodsspectrum.in',
    'jagdish.patankar@mmactiv.in',
    'gurunath.angadi@mmactiv.com',
    'sagar.patil@interlinks.in',
    'juhi.mmactiv@gmail.com',
    'navneet.kaur@mmactiv.com',
    'manasee.kurlekar@mmactiv.com',
    'tejaswini.patil@interlinks.in',
    'marilyn.fernandes@mmactiv.com',
    'ankit.kankar@mmactiv.com',
    'agrovisiontc@gmail.com',
    'adarsh.accounts@mmactiv.com',
    'sankalp.singh@mmactiv.com',
    'manager@medcindia.com',
    'vibha.bhatia@mmactiv.com',
    'sneha.singh@mmactiv.com',
    'corpcomm@acecec.com',
    'marketing@acecec.com',
    'contact@acecec.com',
    'vijay.mashalkar@mmactiv.com',
    'hemalatha.br@mmactiv.com',
    'ketan.lashkare@mmactiv.com',
    'pm.ta@karnatakadigital.in',
    'pm.bb@karnatakadigital.in',
    'associate@karnatakadigital.in',
    'operations.blr@mmactiv.com',
    'anjali.shivananda@in.ey.com',
    'rajshree.bhadauria@outlook.com',
    'tejas.rashinkar@interlinks.in',
    'harsh.kumar@interlinks.in'
];

foreach ($admin_name as $name) {
    //from this admin_name find admin_name from database
    $sql = "SELECT admin_name FROM central_db_admin_login WHERE user_name='$name'";
    //fetch admin_name from database and store it in $name
    $result = mysqli_query($link,$sql) or die("Error: " . mysqli_error($link));
    $row = mysqli_fetch_assoc($result);
    $name2 = $row['admin_name'];
    $pass1 = explode('_', $name2)[0];
    //store only first word name2 and add @ and uunique no to it
    //trim to first word of pass1
    $pass1 = explode(' ', $pass1)[0];

    $unique_id = substr(mt_rand(), 0, 6);
    
    $pass1 = $pass1 . '@' . $unique_id;
    $pass2 = md5($pass1);

    $sql = "UPDATE central_db_admin_login SET pass1='$pass1', pass2='$pass2' WHERE user_name='$name'";
    // echo $sql;
    $result = mysqli_query($link,$sql) or die("Error: " . mysqli_error($link));

    echo "Updated database for $name: pass1 = $pass1, pass2 = $pass2\n";
    echo "<br>";
}
