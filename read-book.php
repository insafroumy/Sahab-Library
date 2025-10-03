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

    <!-- start path div -->
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
    <!-- end path div -->

    <!-- start read-book sec -->
    <section class="pt-5 pb-5" id="read-book">
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

                    <div class="row g-3">

                        <!-- start book card -->
                        
                        <!-- end book card -->
                        <div class="col">
                            <div class="ratio ratio-16x9 wow fadeInUp">
                                <iframe src="assets/bookFiles/<?php echo $rown['bpdf']; ?>" 
                                    allowfullscreen></iframe>
                            </div>
                            <div class="pt-2">


                                <a class="text-decoration-none d-block rb-link wow fadeInRight" href="assets/bookFiles/<?php echo $rown['bpdf']; ?>" download>
                                    <button class="countBtn btn btn-outline-primary d-block" id="countBtn"
                                            data-id="<?php echo $rown['bid']; ?>"> 
                                        <i class="fa fa-download"></i> تحميل
                                    </button>
                                </a>

                            </div>
                            <hr class="my-5">

                            <div class="row pb-4">
                                <div class="col-md-12">
                                    <h4 class=" float-start pb-2 border-3 border-primary border-bottom wow fadeInDown">كتب ذات صلة</h4>
                                </div>
                            </div>
                            <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-4 g-4 all-books">
                        <?php
                        if (isset($_GET['category'])) {
                            $bookCat = $_GET['category'];
                        }

                        $sql = "SELECT * FROM book where catname= '$bookCat' AND bid != '$id'";
                        $result = $link->query($sql);
                        while ($rown = mysqli_fetch_assoc($result)) { ?>


                            <div class="col">
                                <div class="card wow fadeInUp">
                                    <div class="card-image overflow-hidden">
                                        <img src="assets/bookImages/<?php echo $rown['bimg']; ?>" class="card-img-top" alt="..."
                                            height="250" width="151">
                                    </div>
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            <a style="text-decoration: none; font-size: 18px; font-weight:600; " class="text-darkb px-2 py-1 rounded-3"
                                                href="book-details.php?id=<?php echo $rown['bid']; ?>&&category=<?php echo $rown['catname']; ?>">
                                                <?php echo $rown['bname']; ?></a>
                                        </h6>
                                        <div class="line">
                                            <hr>
                                        </div>
                                        <div>
                                            <p>لمحة عن الكتاب : </p>
                                            <?php echo mb_substr($rown['bdesc'],0,150,"UTF-8"); ?>
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
            </div>
        </div>
    </section>
    
    <!-- end read-book sec -->

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