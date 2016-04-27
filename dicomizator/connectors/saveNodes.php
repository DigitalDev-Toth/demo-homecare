<?php
$aetitle = $_REQUEST['aetitle'];
$type = $_REQUEST['type'];
$portDcm = $_REQUEST['port'];
$institution = $_REQUEST['institution'];
$name = $_REQUEST['name'];
$send = $_REQUEST['send'];
$ip = $_REQUEST['ip'];

include 'db.conf.php';
$dbconn = pg_connect("host=$hostname port=$port dbname=$database user=$username password=$password") or die('NO HAY CONEXION: ' . pg_last_error());

if($type == 'l'){
	$type = 'local';
	$sql = "SELECT * FROM node WHERE type='local'";
	$result = pg_query($sql) or die("SQL Error 1: " . pg_last_error());
	$row = pg_fetch_array($result, null, PGSQL_ASSOC);
	if($row){
		$sql = "UPDATE node SET  ip = '$ip', aetitle='".strtoupper($aetitle)."', institution='".strtoupper($institution)."', port=$portDcm, type='$type' WHERE type='local'";
		$result = pg_query($sql) or die("SQL Error 1: " . pg_last_error());
		$row = pg_fetch_array($result, null, PGSQL_ASSOC);
	}else {
		$sql = "INSERT INTO node (ip, aetitle, institution, port, type) VALUES ('$ip', '".strtoupper($aetitle)."', '".strtoupper($institution)."', $portDcm, '$type')";
		$result = pg_query($sql) or die("SQL Error 1: " . pg_last_error());
		$row = pg_fetch_array($result, null, PGSQL_ASSOC);
	}
} else {
	$type='remoto';
	$sql = "INSERT INTO node (ip, aetitle, name, port, type, send) VALUES ('$ip', '".strtoupper($aetitle)."', '$name', $portDcm, '$type', '$send')";
	$result = pg_query($sql) or die("SQL Error 1: " . pg_last_error());
	$row = pg_fetch_array($result, null, PGSQL_ASSOC);
}
echo "out";
?>