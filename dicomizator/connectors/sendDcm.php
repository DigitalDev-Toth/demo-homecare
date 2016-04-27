<?php
include 'db.conf.php';
$dbconn = pg_connect("host=$hostname port=$port dbname=$database user=$username password=$password") or die('NO HAY CONEXION: ' . pg_last_error());
$sql = "SELECT * FROM node WHERE type='local'";
$result = pg_query($sql) or die("SQL Error 1: " . pg_last_error());
$row = pg_fetch_array($result, null, PGSQL_ASSOC);
$ip_local = $row['ip'];
$aetitle_local = $row['aetitle'];
$port_local = $row['port'];
$dcmPath = "/var/www/dicomizator/images/dcm/";
$query = "SELECT * FROM node WHERE type='remoto' AND send ='Si'";
$resultado = pg_query($query) or die("SQL Error 1: " . pg_last_error());
while ($data = pg_fetch_array($resultado, null, PGSQL_ASSOC)) {
	$ip_remoto = $data['ip'];
	$aetitle_remoto = $data['aetitle'];
	$port_remoto = $data['port'];
}

$cmd = '/var/www/dicomizator/scripts/dcm4che2/bin/./dcmsnd -L DCMSND@192.168.0.230:11119 '.$aetitle_remoto.'@'.$ip_remoto.':'.$port_remoto.' '.$dcmPath;
exec($cmd, $err, $out);
echo $cmd;
?>
