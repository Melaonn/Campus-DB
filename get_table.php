<?php
// Connect to MySQL database
$db = mysqli_connect("localhost", "root", "mmmm", "college_faculty");

if ($db === false) {
    echo "<p>Failed to connect to MySQL: " . mysqli_connect_error() . "</p>";
} else {
    // Fetch table name from the GET request
    $table = $_GET['table'];

    // Fetch data from the specified table
    $data_query = "SELECT * FROM $table";
    $data_result = mysqli_query($db, $data_query);

    if (mysqli_num_rows($data_result) > 0) {
        // Start building the HTML table
        echo "<table>";

        // Fetch the attribute names as table headers
        $first_row = mysqli_fetch_assoc($data_result);
        echo "<tr>";
        foreach ($first_row as $attribute_name => $value) {
            echo "<th>$attribute_name</th>";
        }
        echo "</tr>";

        // Display the data rows
        mysqli_data_seek($data_result, 0); // Reset pointer to the beginning
        while ($row = mysqli_fetch_assoc($data_result)) {
            echo "<tr>";
            foreach ($row as $value) {
                echo "<td>$value</td>";
            }
            echo "</tr>";
        }

        // Close the HTML table
        echo "</table>";
    } else {
        echo "<p>No data found in the table.</p>";
    }
}

// Close database connection
mysqli_close($db);
?>
