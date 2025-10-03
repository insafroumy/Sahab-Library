<?php
$cookie_name = "cookiesWebsite";
$cookie_value = "Insaf Raghad";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>

<?php
include 'db.php';
if (!(isset($_SESSION["user"]) or isset($_SESSION['admin_id']))) {
    header("Location: login_user.php");
}
include 'header.php';
?>

<body>
    <?php 
    include 'navbar.php';
    ?>

    <!-- start banner section -->
    <section class="banner">
        <div class="container">
            <div class="content p-5">
                <div class="banner-title text-center pt-5 pr-2 pl-2 pb-3">
                    <h2 class="text-dark wow fadeInDown" style="font-weight:600">
                        بمجرّد أن تتعلّم القراءة سوف تصبح حُرًّا للأبد
                    </h2>
                </div>
                
            </div>
        </div>
    </section>
    <!-- end banner section -->

    <!-- start main section -->
    <section class="main pt-5 index">
        <div class="container">
            <div class="row">
                <div class="col-md-3 wow fadeInRight">
                    <div class="card mb-5">
                        <div class="card-header">
                            <h5>
                                <a href="categories.php" class="text-decoration-none text-darkb">التصنيفات</a>
                            </h5>
                        </div>
                        <ul class="list-group list-group-flush index-cat">
                            <li class="list-group-item">
                                <a href="all_books.php" class="text-decoration-none text-dark ">كل الكتب</a>
                            </li>
                            <?php
                            $sql = "SELECT * FROM category";
                            $result = $link->query($sql);

                            ?>
                            <?php if ($result->num_rows > 0) { ?>
                                <?php while ($row = mysqli_fetch_array($result)) { ?>
                                    <li class="list-group-item">
                                        <a href="books.php?category=<?php echo $row['cname']; ?>"
                                            class="text-decoration-none text-dark "><?php echo $row['cname']; ?></a>
                                    </li>
                                <?php } ?>
                            <?php } else {
                                echo "record not found";
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 all-books">
                    <div class="books mb-5">
                        <!-- <div class="row pb-4">
                            <div class="col-md-12"> -->
                        <h4 class="text-right pb-2 border-3 border-primary border-bottom mb-4 wow fadeInDown"
                            style="width: fit-content">
                            الكتب الحديثة :
                        </h4>
                        <!-- </div>
                        </div> -->
                        <div class="row ">
                            <?php

                            $sql = "SELECT * FROM book ORDER BY bid DESC";
                            $result = $link->query($sql);
                            $couter = 0;

                            ?>
                            <?php if ($result->num_rows > 0) { ?>
                                <?php while ($rown = mysqli_fetch_array($result)) {
                                    if ($couter <= 5) {
                                        ?>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                                            <div class="card wow fadeInUp">
                                                <div class="card-image overflow-hidden">
                                                    <img src="assets/bookImages/<?php echo $rown['bimg']; ?>" class="card-img-top"
                                                        alt="..." height="241" width="171" />
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title">

                                                        <a style="text-decoration: none; font-size: 18px; font-weight:600;"
                                                            class="text-darkb px-2 py-1 rounded-3"
                                                            href="book-details.php?id=<?php echo $rown['bid']; ?>&&category=<?php echo $rown['catname']; ?>">
                                                            <?php echo $rown['bname']; ?></a>
                                                    </h6>
                                                    <div class="line">
                                                        <hr />
                                                    </div>
                                                    <div>
                                                        <p>لمحة عن الكتاب : </p>
                                                        <?php echo mb_substr($rown['bdesc'],0,150,"UTF-8") ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php }
                                    $couter = $couter + 1;
                                }
                            } ?>
                        </div>
                    </div>
                    <div class="books mb-5">
                        <!-- <div class="row pb-4">
                            <div class="col-md-12"> -->
                        <h4 class="text-right pb-2 border-3 border-primary border-bottom mb-4 wow fadeInDown"
                            style="width: fit-content">
                            الكتب الأكثر تحميلاً
                        </h4>
                        <!-- </div>
                        </div> -->
                        <div class="row ">
                            <?php

                            $sql = "SELECT * FROM book ORDER BY download DESC";
                            $result = $link->query($sql);
                            $couter = 0;

                            ?>
                            <?php if ($result->num_rows > 0) { ?>
                                <?php while ($rown = mysqli_fetch_array($result)) {
                                    if ($couter <= 3) {
                                        ?>
                                        <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                                            <div class="card wow fadeInUp">
                                                <div class="card-image overflow-hidden">
                                                    <img src="assets/bookImages/<?php echo $rown['bimg']; ?>" class="card-img-top"
                                                        alt="..." height="241" width="171" />
                                                </div>
                                                <div class="card-body">
                                                    <h6 class="card-title">

                                                        <a style="text-decoration: none; font-size: 18px; font-weight:600;"
                                                            class="text-darkb px-2 py-1 rounded-3"
                                                            href="book-details.php?id=<?php echo $rown['bid']; ?>&&category=<?php echo $rown['catname']; ?>">
                                                            <?php echo $rown['bname']; ?></a>
                                                    </h6>
                                                    <div class="line">
                                                        <hr />
                                                    </div>
                                                    <div>
                                                        <p>لمحة عن الكتاب : </p>
                                                        <?php echo mb_substr($rown['bdesc'],0,150,"UTF-8"); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    <?php }
                                    $couter = $couter + 1;
                                }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- end main section -->

    <!-- scroll to top button  -->
    <div id="progress">
        <span id="progress-value">&#x1F815;</span>
    </div>

    <?php include "footer.php"; ?>
</body>

</html>