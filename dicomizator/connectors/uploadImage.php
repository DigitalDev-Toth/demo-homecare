<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
if (empty($_FILES['images'])) {
    echo json_encode(['error'=>'No files found for upload.']);
    return;
}

$images = $_FILES['images'];
$success = null;
$paths= [];
$filenames = $images['name'];

// loop and process files

for($i=0; $i < count($filenames); $i++){
    $ext = explode('.', basename($filenames[$i]));
    $target = "/var/www/dicomizator/images/jpg/webcam".$i.".".array_pop($ext);
    if(move_uploaded_file($images['tmp_name'][$i], $target)) {
        $success = true;
        $paths[] = $target;
    } else {
        $success = false;
        break;
    }
}

if ($success === true) {
    $output = ['ok' =>'ok'];
} elseif ($success === false) {
    $output = ['error'=>'Error while uploading images. Contact the system administrator'];
} else {
    $output = ['error'=>'No files were processed.'];
}

// return a json encoded response for plugin to process successfully
echo json_encode($output); ?>
