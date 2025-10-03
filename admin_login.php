<?php

include "db.php";
// include 'function.php';

if(isset($_SESSION['admin_id'])){
	header('Location:index_admin.php');
}

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['admin_email']) && isset($_POST['admin_password'])) {
	function validate($data)
	{
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	}

	$admin_email = validate($_POST['admin_email']);

	$admin_password = validate($_POST['admin_password']);

	if (empty($admin_email) && empty($admin_password)) {

		$message = "User Email or pass is required ";

	} else {

		$sql = "SELECT * FROM admin_login WHERE admin_email='$admin_email' AND admin_password='$admin_password'";

		$result = mysqli_query($link, $sql);

		if (mysqli_num_rows($result) === 1) {

			$row = mysqli_fetch_assoc($result);

			if ($row['admin_email'] === $admin_email && $row['admin_password'] === $admin_password) {

				// echo "Logged in!";

				$_SESSION['admin_email'] = $row['admin_email'];

				$_SESSION['admin_id'] = $row['admin_id'];

				header("Location: index_home.php");

				exit();

			} else {
				$message = "Email or Password not match the database";

			}

		} else {
			$message = "Admin Email or password is wrong";

		}

	}

}
}
?>

<div class="d-flex align-items-center justify-content-center" style="min-height:700px;">

	<div class="col-md-6">

		<?php
		if ($message != '') {
			echo '<div class="alert alert-danger"><ul>' . $message . '</ul></div>';
		}
		?>

		<div class="card">

			<div class="card-header">Admin Login</div>

			<div class="card-body">

				<form method="POST">

					<div class="mb-3">
						<label class="form-label">Email address</label>

						<input type="text" name="admin_email" id="admin_email" class="form-control" />

					</div>

					<div class="mb-3">
						<label class="form-label">Password</label>

						<input type="password" name="admin_password" id="admin_password" class="form-control" />

					</div>

					<div class="d-flex align-items-center justify-content-between mt-4 mb-0">

						<input type="submit" name="login_button" class="btn btn-primary" value="Login" />

					</div>

				</form>

			</div>

		</div>

	</div>

</div>

<?php

include 'footer.php';

?>