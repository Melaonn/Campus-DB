<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $fac_id = $_POST['FAC_ID'];
    $f_name = $_POST['F_NAME'];
    $l_name = $_POST['L_NAME'];
    $bdate = $_POST['BDATE'];
    $address = $_POST['ADDRESS'];
    $sex = $_POST['SEX'];
    $salary = $_POST['SALARY'];
    $head_id = $_POST['HEAD_ID'];
    $dno = $_POST['dno'];

    // Connect to MySQL database
    $db = mysqli_connect("localhost", "root", "mmmm", "college_faculty");

    // Check connection
    if ($db === false) {
        die("Error: Could not connect. " . mysqli_connect_error());
    }

    // Prepare an insert statement
    $sql = "INSERT INTO faculty (FAC_ID, F_NAME, L_NAME, BDATE, ADDRESS, SEX, SALARY, HEAD_ID, dno) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($db, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sssssssss", $fac_id, $f_name, $l_name, $bdate, $address, $sex, $salary, $head_id, $dno);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Faculty record added successfully.";
        } else {
            echo "Error: Could not execute query. " . mysqli_error($db);
        }

        // Close statement
        mysqli_stmt_close($stmt);
    } else {
        echo "Error: Could not prepare query. " . mysqli_error($db);
    }

    // Close connection
    mysqli_close($db);
}
?>
