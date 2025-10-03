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
                    <li class="breadcrumb-item "><a href="index.php" class="text-decoration-none text-white">الرئيسية</a></li>
                    <li class="breadcrumb-item text-white active" aria-current="page">الكتب</li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="pt-5 pb-5 index">
        <div class="container">
            <div class="row">

                <div class="col-md-3">
                    <div class="card mb-5 wow fadeInRight">
                        <div class="card-header">
                            <h5>
                                <a href="categories.php" class="text-decoration-none text-dark">التصنيفات</a>
                            </h5>
                        </div>
                        <ul class="list-group list-group-flush index-cat">
                            <!-- <li class="list-group-item">كل الكتب </li> -->
                            <?php
                            $sql = "SELECT * FROM category";
                            $result = $link->query($sql);

                            ?>
                            <?php if ($result->num_rows > 0) { ?>
                                <?php while ($row = mysqli_fetch_array($result)) {
                                    $te = $row['cid'];
                                    ;
                                    ?>

                                    <li class="list-group-item" id="tagg" onclick="test()">

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


                <?php
                if (isset($_GET['category'])) {
                    $bookCat = $_GET['category'];
                }
                ?>

                <div class="col-md-9 pb-2 all-books">
                    <div class="row pb-4 ">
                        <div class="col-md-12">


                            <h4 class=" wow fadeInDown float-start pb-2 border-3 border-primary border-bottom mt-10">
                                <?php echo $bookCat ?>
                            </h4>

                        </div>
                    </div>

                    <div class="row  ">
                        <?php

                        $sql = "SELECT * FROM book ";
                        $resultb = $link->query($sql);

                        ?>
                        <?php if ($resultb->num_rows > 0) { ?>
                            <?php while ($row = mysqli_fetch_array($resultb)) {

                                if ($row['catname'] == $bookCat) {
                                    ?>
                                    <div class="col-12 col-md-6 col-lg-4 col-xl-3 mb-4">
                                        <div class="card wow fadeInUp">
                                            <div class="card-image overflow-hidden">
                                                <img src="assets/bookImages/<?php echo $row['bimg']; ?>" class="card-img-top" alt="..."
                                                    height="241" width="171" />
                                            </div>
                                            <div class="card-body">
                                                <h6 class="card-title">
                                                    <a style="text-decoration: none; font-size: 18px; font-weight:600;" class="text-darkb px-2 py-1 rounded-3"
                                                        href="book-details.php?id=<?php echo $row['bid']; ?>&&category=<?php echo $row['catname']; ?>">
                                                        <?php echo $row['bname']; ?></a>
                                                </h6>
                                                <div class="line">
                                                    <hr />
                                                </div>
                                                <div>
                                                    <p>لمحة عن الكتاب : </p>
                                                    <?php echo mb_substr($row['bdesc'],0,150,"UTF-8"); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }

                            }
                        } ?>

                    </div>
                </div>

            </div>
        </div>
    </section>

    <?php include "footer.php"; ?>

</body>

</html>