<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="public/css/styles.css">

    <script src="https://kit.fontawesome.com/a12e2d22ef.js" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Mooli&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Mooli&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;500&display=swap" rel="stylesheet"> -->
    <!-- <link href="https://fonts.googleapis.com/css2?family=Mooli&family=Open+Sans:wght@300;500&family=Roboto+Mono:wght@300;500&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet"> -->
</head>

<body>
    <div class="d-flex flex-column justify-content-between auth_page">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container">
                <!-- <div class="row">
                <div class="col-md-12"> -->
                <a class="navbar-brand" href="#">Navbar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Admission</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-disabled="true">Login</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- </div>

        </div> -->
        </nav>

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
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex justify-content-between align-items-center footer_inner">
                            <span>© 2023 Coursera Inc. All rights reserved.</span>
                            <div>
                                <i class="fa-brands fa-facebook-f"></i>
                                <i class="fa-brands fa-linkedin-in"></i>
                                <i class="fa-brands fa-twitter"></i>
                                <i class="fa-brands fa-instagram"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>