<?php
include 'db.php';
if (!(isset($_SESSION["user"]) or isset($_SESSION['admin_id']))) {
    header("Location: login_user.php");
}
include 'header.php';
?>

<body>
    <?php include 'navbar.php'; ?>

    <div class="pt-3 pb-3 align-items-center bg-gradient bg-darkb">
        <div class="container">
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item "><a href="index.php"
                            class="text-decoration-none text-white">الرئيسية</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">الكتب</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="pt-5 pb-5 all-books">
        <div class="container">
            <div class="row">

                <h4 class=" mx-auto mb-5 pb-2 border-3 border-primary border-bottom wow fadeInDown"
                    style="width:fit-content"> كل الكتب</h4>

                <div class="row gap-5 justify-content-center">
                    <?php

                    $sql = "SELECT * FROM book ";
                    $result = $link->query($sql);
                    // $couter = 0;
                    
                    ?>
                    <?php if ($result->num_rows > 0) { ?>
                        <?php while ($rown = mysqli_fetch_array($result)) {

                            ?>
                            <div class="col-12 col-md-3 col-sm-5 p-2 p-sm-0">
                                <div class="card wow fadeInUp">
                                    <div class="card-image overflow-hidden">
                                        <img src="assets/bookImages/<?php echo $rown['bimg']; ?>" class="card-img-top" alt="..."
                                            height="241" width="171" />
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <a style="text-decoration: none; font-size: 18px; font-weight:600; "
                                                class="text-darkb px-2 py-1 rounded-3"
                                                href="book-details.php?id=<?php echo $rown['bid']; ?>&&category=<?php echo $rown['catname']; ?>">
                                                <?php echo $rown['bname']; ?></a>
                                        </h6>
                                        <div class="line">
                                            <hr />
                                        </div>
                                        <div>
                                            <p style="font-weight:600">لمحة عن الكتاب : </p>
                                            <p class="m-0 text-secondary">
                                                <?php echo mb_substr($rown['bdesc'], 0, 150, "UTF-8"); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php

                        }
                    } ?>
                </div>


            </div>
        </div>
    </section>

    <!-- scroll to top button  -->
    <div id="progress">
        <span id="progress-value">&#x1F815;</span>
    </div>


    <?php include "footer.php"; ?>
</body>

</html>