<?php session_start();

//    $mysqli = new mysqli('localhost', 'root', 'root', 'crud') or die(mysqli_error($mysqli));
//    if (isset($_POST['save']))
//    {
//        $first = $_POST['first'];
//        $last = $_POST['last'];
//        $gender = $_POST['gender'];
//        $age = $_POST['age'];
//        $mysqli->query("INSERT INTO list(first,last,gender,age) VALUES('$first','$last','$gender',$age)") or
//        die($mysqli->error);
//    }
        if (        $_POST['first'] != '' &&
                    $_POST['last'] != '' &&
                    $_POST['gender'] != '' &&
                    $_POST['age'] != 0 &&
                    $_POST['e'] == 0
            ){

            $f = fopen('gs://s3652979-a1-storage/lecturers.csv','w');
            // 	(2) Write the new line info to the file
            $lines = file('gs://s3652979-a1-storage/lecturers.csv', FILE_IGNORE_NEW_LINES);
            $count = count($lines);
            $lines[$count] = "{$_POST['first']},{$_POST['last']},{$_POST['gender']},{$_POST['age']}";
            $data_string = implode("\n",$lines);
            $f = fopen('gs://s3652979-a1-storage/lecturers.csv','w');
            fwrite($f,$data_string);
            fclose($f);

//            fseek($f, -2, SEEK_END);
//            fwrite($f,"{$_POST['first']},{$_POST['last']},{$_POST['gender']},{$_POST['age']}\n");
            // 	(3) Close the file
            fclose($f);
            $_SESSION['message'] = array(
                'text' => 'Lecturer has been added.',
                'type' => 'success'
            );
            //Redirect to home
            header('Location:../?url=list_lecturers');
            }
    elseif (    $_POST['first'] != '' &&
                $_POST['last'] != '' &&
                $_POST['gender'] != '' &&
                $_POST['age'] != 0 &&
                $_POST['e'] == 1
            ){

            $lines = file('gs://s3652979-a1-storage/lecturers.csv', FILE_IGNORE_NEW_LINES);
            $lines[$_POST['lineedit']] = "{$_POST['first']},{$_POST['last']},{$_POST['gender']},{$_POST['age']}";

            // Create the string to write to the file
            $data_string = implode("\n",$lines);

    // Write the string to the file, overwriting the current contents
            $f = fopen('gs://s3652979-a1-storage/lecturers.csv','w');
            fwrite($f,$data_string);
            fclose($f);
            $_POST['e'] = 0;
            $_SESSION['message'] = array(
            'text' => 'Edit successfully !',
            'type' => 'success');
            //Redirect to home
            header('Location:../?url=list_lecturers');
            }
    else {
            $_SESSION['message'] = array(
            'text' => 'All information is required !',
            'type' => 'danger');
        //Redirect to home
        header('Location:../?url=form_lecturers');
    }

    //redirect to home

?>