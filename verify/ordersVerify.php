<?php
    include '../php/database.php';
    include '../php/orders.php';

    // Connect to SQL database
    $connection = mysqli_connect($server, $username, $password, $database);

    // Check for connection error
    if (mysqli_connect_error()) 
        echo "Failed to connect to MYSQL: " . mysql_connect_error();

    $firstName = $_REQUEST["firstName"];
    $lastName = $_REQUEST["lastName"];
    $idNumber = $_REQUEST["idNumber"];
    $arrangment = $_REQUEST["arrangment"];
    $date = $_REQUEST["date"];
    $address = $_REQUEST["address"];

    $query = "SELECT id FROM CustomerAccounts WHERE customer_firstname='{$firstName}' 
    AND customer_lastname='{$lastName}' AND id='{$idNumber}'";
    $result = mysqli_query($connection, $query);

    $size = count(mysqli_fetch_array($result));
    $arrangmentT = strlen($arrangment) > 0;
    $dateT = strlen($date) > 0;
    $addressT = strlen($address) > 0;

    $query = "SELECT id FROM FloristAccounts ORDER BY RAND() LIMIT 1";
    $id = mysqli_fetch_array(mysqli_query($connection, $query))[0];

    $result = False;

    // This is really stupid but for some reason PHP is a
    // horrible programming language
    if ($arrangmentT)
        if ($dateT)
            if ($addressT)
                $result = True;

    $orderNumber = rand(10000000, 100000000);

    if ($size != 0 && $result) {
        $query = "INSERT INTO OrderRecords (arrangment, date, address, order_number, customerid, floristid) VALUES 
        ('{$arrangment}', '{$date}', '{$address}', '{$orderNumber}', '{$idNumber}', '{$id}')";
        mysqli_query($connection, $query);
        echo '<script language="javascript">';
        echo 'alert("Order placed.")';
        echo '</script>';
    }
    else {
        echo '<script language="javascript">';
        echo 'alert("Either customer account cannot be found or the information provided is invalid. Please try again.")';
        echo '</script>';
    }
    mysqli_close($connection);
?>