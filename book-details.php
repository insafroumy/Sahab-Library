<?php
include 'db.php';
if (!(isset($_SESSION["user"]) or isset($_SESSION['admin_id']))) {
    header("Location: login_user.php");
}
include 'header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>


<body>
    <?php include 'navbar.php'; ?>

    <?php
    $sql = "SELECT * FROM book where bid= '$id'";
    $result = $link->query($sql);
    $rown = mysqli_fetch_assoc($result);
    ?>

    <div class="pt-3 pb-3 align-items-center bg-darkb bg-gradient">
        <div class="container">
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item "><a href="#" class="text-decoration-none text-white">الرئيسية</a></li>
                    <li class="breadcrumb-item "><a href="#" class="text-decoration-none text-white">الكتب</a></li>
                    <li class="breadcrumb-item active text-white" aria-current="page">
                        <?php echo $rown['bname']; ?>
                    </li>
                </ol>
            </nav>
        </div>
    </div>


    <section class="pt-5 pb-5">
        <div class="container">
            <div class="row">

                <div class="col-md-12">
                    <div class="row pb-4">
                        <div class="col-md-12">
                            <h4 class=" float-start pb-2 border-3 border-primary border-bottom wow fadeInDown">
                                <?php echo $rown['bname']; ?>
                            </h4>
                        </div>
                    </div>
                    <div class="row  g-4">
                        <div class="col-md-6 col-lg-3">
                            <div class="b-img border shadow rounded-3 p-2 bg-light wow fadeInRight">
                                <img src="assets/bookImages/<?php echo $rown['bimg']; ?>" class="card-img-top" alt="..."
                                    height="250" width="171">
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item border-0 text-secondary wow fadeInUp" data-wow-delay="0s">
                                    <i class="fa fa-list"></i> التصنيف: <a href="categories.php"
                                        class="text-decoration-none text-darkb"><?php echo $rown['catname']; ?> </a>
                                </li>
                                <li class="list-group-item border-0 text-secondary wow fadeInUp" data-wow-delay=".1s">
                                    <i class="fa fa-user"></i> المؤلف:
                                    <span class="text-darkb">
                                        <?php echo $rown['aname']; ?>
                                    </span>
                                </li>
                                <li class="download list-group-item border-0 text-secondary wow fadeInUp" id="countbook"
                                    data-wow-delay=".2s">
                                    <i class="fa fa-download"></i> التحميلات: <span class="text-darkb">
                                        <?php echo $rown['download']; ?>
                                    </span>
                                </li>
                                <li class="list-group-item border-0 text-secondary wow fadeInUp" data-wow-delay=".3s">
                                    <i class="fa fa-calculator"></i> تاريخ النشر: <span class=" text-darkb">
                                        <?php echo $rown['bdate']; ?>
                                    </span>
                                </li>
                                <li class="list-group-item border-0 text-secondary wow fadeInUp" data-wow-delay=".4s">
                                    <i class="fa fa-file"></i> نوع الملف: <span class=" text-darkb">pdf</span>
                                </li>

                                <li class="btn-group mt-2 wow fadeInUp" data-wow-delay=".5s" role="group">
                                    <a href="assets/bookFiles/<?php echo $rown['bpdf']; ?>" download>
                                        <button class=" countBtn btn btn-outline-success rounded-0 " id="countBtn"
                                            data-id="<?php echo $rown['bid']; ?>"
                                            style="border-top-right-radius:50px !important; border-bottom-right-radius:50px !important;">
                                            <i class="fa fa-download"></i> تحميل
                                        </button>
                                    </a>

                                    <a
                                        href="read-book.php?id=<?php echo $rown['bid']; ?>&&category=<?php echo $rown['catname']; ?>">
                                        <button class="btn btn-outline-success px-4 rounded-0"
                                            style="border-top-left-radius:50px !important; border-bottom-left-radius:50px !important;"><i
                                                class="fa fa-eye"></i> قراءة
                                        </button>
                                    </a>

                                </li>

                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <div class="col-md-12 wow fadeInLeft">
                                    <div class="d-flex justify-content-between align-items-center pb-2 ">
                                        <span class="text-darkb fs-5">لمحة عن الكتاب</span>

                                    </div>
                                    <div class="description lh-base fs-5">
                                        <?php echo $rown['bdesc']; ?>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>


                    <hr class="my-5">

                    <div class="row pb-4">
                        <div class="col-md-12">
                            <h4 class=" float-start pb-2 border-3 border-primary border-bottom wow fadeInDown">كتب ذات
                                صلة</h4>
                        </div>
                    </div>
                    <div class="row all-books gap-3">
                        <?php
                        if (isset($_GET['category'])) {
                            $bookCat = $_GET['category'];
                        }

                        $sql = "SELECT * FROM book where catname= '$bookCat' AND bid != '$id'";
                        $result = $link->query($sql);
                        while ($rown = mysqli_fetch_assoc($result)) { ?>


                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="card p-0 wow fadeInUp">
                                    <div class="card-image overflow-hidden">
                                        <img src="assets/bookImages/<?php echo $rown['bimg']; ?>" class="card-img-top"
                                            alt="..." height="250" width="151">
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <a style="text-decoration: none; font-size: 18px; font-weight:600;"
                                                class="text-darkb px-2 py-1 rounded-3"
                                                href="book-details.php?id=<?php echo $rown['bid']; ?>&&category=<?php echo $rown['catname']; ?>">
                                                <?php echo $rown['bname']; ?></a>
                                        </h6>
                                        <div class="line">
                                            <hr>
                                        </div>
                                        <div>
                                            <p>لمحة عن الكتاب : </p>
                                            <?php echo mb_substr($rown['bdesc'], 0, 150, "UTF-8"); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        <?php }
                        ?>

                    </div>



                </div>
            </div>
        </div>
    </section>


    <?php include "footer.php"; ?>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#countBtn').click(function () {
                var recordId = $(this).data('id');
                console.log(recordId),
                    $.ajax({
                        url: 'download_book.php',
                        data: { id: recordId },
                        type: 'POST',
                        success: function (response) {
                            var counterValue = response.counter;
                            console.log('قيمة العداد: ' + counterValue);
                            $('#countbook').append(counterValue);

                        }
                    });
            });

        });
    </script>
</body>

</html>