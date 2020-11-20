<?php 
    include 'database.php';
    include 'index.php';

    // Connect to SQL database
    $connection = mysqli_connect($server, $username, $password, $database);

    // Check for connection error
    if (mysqli_connect_error()) 
        echo "Failed to connect to MYSQL: " . mysql_connect_error();

    // Query all results from table
    $query = "SELECT * FROM OrderRecords INNER JOIN FloristAccounts ON OrderRecords.floristid=FloristAccounts.id 
    INNER JOIN CustomerAccounts ON OrderRecords.customerid=CustomerAccounts.id";
    $result = mysqli_query($connection, $query);

    // Create and populate table element
    
    echo "<div class=container2>";
    echo "<table id='database_table'>";
    echo "<tr><th>" . "Florist First Name" .
        "</td><th>" . "Florist Last Name" .
        "</td><th>" . "Florist ID" .
        "</td><th>" . "Florist Phone" .
        "</td><th>" . "Florist Email" .
        "</td><th>" . "Customer First Name" .
        "</td><th>" . "Customer Last Name" .
        "</td><th>" . "Items Ordered" .
        "</td><th>" . "Delivery Date" .
        "</td><th>" . "Delivery Address" . "</td></tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td>" . $row['florist_firstname'] . 
            "</td><td>" . $row["florist_lastname"] . 
            "</td><td>" . $row["id"] . 
            "</td><td>" . $row["phone"] . 
            "</td><td>" . $row["email"] .
            "</td><td>" . $row["customer_firstname"] . 
            "</td><td>" . $row["customer_lastname"] . 
            "</td><td>" . $row["arrangment"] . 
            "</td><td>" . $row["date"] .
            "</td><td>" . $row["address"] . "</td></tr>";
    }
    echo "</table>";
    echo "</div>";

    // End connection to database
    mysqli_close($connection);
?>