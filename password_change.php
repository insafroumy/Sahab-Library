<?php

require_once "db.php";
// if (isset($_SESSION["user"])) {
//     header("Location: index.php");
// }



// $uid = $_GET['id'];

include 'header.php';

// $id=5;


?>

<body class="log-body vh-100 d-flex align-items-center">
<div id="login" class="m-auto">
    <div class="container">
        <?php

        if (isset($_POST["change"])) {
            // password_hash($_POST["old_pass"], PASSWORD_DEFAULT);
            $old_pass =$_POST["old_pass"];
            $new_pass = $_POST["new_pass"];
            $confirm = $_POST["confirm"];
            $id=$_POST['id'];
            $passwordHash = password_hash($new_pass, PASSWORD_DEFAULT);


            $sql = "SELECT * FROM users where id = '$id'";
            $result = $link->query($sql);
            $rown = mysqli_fetch_assoc($result);

            if (($new_pass == $confirm) ) {
                
                If(password_verify($old_pass , $rown["password"])){
                    $stmt = $link->prepare('UPDATE users set password=?  WHERE id=? ;');
                    // Bind variables to the prepared statement as parameters
                    $stmt->bind_param(
                        "si",
                        $passwordHash,
                        $id
                    );
            
                    // Set parameters
                    $exc = $stmt->execute();
                    // echo "<div class='alert alert-success'>تم تغيير كلمة المرور</div>";
            
                    // Attempt to execute the prepared statement
                    if ($exc) {
                        // Records created successfully. Redirect to landing page
                        // header("location: index.php");
                        // echo "ok";
                        echo "<div class='alert alert-success'>تم تغيير كلمة المرور</div>";
                        header("location: index.php");
                        // exit();
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }

            }else{
                echo "<div class='alert alert-danger'>كلمة مرور غير صحيحة</div>";
            }
        }
        ?>
        <div class="all  rounded-3 shadow  d-flex align-items-center justefy-content-center bg-white">
            <div class="log-img">
                <img src="assets/dist/images/reg.jpg" alt="">
            </div>
            <div class="log-form p-3">
                <form action="password_change.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $_SESSION['id']; ?>">
                <div class="form-group mb-3">
                        <input type="password" placeholder="كلمة المرور القديمة:" name="old_pass" class="form-control p-2 p-sm-3">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" placeholder="كلمة المرور الجديدة:" name="new_pass" class="form-control p-2 p-sm-3">
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" placeholder="تأكيد كلمة المرور:" name="confirm" class="form-control p-2 p-sm-3">
                    </div>
                    <div class="form-btn text-center mb-3">
                        <input type="submit" value="تغيير كلمة المرور" name="change" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>