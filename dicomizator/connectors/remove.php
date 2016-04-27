<?php 
$imgPath = "/var/www/dicomizator/images/jpg/";
sleep(4);
for ($i=0; $i < 100; $i++) { 
	$img = $imgPath."webcam".$i.".jpg";
    if(file_exists($img)){
        //unlink($img);
        echo $img."\n";
    }
}
?>