<?php
$database = 'ete32e_2324zs_11';
$username = 'ete32e_2324zs_11';
$password = '151s108T09A!32';

$mysqli = new mysqli('localhost', $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
else{
	echo "ok";
}

// Query to get all table names in the current database
$query = "SHOW TABLES";
$result = $mysqli->query($query);

// Check if the query was successful
if ($result) {
    // Fetch the result as an associative array
    $tables = $result->fetch_all(MYSQLI_ASSOC);

    // Print the table names
    foreach ($tables as $table) {
        echo $table['Tables_in_' . $database] . "<br>";
    }

    // Free the result set
    $result->free();
} else {
    // Print an error message if the query fails
    echo "Error: " . $mysqli->error;
}

// Query to get all table names in the current database
$tableQuery = "SHOW TABLES";
$tableResult = $mysqli->query($tableQuery);

// Check if the query was successful
if ($tableResult) {
    // Fetch the result as an associative array
    $tables = $tableResult->fetch_all(MYSQLI_ASSOC);

    // Loop through each table
    foreach ($tables as $table) {
        $tableName = $table['Tables_in_' . $database];

        // Query to select all rows from the current table
        $selectQuery = "SELECT * FROM $tableName";
        $selectResult = $mysqli->query($selectQuery);

        // Check if the query was successful
        if ($selectResult) {
            // Fetch the result as an associative array
            $rows = $selectResult->fetch_all(MYSQLI_ASSOC);

            // Print the table name
            echo "<h2>Table: $tableName</h2>";

            // Print the rows
            echo "<table border='1'>";
            foreach ($rows as $row) {
                echo "<tr>";
                foreach ($row as $key => $value) {
                    echo "<td>$key: $value</td>";
                }
                echo "</tr>";
            }
            echo "</table><br>";

            // Free the result set
            $selectResult->free();
        } else {
            // Print an error message if the query fails
            echo "Error selecting from table $tableName: " . $mysqli->error;
        }
    }

    // Free the result set
    $tableResult->free();
} else {
    // Print an error message if the query fails
    echo "Error: " . $mysqli->error;
}

// Close the connection
$mysqli->close();
?>