<?php
include "./utils/adminAuth.php";
include "./boot/dbConnector.php";

if (isset($_GET["student_id"])) {
    $student_id = $_GET["student_id"];
    $query = "DELETE FROM user WHERE id='" . $student_id . "'";
    $result = mysqli_query($db, $query);
    if ($result) {
        $_SESSION["view_student_msg"] = "Student deleted successfully.";
        $_SESSION["success"] = true;
    } else {
        $_SESSION["view_student_msg"] = "Something went wrong.";
        $_SESSION["success"] = false;
    }
    header("location:view-student.php");
    exit();
}

$sql = "SELECT * FROM user WHERE role='student' AND status='approved'";

$sql_query = mysqli_query($db, $sql);

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

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <?php include('./components/admin-header.php') ?>
            <div class="col py-0">
                <div class="d-flex flex-column justify-content-between auth_page">
                    <div>
                        <h2 class="section_titles">Applied Students</h2>
                        <table class="generic_table">
                            <tr>
                                <th>No</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $rowNumber = 1;
                            while ($row = $sql_query->fetch_assoc()) {
                            ?>
                                <tr>
                                    <td><?php echo $rowNumber ?></td>
                                    <td><?php echo "{$row['fullname']}" ?></td>
                                    <td><?php echo "{$row['email']}" ?></td>
                                    <td><?php echo "{$row['phone']}" ?></td>
                                    <td>
                                        <span class="password"><?php echo str_repeat('*', min(6, strlen($row['password']))); ?></span>
                                        <span data-password="<?php echo $row['password']; ?>" onclick="togglePassword(this)"><i class="fa-regular fa-eye ms-2"></i></span>
                                    </td>
                                    <td>
                                        <a class="d-inline-block" href="update-student.php?student_id=<?= $row["id"] ?>">
                                            <i class="fa-solid fa-pen-to-square me-2" style="color: #000000;"></i>
                                        </a>
                                        <a class="d-inline-block" href="view-student.php?student_id=<?= $row["id"] ?>">
                                            <i class="fa-solid fa-trash" style="color: #ff0000;"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                                $rowNumber++;
                            }
                            ?>
                        </table>
                    </div>
                    <!-- footer -->
                    <?php include "./components/footer.php" ?>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword(button) {
            var passwordSpan = button.previousElementSibling;

            if (passwordSpan.textContent === str_repeat('*', 6)) {
                var originalPassword = button.dataset.password;
                passwordSpan.textContent = originalPassword;
                button.innerHTML = '<i class="fa-regular fa-eye-slash ms-2"></i>';
            } else {
                passwordSpan.textContent = str_repeat('*', 6);
                button.innerHTML = '<i class="fa-regular fa-eye ms-2"></i>';
            }
        }

        function str_repeat(string, repeat) {
            var result = '';
            for (var i = 0; i < repeat; i++) {
                result += string;
            }
            return result;
        }
    </script>
</body>

</html>

<?php
$msg = $_SESSION['view_student_msg'];
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
    $_SESSION['view_student_msg'] = "";
};
?>