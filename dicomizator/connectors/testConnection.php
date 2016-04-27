<?php
$ip = $_REQUEST['ip'];
$port = $_REQUEST['port'];
$aetitle = $_REQUEST['aetitle'];
$cmd = "echoscu -v -aec $aetitle $ip $port 2>&1";
//echoscu -v -aec BIOPACS-RIS 192.168.0.210 104
exec($cmd, $out, $err);
$html ="";
foreach ($out as $key => $value) {
	$html .= $value."<br>";
}
/*if (strpos($html,'Success') !== false) {
    echo 'true';
}*/
//echo "$cmd";
echo $html;
/*$salida = system("echoscu -v -aec BIOPACS-RIS 192.168.0.210 104 2>&1");

echo "<pre>$salida</pre>";*/
	
?>