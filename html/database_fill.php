<?php

$database = 'ete32e_2324zs_11';
$username = 'ete32e_2324zs_11';
$password = '151s108T09A!32';

$mysqli = new mysqli('localhost', $username, $password, $database);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}



// Query to get all table names in the current database
$query = "SHOW TABLES";
$result = $mysqli->query($query);

// Check if the query was successful
if ($result) {
    // Fetch the result as an associative array
    $tables = $result->fetch_all(MYSQLI_ASSOC);

    // Loop through each table and drop it
    foreach ($tables as $table) {
        $tableName = $table['Tables_in_' . $database];
        $dropQuery = "DROP TABLE $tableName";
        
        // Execute the DROP TABLE query
        $dropResult = $mysqli->query($dropQuery);

        // Check if the query was successful
        if (!$dropResult) {
            echo "Error dropping table $tableName: " . $mysqli->error;
        } else {
            echo "Table $tableName dropped successfully.<br>";
        }
    }

    // Free the result set
    $result->free();
} else {
    // Print an error message if the query fails
    echo "Error: " . $mysqli->error;
}




// Read the SQL script file
$sqlScript = file_get_contents('./script.sql');

// Split the script into individual queries
$queries = explode(';', $sqlScript);

// Execute each query
foreach ($queries as $query) {
    // Skip empty queries
    if (trim($query) == '') {
        continue;
    }

    // Execute the query
    $result = $mysqli->query($query);
    echo "Executing query: " . $query . "<br>";


    // Check if the query was successful
    if (!$result) {
        echo "Error executing query: " . $mysqli->error;
        break;
    }
}

// Close the connection
$mysqli->close();
?>