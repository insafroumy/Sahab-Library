<?php

require_once "db.php";
if (isset($_SESSION["user"])) {
    header("Location: index.php");
}

include 'header.php';
?>

<body class="log-body vh-100 d-flex align-items-center">
    <div id="login" class="m-auto">
        <div class="container">
            <?php
            if (isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($link, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    if (password_verify($password, $user["password"])) {
                        session_start();
                        $_SESSION["user"] = "yes";
                        $_SESSION['id'] = $user['id'];
                        $_SESSION['user_name'] = $user['full_name'];
                        $_SESSION['user_email'] = $user['email'];
                        header("Location: index.php");
                        die();
                    } else {
                        echo "<div class='alert alert-danger'>كلمة المرور غير صحيحة</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger'>بريد الكتروني خاطئ</div>";
                }
            }
            ?>
            <div class="all  rounded-3 shadow  d-flex align-items-center justefy-content-center bg-white">
                <div class="log-img">
                    <img src="assets/dist/images/reg.jpg" alt="">
                </div>
                <div class="log-form p-3">
                    <form action="login_user.php" method="post">
                        <div class="form-group mb-3">
                            <input type="email" placeholder="البريد الالكتروني:" name="email"
                                class="form-control p-2 p-sm-3">
                        </div>
                        <div class="form-group mb-3">
                            <input type="password" placeholder="كلمة المرور:" name="password"
                                class="form-control p-2 p-sm-3">
                        </div>
                        <div class="form-btn text-center mb-3">
                            <input type="submit" value="تسجيل الدخول" name="login" class="btn btn-primary">
                        </div>
                    </form>
                    <div class="text-center">
                        <p>ليس لديك حساب <a href="registeration.php">إنشاء حساب جديد</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>