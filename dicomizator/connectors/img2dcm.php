<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'db.conf.php';
$dbconn = pg_connect("host=$hostname port=$port dbname=$database user=$username password=$password") or die('NO HAY CONEXION: ' . pg_last_error());
$sql = "SELECT * FROM node WHERE type='local'";
$result = pg_query($sql) or die("SQL Error 1: " . pg_last_error());
$row = pg_fetch_array($result, null, PGSQL_ASSOC);
$institution = $row['institution'];

$total = (intval($_REQUEST['total'])-1);
$name = $_REQUEST['patient'];
$gender = $_REQUEST['gender'];
$rut = $_REQUEST['rut'];
$birthdate = $_REQUEST['birthdate'];
$lastname = $_REQUEST['lastname'];
$imgPath = "/var/www/dicomizator/images/jpg/";
$imgPathExams = "/var/www/dicomizator/images/imageExams/";
$dcmPath = "/var/www/dicomizator/images/dcm/";
$exist = false;
$existDcm = false;
$nowDate = date("Y-m-d");
$nowTime = date("H:i:s");


$files = glob($imgPath."*");

for ($i=0; $i < count($files); $i++) {
	if($i == 0){
		$cmdInitital = 'img2dcm '.$files[$i].' '.$dcmPath.'base.dcm -vlp -k "PatientName='.$lastname.'^'.$name.'" -k "PatientID='.$rut.'" -k "PatientBirthDate='.$birthdate.'" -k "PatientSex='.$gender.'" -k "Modality=OT" -k "InstitutionName='.$institution.'" -k "StudyDate='.$nowDate.'" -k "StudyTime='.$nowTime.'"';
	}
	echo $files[$i];
}

$dcm = $dcmPath."base.dcm";

echo $cmdInitital."\n";
if($total >= 0){
	exec($cmdInitital, $err, $out);
}


while (!$existDcm) {
	if (file_exists($dcm)) {
	    $existDcm = true;
	}
}
$ready = false;
$i=0;


/***DART**/

$dbconn = pg_connect("host=186.67.103.122 port=5435 dbname=test user=postgres password=justgoon") or die('NO HAY CONEXION: ' . pg_last_error());
$today = date("Y-m-d H:i:s");
$sql = "INSERT INTO exams (date_created,date_mod) values('".$today."', '".$nowDate." ".$nowTime." ') returning exam";
$result = pg_query($sql) or die("SQL Error 1: " . pg_last_error());
$row = pg_fetch_array($result, null, PGSQL_ASSOC);
$examNumber =  $row['exam'];
/***/

$images = '';
while ($ready == false) {
	$imagen = $files[$i];
	if (file_exists($imagen)) {
	    $cmd = 'img2dcm '.$imagen.' '.$dcmPath.'dcm'.$i.'.dcm --series-from '.$dcmPath.'base.dcm --study-from '.$dcmPath.'base.dcm';
	    echo $cmd."\n";
		exec($cmd, $err, $out);
		$date = date_create();
		$timestamp = date_format($date, 'U');
		$ext = explode('.', basename($files[$i]));
		$imageName = $timestamp."_".$i.'.'.array_pop($ext);
		$newImage = $imgPathExams.$imageName;
		$images  .= $imageName.'--';

		rename($imagen, $newImage);
       	chmod($newImage, 0777);
		$i = $i + 1;
		if ($i > $total) {
			$ready = true;
		}
	}
}
$url = 'http://demo.biopacs.com/test/moveImages.php?images='.$images.'&examID='.$examNumber;
echo $url;
file_get_contents($url);
//$imagen = $imgPath.'webcam'.$i.'.jpg';
/*
$exams = array(
	'examNumber' => $examNumber,
	'images' => $images,
);

header('Content-Type: application/json');
echo json_encode($exams);
*/
?>
