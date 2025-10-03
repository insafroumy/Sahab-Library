<?php
include 'db.php';
if (!(isset($_SESSION["user"]) or isset($_SESSION['admin_id']))) {
    header("Location: login_user.php");
}
include 'header.php';
?>

<body class="">
    <?php include 'navbar.php';
    $sql = "SELECT * FROM policy where id=1";
    $result = $link->query($sql);
    $row = $result->fetch_assoc();
    ?>

    <section class="pt-5 pb-5 bg-light" id="policy">
        <div class="bg-img" style="background: url(assets/dist/images/logo1b.png) no-repeat center center;"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row pb-4">
                        <div class="col-md-12">
                            <h4 class=" pb-2 border-3 border-primary border-bottom m-auto wow fadeInDown"
                                style="width:fit-content;"> سياسية الخصوصية</h4>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 wow fadeInUp" style="font-size: 20px; text-align: justify; line-height:1.7;">
                        <p style="line-height: 1.8;">
                            <?php echo $row['policytext'] ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include 'footer.php'; ?>

</body>

</html>