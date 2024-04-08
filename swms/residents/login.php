<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SWMS | Login</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" href="img/favicon/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="img/favicon/favicon-16x16.png" sizes="16x16">
    

</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen animated fadeInDown">
        <div>
            <div>
                <h1 class="logo-name"><a href="../index.html"><img src="./img/logo.png" alt="Awesome Logo" title=""></a></h1>
            </div>
            <h3>Resident Portal</h3>
      
        <p>Login in to continue.</p>
            
            <?php
            session_start();
            
            include '../database/connection.php';
            
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $username = $_POST['username'];
                $password = $_POST['password'];
            
                $sql = "SELECT * FROM residents WHERE username='$username'";
                $result = $conn->query($sql);
            
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    if (password_verify($password, $row['password'])) {
                        $_SESSION['username'] = $username;
                        header("Location: ./index.php");
                        exit();
                    } else {
                        echo '<div class="alert alert-danger">Username or password</div>';
                    }
                } else {
                    echo '<div class="alert alert-danger">Invalid Username or password</div>';
                }
            }
            ?>
            
            <form class="m-t" role="form" action="#" method="POST">
                    <div class="form-group">
                        <input type="text" id="username" name="username" placeholder="Enter Username" class="form-control" required="">
                    </div>
                <div class="form-group">
                    <input type="password" name="password" class="form-control" placeholder="Password" required="">
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">Login</button>

                <a href="./forgot_password.php"><small>Forgot password?</small></a>
                <p class="text-muted text-center"><small>Do not have an account?</small></p>
                <a class="btn btn-sm btn-white btn-block" href="./register.php">Create an account</a>
            </form>
            <p class="m-t"> <small>Smart Waste Management System</small> </p>
        </div>
    </div>

    <!-- Mainly scripts -->
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
