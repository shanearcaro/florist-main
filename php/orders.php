<?php 
    include 'database.php';

    // Connect to SQL database
    $connection = mysqli_connect($server, $username, $password, $database);

    // Check for connection error
    if (mysqli_connect_error()) 
        echo "Failed to connect to MYSQL: " . mysql_connect_error();
    
    // Query all results from table
    $query = "SELECT * FROM OrderRecords";
    $result = mysqli_query($connection, $query);

    // Create and populate table element
    
    echo "<table id='database_table'>";
    echo "<tr><th>" . "Arrangement" .
        "</td><th>" . "Date" .
        "</td><th>" . "Address" .
        "</td><th>" . "Order Number" .
        "</td><th>" . "Customer ID" .
        "</td><th>" . "Florist ID" . "</td></tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td>" . $row['arrangment'] . 
            "</td><td>" . $row["date"] . 
            "</td><td>" . $row["address"] . 
            "</td><td>" . $row["number"] . 
            "</td><td>" . $row["customerid"] .
            "</td><td>" . $row["floristid"] . "</td></tr>";
    }
    echo "</table>";

    // End connection to database
    mysqli_close($connection);
?>