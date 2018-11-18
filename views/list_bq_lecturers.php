<?php
session_start();
require_once 'php/google-api-php-client/vendor/autoload.php';
?>
<div class="justify-content-center">
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Gender</th>
            <th>Age</th>
            <th>Frequency</th>
        </tr>
        </thead>
    <?php
    $client = new Google_Client();
    $client->useApplicationDefaultCredentials();
    $client->addScope(Google_Service_Bigquery::BIGQUERY);
    $bigquery = new Google_Service_Bigquery($client);
    $projectId = 's3652979-a1-cloudcomputing';

    $request = new Google_Service_Bigquery_QueryRequest();

    $lines = file('gs://s3652979-a1-storage/lecturers.csv',FILE_IGNORE_NEW_LINES);

    foreach($lines as $line) {
        $parts = explode(',', $line);
        $first = $parts[0];
        $last = $parts[1];
        $gender = $parts[2];
        $age = $parts[3];

        $firstname = $first;
        $count = 0;
        $freq = '';

        $request->setQuery("SELECT name , SUM(count) as freq FROM [s3652979_a1_bigquery.baby_name] WHERE name = '$firstname' GROUP BY name ORDER BY freq;");

        $response = $bigquery->jobs->query($projectId, $request);
        $rows = $response->getRows();
        foreach($rows as $row){
            foreach($row['f'] as $field){
                if ($count == 1){
                    $freq = $field['v'];
                }
                $count = $count + 1;
            }
        }


            echo '<tr>';
            echo "<td>$first</td>";
            echo "<td>$last</td>";
            echo "<td>$gender</td>";
            echo "<td>$age</td>";
            echo "<td>$freq</td>";
            echo '</tr>';
            $i++;




//        print_r($freq);


    }




    ?>

    </table>
</div>