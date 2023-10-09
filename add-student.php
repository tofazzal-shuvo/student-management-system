<?php
include "./utils/adminAuth.php";

$host = 'localhost';
$user = 'root';
$password = '';
$dbName = 'student_management';
$db = mysqli_connect($host, $user, $password, $dbName);
if ($db === false) {
    die('Database connection error.');
}
$list_sql = "SELECT * FROM user WHERE role='student' AND status='requested'";
$student_list = mysqli_query($db, $list_sql);

if (isset($_POST["add_requested_student"])) {
    $userId = $_POST["userId"];
    $password = $_POST["password"];
    $conrim_password = $_POST["conrim_password"];
    if ($password !== $conrim_password) {
        $_SESSION["add_student_msg"] = "Password and confirm password not matched.";
        $_SESSION["success"] = false;
        header("location:add-student.php");
        exit();
    }
    $update_sql = "UPDATE user SET status='approved', password='$password' WHERE id='" . $userId . "'";
    $result = mysqli_query($db, $update_sql);
    if ($result) {
        $_SESSION["add_student_msg"] = "User has been added.";
        $_SESSION["success"] = true;
    } else {
        $_SESSION["add_student_msg"] = "Something went wrong.";
        $_SESSION["success"] = false;
    }
    header("location:add-student.php");
    exit();
}

if (isset($_POST["add_student_menually"])) {
    $role = "student";
    $status = "approved";
    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $password = $_POST["password"];
    $conrim_password = $_POST["conrim_password"];
    if ($password !== $conrim_password) {
        $_SESSION["add_student_msg"] = "Password and confirm password not matched.";
        $_SESSION["success"] = false;
        header("location:add-student.php");
        exit();
    }
    $query = "SELECT * FROM user WHERE email='" . $email . "' OR phone='" . $phone . "'";
    $compiled_query = mysqli_query($db, $query);
    $result = mysqli_fetch_array($compiled_query);
    if ($result) {
        $_SESSION["add_student_msg"] = "Email or phone exist.";
        $_SESSION["success"] = false;
        header("location:add-student.php");
        exit();
    }
    $query = "INSERT INTO user(fullname, email, phone, role, password, status) VALUES('$fullname', '$email', '$phone', '$role', '$password', '$status')";
    $result = mysqli_query($db, $query);
    if ($result) {
        $_SESSION["add_student_msg"] = "Student has been added.";
        $_SESSION["success"] = true;
    } else {
        $_SESSION["admission_response"] = "Something went wrong.";
        $_SESSION["success"] = false;
    }
    header("location:add-student.php");
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
                        <div class="col-md-4 offset-1">
                            <h2 class="section_titles">Approve Student Request</h2>
                            <form action="#" method="POST">
                                <div class="form-group mb-4">
                                    <label for="userId">Select a Student*</label>
                                    <select class="form-control" name="userId" required>
                                        <option value=''>
                                            Select Student
                                        </option>
                                        <?php
                                        while ($row  = $student_list->fetch_assoc()) {
                                        ?>
                                            <option value='<?= $row['id'] ?>'>
                                                <?= $row['fullname'] ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password">Password*</label>
                                    <input type="password" class="form-control" name="password" placeholder="*******" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="conrim_password">Confrim Password*</label>
                                    <input type="password" class="form-control" name="conrim_password" placeholder="*******" required>
                                </div>
                                <input type="submit" value="Approve" name="add_requested_student" class="btn btn-success">
                            </form>
                        </div>
                        <div class="col-md-4 offset-1">
                            <h2 class="section_titles">Add Student Manually</h2>
                            <form action="#" method="POST">
                                <div class="form-group mb-4">
                                    <label for="fullname">Full name*</label>
                                    <input type="text" class="form-control" name="fullname" placeholder="e.g. Jhon Dow" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="email">Email address*</label>
                                    <input type="email" class="form-control" name="email" placeholder="e.g. jhon@example.com" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="phone">Phone*</label>
                                    <input type="number" class="form-control" name="phone" placeholder="e.g. 017XXXXXXXX" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="password">Password*</label>
                                    <input type="password" class="form-control" name="password" placeholder="*******" required>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="conrim_password">Confrim Password*</label>
                                    <input type="password" class="form-control" name="conrim_password" placeholder="*******" required>
                                </div>
                                <input type="submit" value="Add Student" name="add_student_menually" class="btn btn-success">
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
$msg = $_SESSION['add_student_msg'];
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
    $_SESSION['add_student_msg'] = "";
};
?>