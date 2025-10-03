<?php
include 'db.php';
include('header.php');

?>

<body>
	<?php include 'navbar.php'; ?>
	<div class="container">
	
	</div>
	
	<div  class="bg-light secondary py-5">
		<div class="container">
		<?php 
	$errors = array(
		'name' => NULL,
		'email' => NULL,
		'title' => NULL,
		'message' => NULL,
	);
	if (isset($_POST['submit'])) {
		$name = $_POST['name'];
		$email = $_POST['email'];
		$title = $_POST['title'];
		$message = $_POST['message'];
		$submit = $_POST['submit'];
	
		$flag = true;
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			if (empty($name)) {
				$errors['name'] = "*ادخل اسم المستخدم";
				$flag = false;
			} else {
				if (strlen($name) < 2 && strlen($name) > 20) {
					$errors['name'] = "*ادخل اسم لا يقل عن 3 احرف ولا يزيد عن 20 حرف";
					$flag = false;
				}
			}
			if (empty($email)) {
				$errors['email'] = "*ادخل البريد الالكتروني <br>";
				$flag = false;
			} else {
				if (filter_var($email, FILTER_VALIDATE_EMAIL) == FALSE) {
					$errors['email'] = "*test@exampleأدخل بريد الكتروني صحيح مثل";
					$flag = false;
				}
			}
			if (empty($title)) {
				$errors['title'] = "*الرجاء ادخال عنوان رسالتك <br>";
				$flag = false;
			} else {
				if (strlen($title) > 30 && strlen($title) < 3) {
					$errors['title'] = "*يجب ان لا يزيد غن 30 حرف";
					$flag = false;
				}
			}
			if (empty($message)) {
				$errors['message'] = "*الرجاء ادخال رسالتك  <br>";
				$flag = false;
			} else {
				if (strlen($message) > 200) {
					$errors['message'] = "*يجب ان لا تزيد الرسال عن 200 حرف '<br>";
					$flag = false;
				}
			}
			if ($flag) {
				$sql = "INSERT INTO contact(name, email, title, message) 
				VALUES ('$name', '$email', '$title', '$message')";
				mysqli_query($link, $sql);
	
				if (array_filter($errors) == []) {
					echo '
						<div class="alert alert-success alert-dismissible fade show " role="alert">
							تم إرسال رسالتك بنجاح!
							<button type="button" class="btn-close " data-bs-dismiss="alert" aria-label="Close"></button>
						</div>
						';
						
				}
			}
		}
	}
	?>
			<section id="contact" class="rounded-1 shadow bg-light p-3 border">
				<h1 class="mb-3 text-darkb border-3 border-primary border-bottom pb-2 wow fadeInDown" style="width:fit-content">تواصل معنا</h1>
				<form class="" method="POST">
					<div class="mb-2  wow fadeInRight" data-wow-delay="0s">
						<label for="name" class="form-label">الاسم</label>
						<input type="text" class="form-control" id="name" name="name" />
						<span class="error text-danger">
							<?php echo $errors['name'] ?>
						</span>
					</div>
					<div class="mb-2  wow fadeInRight" data-wow-delay=".1s">
						<label for="exampleInputEmail1" class="form-label">البريد الالكتروني</label>
						<input type="email" class="form-control" id="exampleInputEmail1" name="email"
							aria-describedby="emailHelp" />
						<span class="error text-danger">
							<?php echo $errors['email'] ?>
						</span>
					</div>
					<div class="mb-2  wow fadeInRight" data-wow-delay=".2s">
						<label for="title" class="form-label">عنوان الرسالة</label>
						<input type="text" class="form-control" id="title" name="title" />
						<span class="error text-danger">
							<?php echo $errors['title'] ?>
						</span>
					</div>
					<div class="mb-2  wow fadeInRight" data-wow-delay=".3s">
						<label for="message" class="form-label">محتوى الرسالة</label>
						<textarea class="form-control" id="message" name="message"></textarea>
						<span class="error text-danger">
							<?php echo $errors['message'] ?>
						</span>
					</div>
					<div class="modal-footer">
						<a href="index.php" class="btn btn-secondary  wow fadeInUp" data-wow-delay=".5s" data-bs-dismiss="modal">
							إغلاق </a>
						<button type="submit" class="btn btn-primary  wow fadeInUp" data-wow-delay=".4s" name=submit>إرسال</button>
					</div>
				</form>
			</section>
		</div>
	</div>
</body>

<?php include 'footer.php'; ?>