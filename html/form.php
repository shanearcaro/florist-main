<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Flowering Pot</title>
    <link rel="stylesheet" href="../css/form_data.css">
    <link rel="shortcut icon" href="../favicon.ico">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="../js/form_data2.js"></script>
</head>
<body onload="checkValue()">

    <div class="container">
        <div class="title" id="title">
            <h1>The Flowering Pot</h1>
        </div>
        <!-- Separate div elements to change style within form instead of using multiple forms
                    This allows for easier PHP call -->
        <form id="mainForm" onsubmit="return false">
            <!-- Main form input of single value items -->
            <div class="form_input" id="form_state">
                <p class="required_text">* Required</p>
                <input type="text" id="firstName" name="firstName" placeholder="Fist Name">
                <p class="required_text">* Required</p>
                <input type="text" id="lastName" name="lastName" placeholder="Last Name">
                <p class="required_text">* Required</p>
                <input type="password" id="password" name="password" placeholder="Password">
                <p class="required_text">* Required</p>
                <input type="text" id="idNumber" name="idNumber" placeholder="ID Number">
                <p class="required_text">* Required</p>
                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="Phone">
                <p id="check_required" class="required_text required_flip">* Required</p>
                <input type="email" id="emailAddress" name="emailAddress" placeholder="Email">
            </div>
            <!-- Checkbox input, defaulted to true through javascript -->
            <div class="form_checkbox">
                <input class="form_checkbox" type="checkbox" id="checkbox" name="checkbox" onclick="checkBoxPressed()">
                <label for="checkbox">Email confirmation</label>
            </div>
            <!-- Has to be outside of dropdown menu to retain proper placement -->
            <p class="form_input required_text">* Required</p>
            <!-- Drop down menu for operation -->
            <div class="dropdown">
                <label for="dropdown">Select Transaction</label>
                <select name="dropdown" id="dropdown">
                    <option value="">Choose Option</option>
                    <option value="searchRecord">Search Florist's Records</option>
                    <option value="makeOrder">Plan An Order</option>
                    <option value="updateOrder">Update An Order</option>
                    <option value="cancelOrder">Cancel An Order</option>   
                    <option value="newAccount">New Customer Account</option>
                </select>
            </div>
        </form>
        <!-- Form buttons -->
        <div class="buttons">
                <button class="buttons" type="submit" onclick="validate()">Submit</button>
                <button class="buttons" onclick="reset()">Reset</button>
        </div>
    </div>
</body>
</html>