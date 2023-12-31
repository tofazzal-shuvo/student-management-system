<?php
error_reporting(0);
session_start();

if (isset($_POST["admission_form_values"])) {
    include "./boot/dbConnector.php";

    $fullname = $_POST["fullname"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $message = $_POST["message"];

    // Check if the email already exist.
    $query = "SELECT * FROM user WHERE email='" . $email . "' OR phone = '" . $phone . "'";
    $compiled_query = mysqli_query($db, $query);
    if ($compiled_query && mysqli_num_rows($compiled_query) > 0) {
        $_SESSION["admission_response"] = "Email or phone exist.";
        $_SESSION["success"] = false;
        header("location:index.php");
        exit();
    } else {
        $query = "INSERT INTO user(fullname, email, phone, role, message) VALUES('$fullname', '$email', '$phone', 'student', '$message')";
        $result = mysqli_query($db, $query);
        if ($result) {
            $_SESSION["admission_response"] = "Submitted successfully. Please wait until admin accept your request.";
            $_SESSION["success"] = true;
        } else {
            $_SESSION["admission_response"] = "Something went wrong.";
            $_SESSION["success"] = false;
        }
    }
    header("location:index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management System</title>
    <?php
    include './components/header-tags.php'
    ?>
</head>

<body>
    <?php include './components/authNav.php' ?>
    <section>
        <div class="hero_bg">
            <div class="innter_bg">
                <div>
                    <h2 class="d-inline">We teach student with care</h2>
                    <div class="line"></div>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nemo, nisi totam quas doloribus reiciendis aliquam reprehenderit sint atque harum illum.</p>
                </div>
            </div>
        </div>
    </section>
    <section id="about">
        <div class="container">
            <div class="row">
                <div class="col-md-6 my-5">
                    <img src="public/img/school.jpg" alt="" class="img-fluid">
                </div>
                <div class="col-md-6 my-5">
                    <div class="d-flex align-items-center justify-content-center h-100">
                        <div class="w-75">
                            <h2>Welcome to W-Schoool</h2>
                            <p class="text-justify">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Minima nihil quas asperiores ducimus quasi blanditiis reprehenderit nobis fugit voluptates! Numquam tempore doloribus aliquam odit culpa delectus porro nesciunt iure voluptate?</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="about_teachers" class="mb-5">
        <div class="container">
            <div class="row">
                <h2>Our Teachers</h2>
                <div class="col-md-3 mt-4">
                    <div class="card d-block">
                        <img src="public/img/teachers/teacher-1.jpg" alt="" class="img-fluid">
                        <h3 class="pt-4 pb-2 px-2">Oliver Jake</h3>
                        <p class="p-2 pt-0">Aut illum numquam cumque repellendus assumenda mollitia modi ducimus. Dolorem mollitia ad, voluptatem blanditiis quis repellendus aperiam modi tempora, necessitatibus debitis incidunt.</p>
                    </div>

                </div>
                <div class="col-md-3 mt-4">
                    <div class="card d-block">
                        <img src="public/img/teachers/teacher-2.jpeg" alt="" class="img-fluid">
                        <h3 class="pt-4 pb-2 px-2">Noah James</h3>
                        <p class="p-2 pt-0">Aut illum numquam cumque repellendus assumenda mollitia modi ducimus. Dolorem mollitia ad, voluptatem blanditiis quis repellendus aperiam modi tempora, necessitatibus debitis incidunt.</p>
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <div class="card d-block">
                        <img src="public/img/teachers/teacher-3.jpg" alt="" class="img-fluid">
                        <h3 class="pt-4 pb-2 px-2">Mason Robert</h3>
                        <p class="p-2 pt-0">Aut illum numquam cumque repellendus assumenda mollitia modi ducimus. Dolorem mollitia ad, voluptatem blanditiis quis repellendus aperiam modi tempora, necessitatibus debitis incidunt.</p>
                    </div>
                </div>
                <div class="col-md-3 mt-4">
                    <div class="card d-block">
                        <img src="public/img/teachers/teacher-4.jpeg" alt="" class="img-fluid">
                        <h3 class="pt-4 pb-2 px-2">Kyle Joseph</h3>
                        <p class="p-2 pt-0">Aut illum numquam cumque repellendus assumenda mollitia modi ducimus. Dolorem mollitia ad, voluptatem blanditiis quis repellendus aperiam modi tempora, necessitatibus debitis incidunt.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="cources" class="my-5">
        <div class="container">
            <div class="row">
                <h2>Our Cources</h2>
                <div class="col-md-4 mt-4">
                    <div class="card d-block p-2">
                        <div class="text-center">
                            <img src="public/img/cources/cybersecurity.png" alt="" class="img-fluid rounded">
                        </div>
                        <h3 class="pt-3 mb-0">Cybersecurity Professional Certificate</h3>
                        <p class="my-3">This is your path to a career in cybersecurity. In this certificate program, you’ll learn in-demand skills that can have you job-ready in less than 6 months. No degree or experience required.</p>
                        <div class="reveiw d-flex align-items-center">
                            <i class="fa-solid fa-star"></i>
                            <span class="ms-1">4.8 (1.7k reviews)</span>
                        </div>
                        <span class="reveiw mt-3 d-block">Beginner · Professional Certificate · 3 - 6 Months</span>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card d-block p-2">
                        <div class="text-center">
                            <img src="public/img/cources/data-analytics.png" alt="" class="img-fluid rounded">
                        </div>
                        <h3 class="pt-3 mb-0">Data Analytics Professional Certificate</h3>
                        <p class="my-3">This is your path to a career in data analytics. In this program, you’ll learn in-demand skills that will have you job-ready in less than 6 months. No degree or experience required.</p>
                        <div class="reveiw d-flex align-items-center">
                            <i class="fa-solid fa-star"></i>
                            <span class="ms-1">4.5 (1.2k reviews)</span>
                        </div>
                        <span class="reveiw mt-3 d-block">Beginner · Professional Certificate · 3 - 6 Months</span>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card d-block p-2">
                        <div class="text-center">
                            <img src="public/img/cources/project-management.png" alt="" class="img-fluid rounded">
                        </div>
                        <h3 class="pt-3 mb-0">Project Management</h3>
                        <p class="my-3">Start your path to a career in project management. In this program, you’ll learn in-demand skills that will have you job-ready in less than six months. No degree or experience is required.</p>
                        <div class="reveiw d-flex align-items-center">
                            <i class="fa-solid fa-star"></i>
                            <span class="ms-1">4.8 (1.6k reviews)</span>
                        </div>
                        <span class="reveiw mt-3 d-block">Beginner · Professional Certificate · 3 - 6 Months</span>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card d-block p-2">
                        <div class="text-center">
                            <img src="public/img/cources/digital-marketing.png" alt="" class="img-fluid rounded">
                        </div>
                        <h3 class="pt-3 mb-0">Digital Marketing & E-commerce</h3>
                        <p class="my-3">This is your path to a career in digital marketing. In this program, you’ll learn in-demand skills that can have you job-ready in less than 6 months. No degree or experience required.</p>
                        <div class="reveiw d-flex align-items-center">
                            <i class="fa-solid fa-star"></i>
                            <span class="ms-1">4.7 (2.5k reviews)</span>
                        </div>
                        <span class="reveiw mt-3 d-block">Beginner · Professional Certificate · 3 - 6 Months</span>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card d-block p-2">
                        <div class="text-center">
                            <img src="public/img/cources/machine-learning.png" alt="" class="img-fluid rounded">
                        </div>
                        <h3 class="pt-3 mb-0">Machine Learning Specialization</h3>
                        <p class="my-3">#BreakIntoAI with Machine Learning Specialization. Master fundamental AI concepts and develop practical machine learning skills in the beginner-friendly, 3-course program by AI visionary Andrew Ng</p>
                        <div class="reveiw d-flex align-items-center">
                            <i class="fa-solid fa-star"></i>
                            <span class="ms-1">4.9 (2.1k reviews)</span>
                        </div>
                        <span class="reveiw mt-3 d-block">Beginner · Professional Certificate · 1 - 3 Months</span>
                    </div>
                </div>
                <div class="col-md-4 mt-4">
                    <div class="card d-block p-2">
                        <div class="text-center">
                            <img src="public/img/cources/devOps.png" alt="" class="img-fluid rounded">
                        </div>
                        <h3 class="pt-3 mb-0">DevOps and Software Engineering</h3>
                        <p class="my-3">Prepare for a career as a DevOps & Software Engineer. Gain the in-demand skills and hands-on experience to get job-ready in less than 4 months. No prior experience required.</p>
                        <div class="reveiw d-flex align-items-center">
                            <i class="fa-solid fa-star"></i>
                            <span class="ms-1">4.8 (1.7k reviews)</span>
                        </div>
                        <span class="reveiw mt-3 d-block">Beginner · Professional Certificate · 3 - 6 Months</span>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <section class="my-5">
        <div class="container">
            <div class="row">
                <h2 class="text-center mb-4">Admission Form</h2>

                <div class="col-md-6 offset-3">
                    <form action="#" method="POST" id="admission_form">
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
                            <label for="message">Message</label>
                            <textarea class="form-control" id="message" placeholder="Message, what's on your mind?" name="message"></textarea>
                        </div>
                        <input type="submit" value="Apply" name="admission_form_values" class="btn btn-success">
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php include "./components/footer.php" ?>
</body>

</html>

<?php
$msg = $_SESSION['admission_response'];
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
    $_SESSION['admission_response'] = "";
};
?>