<?php
include "./utils/adminAuth.php";

$host = 'localhost';
$user = 'root';
$passord = '';
$dbName = 'student_management';
$db = mysqli_connect($host, $user, $passord, $dbName);
if ($db === false) {
    die('Database connection error.');
}

$sql = 'SELECT * FROM admission';
$sql_query = mysqli_query($db, $sql);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SMS - Add Student</title>
    <?php
    include './components/header-tags.php'
    ?>
</head>

<body>
<h4 class="text-center" style="font-size: 14px;color: red;">
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php include('./components/admin-header.php') ?>
            <div class="col py-0">
                <div class="d-flex flex-column justify-content-between auth_page">
                    <div class="row">
                        <div class="col-md-4 offset-1">
                            <h2 class="section_titles">Add Student by Admission</h2>
                            <form action="login_check.php" method="POST">
                                <div class="form-group mb-4">
                                    <label for="userId">Select a Student</label>
                                    <select class="form-control" name="userId" required>
                                        <option value=''>
                                            Select Student
                                        </option>
                                        <?php
                                        while ($row  = $sql_query->fetch_assoc()) {
                                        ?>
                                            <option value='<?= $row['id'] ?>'>
                                                <?= $row['username'] ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" placeholder="*******" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password">Confrim Password</label>
                                    <input type="password" class="form-control" name="conrim_password" placeholder="*******" required>
                                </div>
                                <input type="submit" value="Login" class="btn btn-success">
                            </form>
                        </div>
                        <div class="col-md-6">
                            <h2 class="section_titles">Add Student Manually</h2>
                            <div></div>
                        </div>
                    </div>
                    <!-- footer -->
                    <?php include "./components/footer.php" ?>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>