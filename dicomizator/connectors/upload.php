<?php
$index = $_REQUEST['index'];
move_uploaded_file($_FILES['webcam']['tmp_name'], "../images/jpg/webcam$index.jpg");
echo $index;
?>
