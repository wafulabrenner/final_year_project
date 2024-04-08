<?php
// Include the database connection file
include '../database/connection.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['userName'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phoneNumber = $_POST['phoneNumber']; 

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("INSERT INTO residents (username, password, first_name, last_name, email, address, phone_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssi", $username, $hashed_password, $name, $surname, $email, $address, $phoneNumber);

    if ($stmt->execute()) {
        // Registration successful, redirect to a success page
        header("Location: register.php?register=success");
        exit(); // Stop further execution
    } else {
        // Registration failed, reload the page
        header("Location: register.php?register=fail");
        exit(); // Stop further execution
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SWMS | Register</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
    <link href="css/plugins/iCheck/custom.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="img/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="img/favicon/favicon-16x16.png" sizes="16x16">

    <link href="css/plugins/steps/jquery.steps.css" rel="stylesheet">

     <!-- Sweet Alert -->
     <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">


</head>

<body class="gray-bg">

    <div class="middle-box text-center animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name"><a href="../index.html"><img src="./img/logo.png" alt="Awesome Logo" title=""></a></h1>

            </div>
            <h3>Resident Registration</h3>
            <p>Create account to continue.</p>
            <form id="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="wizard-big">
                <h1>Account</h1>
                <fieldset>
                    <h2>Account Information</h2>
                    <div class="row">
                        <div class="col-sm-6 b-r">
                            <div class="form-group">
                                <label>Username *</label>
                                <input id="userName" name="userName" type="text" class="form-control required">
                            </div>
                            <div class="form-group">
                                <label>Password *</label>
                                <input id="password" name="password" type="password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Confirm Password *</label>
                                <input id="confirm" name="confirm" type="password" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <h4>Have an Account?</h4>
                            <p>Sign in here:</p>
                            <p class="text-center">
                                <a href="login.php"><i class="fa fa-sign-in big-icon"></i></a>
                            </p>
                        </div>
                    </div>

                </fieldset>
                <h1>Profile</h1>
                <fieldset>
                    <h2>Profile Information</h2>
                    <div class="row">
                        <div class="col-lg-6 b-r">
                            <div class="form-group">
                                <label>First name *</label>
                                <input id="name" name="name" type="text" class="form-control required">
                            </div>
                            <div class="form-group">
                                <label>Last name *</label>
                                <input id="surname" name="surname" type="text" class="form-control required">
                            </div>
                            <div class="form-group">
                            <label for="phoneNumber">Phone Number:</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber">
                        </div>
                        </div>
                        
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email *</label>
                                <input id="email" name="email" type="text" class="form-control required email">
                            </div>
                            <div class="form-group">
                                <label>Address *</label>
                                <input id="address" name="address" type="text" class="form-control required">
                            </div>
                        </div>
                    </div>
                </fieldset>

                <h1>Warning</h1>
                <fieldset>
                    <div class="text-center" style="margin-top: 120px">
                        <h2>Notifications</h2>
                        <input id="notifications" name="notifications" type="checkbox"> <label for="notifications">I agree to receive Notifications.</label>
                    </div>
                </fieldset>

                <h1>Finish</h1>
                <fieldset>
                    <h2>Terms and Conditions</h2>
                    <input id="acceptTerms" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms">I agree with the Terms and Conditions.</label>
                </fieldset>
            </form>
            <p class="m-t"> <small>Smart Waste Management System</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="js/plugins/iCheck/icheck.min.js"></script>


    <!-- Steps -->
    <script src="js/plugins/steps/jquery.steps.min.js"></script>


    <!-- Jquery Validate -->
    <script src="js/plugins/validate/jquery.validate.min.js"></script>
      
    <!-- Sweet alert -->
    <script src="js/plugins/sweetalert/sweetalert.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>



    <script>
        $(document).ready(function () {

            $("#wizard").steps();
            $("#form").steps({
                bodyTag: "fieldset",
                onStepChanging: function (event, currentIndex, newIndex) {
                    // Always allow going backward even if the current step contains invalid fields!
                    if (currentIndex > newIndex) {
                        return true;
                    }

                    // Forbid suppressing "Warning" step if the user is to young
                    if (newIndex === 3 && Number($("#age").val()) < 18) {
                        return false;
                    }

                    var form = $(this);

                    // Clean up if user went backward before
                    if (currentIndex < newIndex) {
                        // To remove error styles
                        $(".body:eq(" + newIndex + ") label.error", form).remove();
                        $(".body:eq(" + newIndex + ") .error", form).removeClass("error");
                    }

                    // Disable validation on fields that are disabled or hidden.
                    form.validate().settings.ignore = ":disabled,:hidden";

                    // Start validation; Prevent going forward if false
                    return form.valid();
                },
                onStepChanged: function (event, currentIndex, priorIndex) {
                    // Suppress (skip) "Warning" step if the user is old enough.
                    if (currentIndex === 2 && Number($("#age").val()) >= 18) {
                        $(this).steps("next");
                    }

                    // Suppress (skip) "Warning" step if the user is old enough and wants to the previous step.
                    if (currentIndex === 2 && priorIndex === 3) {
                        $(this).steps("previous");
                    }
                },
                onFinishing: function (event, currentIndex) {
                    var form = $(this);

                    // Disable validation on fields that are disabled.
                    // At this point it's recommended to do an overall check (mean ignoring only disabled fields)
                    form.validate().settings.ignore = ":disabled";

                    // Start validation
                    // Start validation; Prevent form submission if false
                    return form.valid();
                },
                onFinished: function (event, currentIndex) {
                    var form = $(this);

                    // Submit form input
                    form.submit();
                }
            }).validate({
                errorPlacement: function (error, element) {
                    element.before(error);
                },
                rules: {
                    confirm: {
                        equalTo: "#password"
                    }
                }
            });

            // Display notifications
           
<?php if (isset($_GET['register'])) {
    if ($_GET['register'] == 'success') { ?>
        Swal.fire({
            icon: 'success',
            title: 'Registration Successful',
            html: 'Click <a href="login.php">here</a> to login.'
        });
    <?php } else { ?>
        Swal.fire({
            icon: 'error',
            title: 'Registration Failed',
            text: 'Please try again later.'
        });
    <?php }
} ?>

        });

    </script>
</body>

</html>
