<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $sub_code = $_POST['sub_code'];
    $fac_id = $_POST['fac_id'];
    $sub_name = $_POST['sub_name'];
    $hours = $_POST['hours'];

    // Connect to MySQL database
    $db = mysqli_connect("localhost", "root", "mmmm", "college_faculty");

    // Check connection
    if ($db === false) {
        die("Error: Could not connect. " . mysqli_connect_error());
    }

    // Prepare an insert statement
    $sql = "INSERT INTO subject (sub_code, fac_id, sub_name, hours) VALUES (?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($db, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "ssss", $sub_code, $fac_id, $sub_name, $hours);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            echo "subject added successfully.";
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
