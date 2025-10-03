<?php
// Connect to database and include necessary files
require_once 'db.php';
if(!isset($_SESSION['admin_id'])){
	header('Location:admin_login.php');
}

// Get the data_id parameter from the AJAX request
$id = $_POST['id'];

mysqli_query($link, "DELETE FROM admin_login WHERE admin_id=$id");

// Return a success response to the AJAX request
$response = array('status' => 'success', 'message' => 'Data processed successfully.');
echo json_encode($response);
?>