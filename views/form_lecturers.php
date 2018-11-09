<div class="row justify-content-center">
    <form method="POST" action="actions/submit_lecturer.php">
        <?php if ($_GET['e'] == 1) echo "<h1>Edit Form</h1>";
        elseif ($_GET['e'] == 0) echo "<h1>Add Form</h1>";
        ?>
        <input type="hidden" name="lineedit" value="<?php echo $_GET['edit'] ?>" />
        <input type="hidden" name="e" value="<?php echo $_GET['e'] ?>" />

        <?php
        $lineedit = file('gs://s3652979-a1-storage/lecturers.csv',FILE_IGNORE_NEW_LINES);

        $lecturer = explode(',',$lineedit[$_GET['edit']]);
        ?>
        <div class="form-group">
            <label for="first">FirstName</label>
            <input type="text" class="form-control" name="first" id="first" placeholder="your first name" value="<?=$lecturer[0]?>">
        </div>

        <div class="form-group">
            <label for="last">Last Name</label>
            <input type="text" name="last" id="last" class="form-control" placeholder="your last name" value="<?=$lecturer[1]?>">
        </div>
        <div>
            Choose your gender:
        </div>

        <!--                        //when click edit button-->
        <?php
        if ($lecturer[2] == 'male'){
            ?>
            <div class="form-check">
                <input type="radio" name="gender" id="male" value="male" checked>
                <label for="Male" class="form-check-label">
                    Male
                </label> <br>
            </div>
            <div class="form-check">
                <input type="radio" name="gender" id="female" value="female">
                <label for="Female" class="form-check-label">
                    Female
                </label> <br>
            </div>
        <?php }
        elseif ($lecturer[2] == 'female') {
            ?>
            <div class="form-check">
                <input type="radio" name="gender" id="male" value="male" >
                <label for="Male" class="form-check-label">
                    Male
                </label> <br>
            </div>
            <div class="form-check">
                <input type="radio" name="gender" id="female" value="female" checked>
                <label for="Female" class="form-check-label">
                    Female
                </label> <br>
            </div>
        <?php }
        else {
            ?>
            <div class="form-check">
                <input type="radio" name="gender" id="male" value="male">
                <label for="Male" class="form-check-label">
                    Male
                </label> <br>
            </div>
            <div class="form-check">
                <input type="radio" name="gender" id="female" value="female">
                <label for="Female" class="form-check-label">
                    Female
                </label> <br>
            </div>
            <?php
        }
        ?>      <div class="form-group">
            <input type="number" class="form-control" id="age" name="age" placeholder="Age" value="<?=$lecturer[3]?>">
        </div>
        <button type="submit" class="btn btn-success" name="save">Save</button>
    </form>
</div>