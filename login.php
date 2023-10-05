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
                            error_reporting(0);
                            session_start();
                            echo $_SESSION['message'];
                            session_destroy();
                            ?>
                        </h4>
                        <form action="login_check.php" method="POST">
                            <div class="form-group mb-4">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="e.g. Jhon">
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="*******">
                            </div>
                            <input type="submit" value="Login" class="btn btn-success">
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