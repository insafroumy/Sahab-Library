<?php

require_once "db.php";
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
include 'header.php';
?>

<body class="reg-body vh-100 d-flex align-items-center">
    <div id="register" class="m-auto">
        <div class="container p-0">
            <?php
            if (isset($_POST["submit"])) {
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];
            
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();
            
            if (empty($fullName) OR empty($email) OR empty($password) OR empty($passwordRepeat)) {
                array_push($errors,"جميع الحقول مطلوبة");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "بريد الكتروني خاطئ");
            }
            if (strlen($password)<8) {
                array_push($errors,"يجب أن تحتوي كلمة المرور على 8 رموز على الاقل");
            }
            if ($password!==$passwordRepeat) {
                array_push($errors,"كلمة المرور غير متطابقة");
            }
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($link, $sql);
            $rowCount = mysqli_num_rows($result);
            if ($rowCount>0) {
                array_push($errors,"البريد الالكتروني موجود بالفعل!");
            }
            if (count($errors)>0) {
                foreach ($errors as  $error) {
                    echo "<div class='alert alert-danger m-2'>$error</div>";
                }
            }else{
                
                $sql = "INSERT INTO users (full_name, email, password) VALUES ( ?, ?, ? )";
                $stmt = mysqli_stmt_init($link);
                $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt,"sss",$fullName, $email, $passwordHash);
                    mysqli_stmt_execute($stmt);
                    echo "<div class='alert alert-success'>تم إنشاء حسابك بنجاح</div>";
                }else{
                    die("Something went wrong");
                }
            }
            

            }
            ?>
                <div class="all d-flex align-items-center justefy-content-between bg-white rounded-3 shadow ">
                    <div class="reg-img">
                        <img src="assets/dist/images/reg.jpg" alt="">
                    </div>
                    <div class="reg-form p-3">
                        <form action="registeration.php" method="post">
                            <div class="form-group mb-3">
                                <input type="text" class="form-control p-2 p-sm-3" name="fullname" placeholder="الاسم كامل:">
                            </div>
                            <div class="form-group mb-3">
                                <input type="emamil" class="form-control p-2 p-sm-3" name="email" placeholder="البريد الإلكتروني:">
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control p-2 p-sm-3" name="password" placeholder="كلمة المرور:">
                            </div>
                            <div class="form-group mb-3">
                                <input type="password" class="form-control p-2 p-sm-3" name="repeat_password" placeholder="تأكيد كلمة المرور:">
                            </div>
                            <div class="form-btn mb-3 text-center">
                                <input type="submit" class="btn btn-primary" value="إنشاء حساب جديد" name="submit">
                            </div>
                        </form>
                        <div class="text-center"><p>لديك حساب بالفعل <a href="login_user.php">تسجيل الدخول</a></p></div>
                    </div>
                </div>
            
        </div>
    </div>
</body>
</html>