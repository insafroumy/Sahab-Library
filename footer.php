<?php
include('header.php');

$sql = "SELECT * FROM setting where id=6";
$result = $link->query($sql);
$row = $result->fetch_assoc();

?>
<!-- start footer -->
<footer class="footer mt-auto py-3 bg-dark text-white">
    <div class="container">
        <div class="row d-flex justify-content-between g-4">
            <div class="col-md-3">
                <a href=""
                    class="d-flex flex-fill align-items-center mb-lg-0 me-lg-auto text-white text-decoration-none">
                    <span class="fs-4">
                        <img src="assets/dist/images/logo1.png" alt="" width="80" style="border-radius: 50%;">
                    </span>
                </a>
                <hr />
                <p>
                    <?php echo $row['lname'] ?>
                </p>
                <p>بمجرّد أن تتعلّم القراءة سوف تصبح حُرًّا للأبد</p>
            </div>

            <div class="col-md-3">
                <ul class="list-unstyled">
                    <li class="mt-4 mb-4 f-hover">
                        <a href="contact.php" class="text-decoration-none text-white">
                            <i class="fa fa-link"></i> اتصل بنا</a>
                    </li>
                    <hr />
                    <li class="mt-4 mb-4 f-hover">
                        <a href="" class="text-decoration-none text-white"><i class="fa fa-envelope"></i>
                            <?php echo $row['lemail'] ?>
                        </a>
                    </li>
                    <hr />
                    <li class="d-flex justify-content-between mt-4 mb-4 socials">
                        <span><a href="<?php echo $row['lface'] ?>" class="text-decoration-none text-white">
                                <i class="fa fa-facebook-f"></i></a></span>
                        <span><a href="<?php echo $row['linsta'] ?>" class="text-decoration-none text-white">
                                <i class="fa fa-instagram"></i></a></span>
                        <span><a href="<?php echo $row['lyoutube'] ?>" class="text-decoration-none text-white">
                                <i class="fa fa-youtube-play"></i></a></span>
                        <span><a href="<?php echo $row['ltwitter'] ?>" class="text-decoration-none text-white">
                                <i class="fa fa-twitter"></i></a></span>
                    </li>
                </ul>
            </div>
            <div class="col-md-3">
                <h4 class="mt-4 mb-4">روابط سريعة</h4>
                <hr />
                <ul class="list-unstyled">
                    <li class="mb-4 mt-4 f-hover">
                        <a href="policy.php" class="text-decoration-none text-white">
                            <i class="fa fa-link"></i> سياسة الخصوصية</a>
                    </li>
                    <hr />
                    <li class="mb-4 mt-4 f-hover">
                        <a href="copyrights.php" class="text-decoration-none text-white">
                            <i class="fa fa-link"></i> حقوق النشر</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

<footer class="footer mt-auto py-3" style="background: #000">
    <div class="container">
        <div class="d-flex justify-content-center">
            <span class="text-muted">جميع الحقوق محفوظة @
                <?php echo date('Y'); ?>
            </span>
        </div>
    </div>
</footer>
<!-- end footer -->


<script src="assets/dist/js/jquery-3.6.0.min.js"></script>
<script src="assets/dist/js/bootstrap.bundle.min.js"></script>
<!-- scrollreveal js -->
<script src="https://unpkg.com/scrollreveal"></script>
<script src="assets/dist/js/wow.min.js"></script>
<script>
    new WOW().init();
</script>
<script src="assets/dist/js/jquery.barrating.min.js"></script>
<script type="text/javascript">
    $(function () {
        $(".example").barrating({
            theme: "fontawesome-stars",
        });
    });
</script>

<script src="assets/dist/js/main.js"></script>