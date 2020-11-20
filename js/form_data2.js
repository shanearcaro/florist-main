class Account {
    constructor(information) {
        let errorMessage = "";
        this.information = information;
    }

    /**
     * Checks if all fields within the form are filled out.
     * The only exception to this is the email field which is optional.
     * The check flag is used to determine if the email field is currently
     * being required or not.
     */
    validateFields() {
        let check = document.getElementById("checkbox").checked;
        for (let i = 0; i < this.information.length; i++) {
            if (i == 5) {
                if (check && this.information[i].length == 0) {
                    this.errorMessage = "Fill out all fields."
                }
            }
            else if (this.information[i].length == 0) {
                this.errorMessage = "Fill out all fields.";
            }
        }
    }

    /**
     * Validates the password the user provides.
     * The password must be eight characters with one
     * uppercase letter and one digit.
     */
    validatePassword() {
        let password = this.information[2];
        let number = false;
        let capital = false;

        for (let i = 0; i < password.length; i++) {
            let ascii = password.charCodeAt(i);

            if (ascii >= 65 && ascii <= 90)
                capital = true;
            if (ascii >= 48 && ascii <= 57)
                number = true;
        }

        if (!number)
            this.errorMessage = "Password must contain a number."
        if (!capital)
            this.errorMessage = "Password must contain a capital letter.";
        if (password.length != 8)
            this.errorMessage = "Password must be 8 characters long."
    }

    /**
     * Validates the ID the user provides.
     * ID must be a combination of eight digits.
     */
    validateID() {
        let id = this.information[3];

        if (id.length != 8)
            this.errorMessage = "ID must be 8 digits long."
        if (isNaN(id))
            this.errorMessage = "ID must contain only digits.";
    }

    /**
     * Validates the phone number the user provides.
     * Phone number must be delimeted by either spaces or
     * dashes. The phone number must contain three groupings of
     * numbers with length 3, 3, 4.
     */
    validatePhone() {
        let phone = this.information[4];

        if (phone.split(" ").length != 3 && phone.split("-").length != 3)
            this.errorMessage = "Phone number must be split by space or dash";

        if (phone.indexOf(" ") != -1) 
            phone = phone.split(" ").join("");
        else if (phone.indexOf("-") != -1)
            phone = phone.split("-").join("");

        if (phone.length != 10)
            this.errorMessage = "Phone number must be 10 digits.";
        if (isNaN(phone))
            this.errorMessage = "Phone number must contain only digits.";
    }

    /**
     * Validates the email address the user provides.
     * If the email is not currently being required any information
     * in the email field is voided and the function is escaped.
     * Otherwise, email must have a valid domain of three to five characters
     * a period, and an ampersand symbol.
     */
    validateEmail() {
        let email = this.information[5];
        let check = document.getElementById("checkbox").checked;

        if (!check) {
            this.information[5] = "";
            return;
        }

        let ampersand = email.indexOf("@");
        let period = email.lastIndexOf(".");

        let length = email.length;
        let domainLength = length - period - 1;


        if (domainLength < 3 || domainLength > 5)
            this.errorMessage = "Email must have valid domain.";
        if (period == -1)
            this.errorMessage = "Email must contain domain.";
        if (ampersand == -1)
            this.errorMessage = "Email must include @ symbol.";
    }

    /**
     * Validates all information provided by the user with 
     * helper functions. If the information fails to validate,
     * display a method to the user about the error.
     */
    validate() {
        this.validateEmail();
        this.validatePhone();
        this.validateID();
        this.validatePassword();
        this.validateFields();

        if (this.errorMessage) {
            this.displayError(this.errorMessage);
            return false;
        }
        this.removeError();
        return true;
    }

    /**
     * Displays a specific error to the user for why
     * the information he or she provided failed to
     * validate.
     * @param {message} errorMessage 
     */
    displayError(errorMessage) {
        let title = document.getElementById("title");

        this.removeError();

        let error = document.createElement("h3");
        let text = document.createTextNode(errorMessage);
        
        error.appendChild(text);

        error.style.color = "red";
        error.style.id = "errorMessage";

        title.appendChild(error);
    }

    /**
     * Removes a displayed error from the screen when updated 
     * information passes validation test.
     */
    removeError() {
        let title = document.getElementById("title");
        if (title.childNodes.length != 3)
            title.removeChild(title.childNodes[title.childNodes.length - 1]);
    }
}

/**
 * Handles information sent by the user and proceeds to validate it.
 * If the information does not pass the validation test, provide the user
 * with a reason. If validation is successfuly, start PHP validation.
 */
function getData() {
    let mainForm = document.getElementById("mainForm");
    let checkForm = document.getElementById("checkbox");
    let dropForm = document.getElementById("dropdown");
    let action = dropForm.options[dropForm.selectedIndex].value;
    let accountInfo = [];
    
    for (let i = 0; i < mainForm.length; i++) 
        accountInfo.push(mainForm[i].value);
    
    accountInfo.push(checkForm.checked);
    account = new Account(accountInfo);
    
    let validation = account.validate();
    if (!validation) 
        return false;
    return true
}

/**
 * Once data is validated send the data to a PHP script that will
 * verify the information is in the accounts database.
 */
function validate() {
    let data = getData();
    if (!data) 
        return;
    
    let form = document.getElementById("mainForm");
    form.method = "post";
    form.setAttribute("onsubmit", "");
    form.setAttribute("action", "../verify/verify.php");
    form.submit();
}

/**
 * Reset form data.
 */
function reset() {
    document.getElementById("mainForm").reset();
    checkValue();
}

/**
 * Toggles display for 'required' text if a checkbox is clicked or not.
 */
function checkBoxPressed() {
    let text = document.getElementById("check_required");
    text.style.display = text.style.display == "none" ? "" : "none";
}

/**
 * Makes a checkbox clicked.
 */
function checkValue() {
    document.getElementById("checkbox").checked = true;
}