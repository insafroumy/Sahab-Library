<?php
include('header.php'); 


$sql = "SELECT * FROM setting where id=6";
$result = $link->query($sql);
$row = $result->fetch_assoc();

?>
<!-- start header -->
<header class="header-nav">
    <nav class="navbar navbar-expand-lg navbar-light text-dark p-0">
        <div class="container d-flex justify-content-between">
            <span class="d-flex flex-fill align-items-center">
                <a href="#" class="text-dark text-decoration-none">
                    <img src="assets/dist/images/<?php echo $row['logo']?>" alt="" width="100" />
                </a>
            </span>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link " aria-current="page" href="index.php">الرئيسية</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all_books.php">الكتب</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="categories.php">التصنيفات</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">اتصل بنا</a>
                    </li>
                </ul>
                
                <?php
                if (isset($_SESSION["user"]) ) { ?>
                    <ul class='navbar-nav d-flex mb-3'>
                        <li class='nav-item dropdown border rounded-3 '>
                            <button class='btn text-secondary dropdown-toggle d-flex justify-content-between align-items-center p-2' data-bs-toggle='dropdown'>
                                <i class='fa fa-user text-secondary' aria-hidden='true'></i>
                            </button>
                            <ul class='dropdown-menu dropdown-menu-start p-2 text-center'>
                            <p class="text-secondary">اسم المستخدم : <span class="text-danger"><?php echo $_SESSION['user_name']; ?></span></p>
                            <p class="text-secondary">البريد الالكتروني : <span class="text-danger"><?php echo $_SESSION['user_email']; ?></span></p>
                            <a href='password_change.php?id=<?php echo $_SESSION['id']; ?>' class='btn btn-outline-secondary link-secondary book-btn mb-2'>تغيير كلمة المرور<i class='fa fa-key' aria-hidden='true'></i></a>
                            <a href='logout_user.php' class='btn btn-outline-secondary link-secondary book-btn'> تسجيل خروج <i class='fa fa-sign-out' aria-hidden='true'></i></a>
                            </ul>
                        </li>
                </ul>
                <?php }elseif (isset($_SESSION["admin_id"]) ) { ?>
                    <ul class='navbar-nav d-flex mb-3'>
                    <li class='nav-item'>
                        <a href='index_admin.php' class='btn btn-outline-secondary  link-secondary book-btn'> لوحة التحكم <i class='fa fa-user '></i></a>
                    </li>
                    <li class='nav-item'>
                        <a href='logout_admin.php' class='btn btn-outline-secondary link-secondary book-btn'> تسجيل خروج <i class='fa fa-sign-out' aria-hidden='true'></i></a>
                    </li>
                    
                </ul>
                <?php } ?>

            </div>
        </div>
    </nav>
</header>
<!-- end header -->