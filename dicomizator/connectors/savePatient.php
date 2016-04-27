<?php
$name = $_REQUEST['name'];
$lastname = $_REQUEST['lastname'];
$gender = $_REQUEST['gender'];
$birthdate = $_REQUEST['birthdate'];
$rut = $_REQUEST['rut'];

include 'db.conf.php';
$dbconn = pg_connect("host=$hostname port=$port dbname=$database user=$username password=$password") or die('NO HAY CONEXION: ' . pg_last_error());
$sql = "INSERT INTO patient (name, lastname, rut, gender, birthdate) VALUES ('$name', '$lastname', '$rut', '$gender', '$birthdate') RETURNING id";
$result = pg_query($sql) or die("SQL Error 1: " . pg_last_error());
$row = pg_fetch_array($result, null, PGSQL_ASSOC);
echo $row['id'];
?>