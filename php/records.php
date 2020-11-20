<?php 
    include 'database.php';
    include 'index.php';

    // Connect to SQL database
    $connection = mysqli_connect($server, $username, $password, $database);

    // Check for connection error
    if (mysqli_connect_error()) 
        echo "Failed to connect to MYSQL: " . mysql_connect_error();

    // Query all results from table

    // Kinda unfortunate I have to do this but I need to specify florist id separate from customer id because of wrong
    // values that were being indexed
    $query = "SELECT florist_firstname AS florist_firstname, florist_lastname AS florist_lastname, FloristAccounts.id AS florist_id, 
    phone AS phone, email AS email, customer_firstname AS customer_firstname, customer_lastName AS customer_lastname, arrangment AS arrangment, 
    order_number AS order_number, date AS date, address AS address FROM OrderRecords INNER JOIN FloristAccounts ON OrderRecords.floristid=FloristAccounts.id 
    INNER JOIN CustomerAccounts ON OrderRecords.customerid=CustomerAccounts.id";
    $result = mysqli_query($connection, $query);

    // Adding order number to display otherwise to delete an order you have to have the actual database infront of you
    // instead of the website's records

    echo "<div class='container'>";
    echo "<div class='title' id='title'>";
    echo "<h1>The Flowering Pot</h1>";
    echo "</div>";
    echo "</div>";

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
        "</td><th>" . "Order Number" .
        "</td><th>" . "Delivery Date" .
        "</td><th>" . "Delivery Address" . "</td></tr>";
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr><td>" . $row['florist_firstname'] . 
            "</td><td>" . $row["florist_lastname"] . 
            "</td><td>" . $row["florist_id"] . 
            "</td><td>" . $row["phone"] . 
            "</td><td>" . $row["email"] .
            "</td><td>" . $row["customer_firstname"] . 
            "</td><td>" . $row["customer_lastname"] . 
            "</td><td>" . $row["arrangment"] . 
            "</td><td>" . $row["order_number"] . 
            "</td><td>" . $row["date"] .
            "</td><td>" . $row["address"] . "</td></tr>";
    }
    echo "</table>";
    echo "</div>";

    // End connection to database
    mysqli_close($connection);
?>