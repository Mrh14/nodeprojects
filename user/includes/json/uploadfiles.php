<?php
$filename = $_FILES['file']['name'];

/* Location */

$startdate=strtotime(date('h:i:s'));
$location = "../../assets/upload/".$startdate. $filename;



if (move_uploaded_file($_FILES["file"]["tmp_name"], $location)) {
    $status = 1;
}

echo json_encode(array('files' =>  $startdate. $filename  ));






