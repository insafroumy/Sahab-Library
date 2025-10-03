<?php
include 'db.php';
if (!(isset($_SESSION["user"]) or isset($_SESSION['admin_id']))) {
    header("Location: login_user.php");
}
include 'header.php';
?>

<body>
    <?php include 'navbar.php'; ?>

    <div class="pt-3 pb-3 align-items-center bg-darkb bg-gradient">
        <div class="container">
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item "><a href="index.php"
                            class="text-decoration-none text-white">الرئيسية</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">التصنيفات</li>
                </ol>
            </nav>
        </div>
    </div>


    <section class="pt-5 pb-5">
        <div class="container">
            <h4 class=" mx-auto mb-5 pb-2 border-3 border-primary border-bottom wow fadeInDown"
                style="width:fit-content">التصنيفات</h4>
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-6 g-4">

                <?php $delay = 0;
                $sql = "SELECT * FROM category";
                $result = $link->query($sql);
                if ($result->num_rows > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        ?>

                        <div class="col">
                            <div class="card category wow fadeInUp" data-wow-delay="<?php echo $delay ?>s">
                                <div class="card-body text-center">

                                    <a href="books.php?category=<?php echo $row['cname']; ?>"
                                        class="text-decoration-none text-dark d-block">
                                        <h6 class="card-title text-darkb" style="font-weight:600; font-size:18px">
                                            <?php echo $row['cname']; ?>
                                        </h6>
                                    </a>

                                </div>
                            </div>
                        </div>

                        <?php $delay += .2;
                    }
                } ?>

            </div>
        </div>

    </section>


    <?php include "footer.php"; ?>


</body>

</html>