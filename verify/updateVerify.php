<?php
    include '../php/database.php';
    include '../php/update.php';

    // Connect to SQL database
    $connection = mysqli_connect($server, $username, $password, $database);

    // Check for connection error
    if (mysqli_connect_error()) 
        echo "Failed to connect to MYSQL: " . mysql_connect_error();

    $idNumber = $_REQUEST["idNumber"];
    $orderNumber = $_REQUEST["orderNumber"];
    $arrangment = $_REQUEST["arrangment"];

    $query = "SELECT order_number FROM OrderRecords WHERE order_number='{$orderNumber}' AND customerid='{$idNumber}' LIMIT 1";
    $result = mysqli_query($connection, $query);

    $size = count(mysqli_fetch_array($result));

    if ($size == 0 && strlen($arrangment) > 0) {
        echo '<script language="javascript">';
        echo 'alert("An order was not found. Please check the Customer ID and Order Number and try again.")';
        echo '</script>';
    }
    else {
        $query = "UPDATE OrderRecords SET arrangment='{$arrangment}' WHERE order_number='{$orderNumber}' AND customerid='{$idNumber}'";
        // $query = "DELETE FROM OrderRecords WHERE order_number='{$orderNumber}' AND customerid='{$idNumber}'";
        mysqli_query($connection, $query);
        echo '<script language="javascript">';
        echo 'alert("Order successfully updated.")';
        echo '</script>';
    }
    mysqli_close($connection);
?>