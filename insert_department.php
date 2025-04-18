<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $dno = $_POST['dno'];
    $d_name = $_POST['d_name'];
    $hod_id = $_POST['hod_id'];

    // Connect to MySQL database
    $db = mysqli_connect("localhost", "root", "mmmm", "college_faculty");

    // Check connection
    if ($db === false) {
        die("Error: Could not connect. " . mysqli_connect_error());
    }

    // Prepare an insert statement
    $sql = "INSERT INTO department (dno, d_name, hod_id) VALUES (?, ?, ?)";

    if ($stmt = mysqli_prepare($db, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "sss", $dno, $d_name, $hod_id);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Department added successfully.";
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
