<?php
    include '../php/database.php';
    include '../php/accounts.php';

    // Connect to SQL database
    $connection = mysqli_connect($server, $username, $password, $database);

    // Check for connection error
    if (mysqli_connect_error()) 
        echo "Failed to connect to MYSQL: " . mysql_connect_error();

    $firstName = $_REQUEST["firstName"];
    $lastName = $_REQUEST["lastName"];
    $idNumber = $_REQUEST["idNumber"];

    $query = "SELECT * FROM CustomerAccounts WHERE id='{$idNumber}'";
    $result = mysqli_query($connection, $query);

    $size = count(mysqli_fetch_array($result));

    $first = strlen($firstName) > 0 && !ctype_digit($firstName);
    $last = strlen($lastName) > 0 && !ctype_digit($lastName);
    $id = strlen($idNumber) == 8 && ctype_digit($idNumber);

    $result = False;

    // This is really stupid but for some reason PHP is a
    // horrible programming language
    if ($first)
        if ($last)
            if ($id)
                $result = True;


    if ($size == 0 && $result) {
        $query = "INSERT INTO CustomerAccounts (customer_firstname, customer_lastname, id) VALUES ('{$firstName}', '{$lastName}', '{$idNumber}')";
        mysqli_query($connection, $query);
        echo '<script language="javascript">';
        echo 'alert("Account created.")';
        echo '</script>';
    }
    else {
        echo '<script language="javascript">';
        echo 'alert("Either an account with that ID already exists or the information provided is invalid. Please try again.")';
        echo '</script>';
    }
    mysqli_close($connection);
?>