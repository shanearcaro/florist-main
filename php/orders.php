<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Flowering Pot</title>
    <link rel="stylesheet" href="../css/style3.css">
    <link rel="shortcut icon" href="../favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>
<body>
    <?php
        include 'index.php';
    ?>
    <div class="container" style="width: 25%">
        <div class="title" id="title">
            <h1>The Flowering Pot</h1>
            <h3>Cancel Order</h3>
        </div>
        <p style="padding-bottom: 3rem"></p>
    </div>

    <div class="container2" style="width: 25%">
        <form action="../verify/cancelVerify.php" id="cancelForm" method="post" onsubmit="return confirm('Are you sure you want to delete this record?');">
            <div class="form_input">
                <p class="required_text">* Required</p>
                <input type="text" id="idNumber" name="idNumber" placeholder="Customer ID Number">

                <p class="required_text">* Required</p>
                <input type="text" id="orderNumber" name="orderNumber" placeholder="Order Number">
                <div class="buttons" style="padding-left: 7rem">
                    <button class="buttons" type="submit">Submit</button>
                </div>
            </div>
        </form>
        <p style="padding-bottom: 3rem"></p>
    </div>
</body>
</html>