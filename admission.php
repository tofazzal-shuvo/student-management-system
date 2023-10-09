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

$sql = "SELECT * FROM user WHERE role='student' AND status='requested'";
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
                        <table class="generic_table admission_table">
                            <tr>
                                <th>No</th>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Message</th>
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
                                    <td><?php echo "{$row['message']}" ?></td>
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
</body>

</html>