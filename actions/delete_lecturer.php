<?php
session_start();
// Read file into array
$lines = file('gs://s3652979-a1-storage/lecturers.csv', FILE_IGNORE_NEW_LINES);

unset($lines[$_GET['delete']]);

$data_string = implode("\n",$lines);

$f = fopen('gs://s3652979-a1-storage/lecturers.csv','w');
fwrite($f,$data_string);
fclose($f);

$_SESSION['message'] =  array(
    'text' => 'You will never see this info again ! 🖤',
    'type' => 'danger'
);

header('Location:../?url=list_lecturers');


?>


<!-- To synch workspace with cloud
Commit changes - changes files used to track repository on local machine to check for new files
Push changes - will make changes on githu/cloud respository
In order to do this, first must type a git add command-->