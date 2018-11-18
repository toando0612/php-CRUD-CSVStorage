<div class="justify-content-center">
    <table class="table">
        <thead class="thead-light">
        <tr>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Gender</th>
            <th>Age</th>

            <th>Edit</th>
            <th>Delete</th>
        </tr>
        </thead>
        <?php
        // Read all lines of the CSV file into an array
        // The "file" function in PHP returns an array of all the lines in the file listed
        $lines = file('gs://s3652979-a1-storage/lecturers.csv',FILE_IGNORE_NEW_LINES);

        // Counter variable for line number
        $i = 0;


        //Iterate over the array of lines
        foreach($lines as $line) {
            $parts = explode(',', $line);
            $first = $parts[0];
            $last = $parts[1];
            $gender = $parts[2];
            $age = $parts[3];
            echo '<tr>';
            echo "<td>$first</td>";
            echo "<td>$last</td>";
            echo "<td>$gender</td>";
            echo "<td>$age</td>";
            echo "<td><a type=\"button\" href=\"./?url=form_lecturers&edit=$i&e=1\" class=\"btn btn-default btn-sm\"><span class=\"glyphicon glyphicon-edit\"></span> Edit</a></td>";
            echo "<td><a type=\"button\" href=\"actions/delete_lecturer.php?delete=$i\" class=\"btn btn-default btn-sm\"><span class=\"glyphicon glyphicon-remove\"></span> Trash</a></td>";
            echo '</tr>';
            $i++;

        }
        ?>
    </table>
</div>