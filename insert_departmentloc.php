<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $dno = $_POST['dno'];
    $dlocation = $_POST['dlocation'];

    // Connect to MySQL database
    $db = mysqli_connect("localhost", "root", "mmmm", "college_faculty");

    // Check connection
    if ($db === false) {
        die("Error: Could not connect. " . mysqli_connect_error());
    }

    // Prepare an insert statement
    $sql = "INSERT INTO dept_locations (dno, dlocation) VALUES (?, ?)";

    if ($stmt = mysqli_prepare($db, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ss", $dno, $dlocation);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Department  location added successfully.";
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
