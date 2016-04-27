<?php
$rut = $_REQUEST['rut'];
include 'db.conf.php';
$dbconn = pg_connect("host=$hostname port=$port dbname=$database user=$username password=$password") or die('NO HAY CONEXION: ' . pg_last_error());
$sql = "SELECT * FROM patient WHERE rut = '$rut'";
$result = pg_query($sql) or die("SQL Error 1: " . pg_last_error());
$row = pg_fetch_array($result, null, PGSQL_ASSOC);
if($row) {
	$id = $row['id'];
	$name = $row['name'];
	$lastname = $row['lastname'];
	$rut = $row['rut'];
	$gender = $row['gender'];
	$birthdate = $row['birthdate'];
	$patient = array(
		'id' => $id,
		'name' => $name,
		'lastname' => $lastname,
		'rut' => $rut,
		'gender' => $gender,
		'birthdate' => $birthdate
	);
	echo json_encode($patient);
}else {
	echo 0;
}
?>