<?php
    include_once "database.php";

    // Connect to SQL database
    $connection = mysqli_connect($server, $username, $password, $database);

    // Check for connection error
    if (mysqli_connect_error())
        echo "Failed to connect to MYSQL: " . mysql_connect_error();

    // Request HTML form variables
    $firstName = $_REQUEST["firstName"];
    $lastName = $_REQUEST["lastName"];
    $password = $_REQUEST["password"];
    $identity = $_REQUEST["idNumber"];
    $phoneNumber = $_REQUEST["phoneNumber"];

    // Handle email being an optional requirement
    if (isset($_REQUEST["emailAddress"])) 
        $email = $_REQUEST["emailAddress"];
    else
        $email = "";

    // Query the database according to data sent by HTML form
    $query = "";
    if ($email != "") {
        $query = "SELECT florist_firstname FROM FloristAccounts WHERE florist_firstname='{$firstName}' 
            AND florist_lastname='{$lastName}' AND password='{$password}' AND id='{$identity}' 
            AND phone='{$phoneNumber}' AND email='{$email}'";
    }
    else {
        $query = "SELECT florist_firstname FROM FloristAccounts WHERE florist_firstname='{$firstName}' 
        AND florist_lastname='{$lastName}' AND password='{$password}' AND id='{$identity}' 
        AND phone='{$phoneNumber}'";
    }

    // Check the size of the queried data
    $result = mysqli_query($connection, $query);
    $size = count(mysqli_fetch_array($result));

    // If $size is larger than 0 then a valid account was used to sign in
    if ($size != 0) {
        mysqli_close($connection);
        include_once "records.php";
    }
    // If account information wasn't valid - close database connection and return to main page.
    // Notify the user that the information they entered was incorrect
    else {
        mysqli_close($connection);
        include_once "../html/form.php";
        echo '<script language="javascript">';
        echo 'alert("Invalid login credentials")';
        echo '</script>';
    }
?>