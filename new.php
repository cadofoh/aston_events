

<?php
//Connect to the Database
require_once "connectdb.php";


// define variables and error messages and set to empty values
$first_name = $last_name = $email = $password = $confirm_password =  $username = $phonenumber = "";
$firstErr = $lastErr =  $emailErr = $password_err = $confirm_password_err =  $username_err = $phoneErr = "";

//Function to sanitize the inputs to stop injections
function sanitize($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//Process the form data when the form is submitted successfully
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    //Check if first name field is empty
    if (empty($_POST["first_name"])) {
        $firstErr = "You Forgot To Enter Your First Name";
    } else {
        $first_name = sanitize(trim($_POST["first_name"]));

        //Checks that the name only contains letters and whitespaces
        if (!preg_match("/^[a-zA-Z ]*$/", $first_name)) {
            $firstErr = "Only letters and white space allowed";
        }
    }

    //Check if last name field is empty
    if (empty($_POST["last_name"])) {
        $lastErr = "You Forgot To Enter Your Last Name";
    } else {
        $last_name = sanitize(trim($_POST["last_name"]));

        //Checks that the name only contains letters and whitespaces
        if (!preg_match("/^[a-zA-Z ]*$/", $last_name)) {
            $lastErr = "Only letters and white space allowed";
        }
    }

    // Check if username field is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter a username.";
    } else if (strlen(trim($_POST["username"])) > 12 || strlen(trim($_POST["username"])) < 4) {
        $username_err = "Username should be between 4 and 12 characters long";
    } else {
        // Prepare a select statement toretreueve username field
        $sql = "SELECT user_id FROM users_table WHERE username = ?";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_username);

            // Set parameters
            $param_username = sanitize(trim($_POST["username"]));

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {

                // store result
                $stmt->store_result();

                //Check if username is already taken
                if ($stmt->num_rows == 1) {
                    $username_err = "This username is already taken.";
                } else {
                    $username = sanitize(trim($_POST["username"]));
                }
            } else {
                echo " Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    //Check if phone number field is empty
    if (empty($_POST["phonenumber"])) {
        $phoneErr = "You Forgot To Enter Your Phone Number";
    } else {
        $phonenumber = sanitize(trim($_POST["phonenumber"]));

        //Phone Number Validation for UK numbers
        $pattern = "/^(((\+44\s?\d{4}|\(?0\d{4}\)?)\s?\d{3}\s?\d{3})|((\+44\s?\d{3}|\(?0\d{3}\)?)\s?\d{3}\s?\d{4})|((\+44\s?\d{2}|\(?0\d{2}\)?)\s?\d{4}\s?\d{4}))(\s?\#(\d{4}|\d{3}))?$/";
        $match = preg_match($pattern, $phonenumber);
        if ($match != false) {
            //Phone Number is Valid
        } else {
            $phoneErr = "Please enter a valid UK Number (eg.+441234567890 or 07361234567)";
        }
    }

    //Validates email
    if (empty(trim($_POST["email"]))) {
        $emailErr = "You Forgot to Enter Your Email!";
    } else {
        $email = sanitize(trim($_POST["email"]));

        // Validation for aston emails only
        $ending = 'aston.ac.uk';
        if (!preg_match("/([\w\-]+\@[$ending])/", $email)) {
            $emailErr = "Please enter a valid Aston Email";
        }
    }

    //Validates password & confirm passwords using regex.
    if (!empty($_POST["password"]) && ($_POST["password"] == $_POST["confirm_password"])) {
        $password = sanitize(trim($_POST["password"]));
        $confirm_password = trim($_POST["confirm_password"]);
        if (strlen($_POST["password"]) <= '7') {
            $password_err = "Your Password Must Contain At Least 8 Characters";
        } elseif (!preg_match("#[0-9]+#", $password)) {
            $password_err = "Your Password Must Contain At Least 1 Number!";
        } elseif (!preg_match("#[A-Z]+#", $password)) {
            $password_err = "Your Password Must Contain At Least 1 Capital Letter!";
        } elseif (!preg_match("#[a-z]+#", $password)) {
            $password_err = "Your Password Must Contain At Least 1 Lowercase Letter!";
        }
    } elseif (!empty($_POST["password"])) {
        $confirm_password_err = "Please Check You've Entered Or Confirmed Your Password and they are the same";
    } else {
        $password_err = " Please Check You've Entered Or Confirmed Your Password And They Are The Same";
    }

    //Action to perform if all validation checks are passed
    if (
        empty($firstErr) && empty($lastErr) && empty($username_err) && empty($phoneErr)
        && empty($password_err) && empty($confirm_password_err)
    ) {
        //Prepare an Insert Statement
        $sql = "INSERT INTO users_table (first_name,last_name,email, username,password,phonenumber)
        VALUES (?,?,?,?,?,?);";

        if ($stmt = $conn->prepare($sql)) {
            //Bind Variables to the prepared statement as paramters
            $stmt->bind_param(
                "ssssss",
                $param_first_name,
                $param_last_name,
                $param_email,
                $param_username,
                $param_password,
                $param_phonenumber
            );

            //Set the bound paramaters to variables
            $param_first_name = $first_name;
            $param_last_name = $last_name;
            $param_email = $email;
            $param_username = $username;
            $param_phonenumber = $phonenumber;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password

            if ($stmt->execute()) {
                // Redirect to login page after showing success message
                header("Refresh:2;url=login.php");
                $success = "<div class='text-center alert alert-success'>Account Created successfully.</div>";
            } else {
                echo "Something went wrong. Please try again later.";
            }
            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
?>



<body>
    <?php include('header.php'); ?>
    <div class="background">
        <div class="div-center">
            <div class="contents">

                <!-- Sign Up Form -->
                <h2>Sign Up</h2>
                <p>Please fill this form to create an account.</p>
                <hr />
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()">
                    <?php if (isset($success)) {
                        echo $success;
                    } ?>
                    <div class="form-group">
                        <div class="row">
                            <div class="col"><input type="text" name="first_name" class="form-control <?php echo (!empty($firstErr)) ? 'is-invalid' : ''; ?>" placeholder="First Name" value="<?php echo $first_name; ?>">
                                <span class="invalid-feedback"><?php echo $firstErr; ?></span>
                            </div>

                            <div class="col"><input type="text" name="last_name" class="form-control <?php echo (!empty($lastErr)) ? 'is-invalid' : ''; ?>" name="last_name" placeholder="Last Name" value="<?php echo $last_name; ?>">
                                <span class="invalid-feedback"><?php echo $lastErr; ?></span>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Email</label>
                        <input type="text" name="email" class="form-control <?php echo (!empty($emailErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>" placeholder="Email" value="<?php echo $email; ?>">
                        <span class="invalid-feedback"><?php echo $emailErr; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>" placeholder="Username" value="<?php echo $username; ?>">
                        <span class="invalid-feedback"><?php echo $username_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phonenumber" class="form-control <?php echo (!empty($phoneErr)) ? 'is-invalid' : ''; ?>" placeholder="Phone Number" value="<?php echo $phonenumber; ?>">
                        <span class="invalid-feedback"><?php echo $phoneErr; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>" placeholder="Password">
                        <span class="invalid-feedback"><?php echo $password_err; ?></span>
                    </div>

                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>" placeholder="Confirm Password">
                        <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                    </div>

                    <div class="form-group">
                        <input type="submit" class="btn btn-primary" value="Submit">

                    </div>
                    <p>Already have an account? <a href="login.php">Login here</a>.</p>
                </form>

            </div>

        </div>
    </div>

    <script src="js/script.js"></script>
    <div class="footer">&copy; 2021 All Rights Reserved, Designed by Chief Adofoh </div>
</body>

</html>