<?php session_start();
        if (        $_POST['first'] != '' &&
                    $_POST['last'] != '' &&
                    $_POST['gender'] != '' &&
                    $_POST['age'] != 0 &&
                    $_POST['e'] == 0
            ){
            $lines = file('gs://s3652979-a1-storage/lecturers.csv', FILE_IGNORE_NEW_LINES); //split csv file into array
            $count = count($lines); //calculate length of array
            $lines[$count] = "{$_POST['first']},{$_POST['last']},{$_POST['gender']},{$_POST['age']}";   //add info into array at external position
            $data_string = implode("\n",$lines);            // translate array into string necked with "\n"
            $f = fopen('gs://s3652979-a1-storage/lecturers.csv','w');       //open file to write
            fwrite($f,$data_string);    //rewrite
            fclose($f);             //close

            $_SESSION['message'] = array(                   //update session
                'text' => 'Lecturer has been added ! ❤️',
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
            'text' => 'Edit successfully ! 💚',
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