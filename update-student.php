<?php
// error_reporting(0);
include "./utils/adminAuth.php";
include "./boot/dbConnector.php";

$student_id = $_GET["student_id"];

$find_std_query = "SELECT * FROM user WHERE id='$student_id'";
$compiled_query = mysqli_query($db, $find_std_query);
$student = mysqli_fetch_array($compiled_query);

if (isset($_POST["update_student"])) {
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $conrim_password = $_POST["conrim_password"];

    if ($password !== $conrim_password) {
        $_SESSION["update_student_msg"] = "Password and confirm password not matched.";
        $_SESSION["success"] = false;
        header("location:update-student.php?student_id=$student_id");
        exit();
    }

    $find_with_email = "SELECT * FROM user WHERE (email='$email' OR phone='$phone') AND id!='$student_id'";
    $compiled_query = mysqli_query($db, $find_with_email);
    $result = mysqli_fetch_array($compiled_query);
    if ($result) {
        $_SESSION["update_student_msg"] = "Email or phone exist.";
        $_SESSION["success"] = false;
        header("location:update-student.php?student_id=$student_id");
        exit();
    }
    
    $query = "UPDATE user SET fullname = '$fullname', email = '$email', phone = '$phone', password = '$password' WHERE id = '$student_id'";
    $result = mysqli_query($db, $query);
    if ($result) {
        $_SESSION["update_student_msg"] = "Student has been updated.";
        $_SESSION["success"] = true;
    } else {
        $_SESSION["admission_response"] = "Something went wrong.";
        $_SESSION["success"] = false;
    }
    header("location:update-student.php?student_id=$student_id");
    exit();
}

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
    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php include('./components/admin-header.php') ?>
            <div class="col py-0">
                <div class="d-flex flex-column justify-content-between auth_page">
                    <div class="row mb-5">
                        <div class="col-md-6 offset-3">
                            <h2 class="section_titles">Update Student</h2>
                            <form action="#" method="POST">
                                <div class="form-group mb-4">
                                    <label for="fullname">Full name*</label>
                                    <input type="text" class="form-control" name="fullname" placeholder="e.g. Jhon Dow" required value="<?= $student["fullname"] ?>">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="email">Email address*</label>
                                    <input type="email" class="form-control" name="email" placeholder="e.g. jhon@example.com" required value="<?= $student["email"] ?>">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="phone">Phone*</label>
                                    <input type="number" class="form-control" name="phone" placeholder="e.g. 017XXXXXXXX" required value="<?= $student["phone"] ?>">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password">Password*</label>
                                    <input type="password" class="form-control" name="password" placeholder="*******">
                                </div>
                                <div class="form-group mb-4">
                                    <label for="conrim_password">Confrim Password*</label>
                                    <input type="password" class="form-control" name="conrim_password" placeholder="*******">
                                </div>
                                <input type="submit" value="Update Student" name="update_student" class="btn btn-success">
                            </form>
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

<?php
$msg = $_SESSION['update_student_msg'];
$success = $_SESSION['success'];
if ($msg) {
    if ($success) {
        echo "<script>
                \$(document).ready(function () {
                    toastr.success('$msg');
                });
            </script>";
    } else {
        echo "<script>
                \$(document).ready(function () {
                    toastr.warning('$msg');
                });
            </script>";
    }
    $_SESSION['update_student_msg'] = "";
};
?>