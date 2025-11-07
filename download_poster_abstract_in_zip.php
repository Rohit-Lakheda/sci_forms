<?php 
//ini_set("display_errors", "1");
//error_reporting(E_ALL);
// Create ZIP file
//if(isset($_POST['create'])){
 $zip = new ZipArchive();
 $filename = "upload1/abstract" . date('YmdHis') . ".zip";

 if ($zip->open($filename, ZipArchive::CREATE)!==TRUE) {
  exit("cannot open <$filename>\n");
 }

 $dir = 'upload1/';

 // Create zip
 createZip($zip,$dir);

 $zip->close();
//}

// Create zip
function createZip($zip,$dir){
	include 'includes/form_constants_both.php';
	require 'dbcon_open.php';
	$sql = "SELECT * FROM " . $PSTR_TBL_NAME;
	$result = mysqli_query($link,$sql);
	while($row = mysqli_fetch_assoc($result)) {
		//if(file_exists($row['poster_abstract'])) {
		//print_R($row['poster_abstract']);exit;
		//if (is_file($row['poster_abstract'])) {
		$abstract = pathinfo($row['poster_abstract'],PATHINFO_BASENAME);
		if(file_exists($dir . $abstract)) {
			$zip->addFile($dir . $abstract, $dir . $abstract);
		}
	}
	
	/*$valid_files = array('style.css','sp-style.css','normalize.css','bootstrap.min.css','bootstrap.css','bootstrap-theme.min.css');
	foreach($valid_files as $file) {

		$zip->addFile($dir.$file,$dir.$file);
	}*/
	//$zip->addFile($dir.$file);
 /*if (is_dir($dir)){

  if ($dh = opendir($dir)){
   while (($file = readdir($dh)) !== false){
 
    // If file
    if (is_file($dir.$file)) {
     if($file != '' && $file != '.' && $file != '..'){
 
      $zip->addFile($dir.$file);
     }
    }else{
     // If directory
     if(is_dir($dir.$file) ){

      if($file != '' && $file != '.' && $file != '..'){

       // Add empty directory
       $zip->addEmptyDir($dir.$file);

       $folder = $dir.$file.'/';
 
       // Read data of the folder
       createZip($zip,$folder);
      }
     }
 
    }
 
   }
   closedir($dh);
  }
 }*/
}
 
 //$filename = "upload1/abstract" . date('YmdHis') . ".zip";

 if (file_exists($filename)) {
  header('Content-Type: application/zip');
  header('Content-Disposition: attachment; filename="'.basename($filename).'"');
  header('Content-Length: ' . filesize($filename));
  flush();
  readfile($filename);

  // delete file
  unlink($filename);
 }
?>