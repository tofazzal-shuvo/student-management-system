<?php
// error_reporting(0);
session_start();

if (isset($_POST["login_submit"])) {
    include "boot/dbConnector.php";
    $email = $_POST["email"];
    $passord = $_POST["password"];

    $query = "SELECT * FROM user WHERE email='" . $email . "'";
    $compiled_query = mysqli_query($db, $query);
    $result = mysqli_fetch_array($compiled_query);
    if ($result["status"] === 'requested') {
        $_SESSION["login_msg"] = "You hasn't admitted by admin. Please wait until admin not accept.";
        $_SESSION["success"] = false;
        header("location:login.php");
    }

    $query = "SELECT * FROM user WHERE email='" . $email . "' AND password='" . $passord . "'";
    $compiled_query = mysqli_query($db, $query);
    $result = mysqli_fetch_array($compiled_query);
    echo mysqli_error($db);
    if ($result["role"] === 'student') {
        $_SESSION["role"] = "student";
        $_SESSION["email"] = $email;
        header("location:student-home.php");
    } else if ($result["role"] === 'admin') {
        $_SESSION["role"] = 'admin';
        $_SESSION["email"] = $email;
        header("location:admin-home.php");
    } else {
        $_SESSION["login_msg"] = "Email or password incorrect.";
        $_SESSION["success"] = false;
        header("location:login.php");
    }
} else {
    session_destroy();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS - Login</title>
    <?php
    include './components/header-tags.php'
    ?>
</head>

<body>
    <div class="d-flex flex-column justify-content-between auth_page">
        <?php include './components/authNav.php' ?>

        <section class="my-5">
            <div class="container">
                <div class="row">
                    <h2 class="text-center mb-4">Welcome Back !</h2>
                    <div class="col-md-6 offset-3">
                        <h4 class="text-center" style="font-size: 14px;color: red;">
                            <?php
                            echo $_SESSION['login_msg'];
                            ?>
                        </h4>
                        <form action="#" method="POST">
                            <div class="form-group mb-4">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" placeholder="e.g. jhon@example.com" required>
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="*******" required>
                            </div>
                            <input type="submit" value="Login" name="login_submit" class="btn btn-success">
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <?php include "./components/footer.php" ?>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>