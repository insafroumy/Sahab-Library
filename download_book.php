<?php
// Connect to database and include necessary files
require_once 'db.php';
if (!isset($_SESSION['admin_id'])) {
	header('Location:admin_login.php');
}

// الحصول على معرّف السجل من الطلب
$recordId = $_POST['id'];

// استعلام لتحديث العداد في الجدول
$sql = "UPDATE book SET download = download + 1 WHERE bid = $recordId";

// تنفيذ الاستعلام
if ($link->query($sql) === TRUE) {
	// استعلام لاسترداد القيمة المحدثة للعداد
	$sql = "SELECT download FROM book WHERE bid = $recordId";
	$result = $link->query($sql);

	if ($result->num_rows > 0) {
		$row = $result->fetch_assoc();
		$counter = $row["download"];
		echo $counter;
	} else {
		echo "0";
	}
} else {
	echo "حدث خطأ أثناء تحديث العداد: ";
}

// mysqli_query($link, "UPDATE book set bname=? , aname=? ,bdesc=? , bdate=? , catname=? , download = ? , bimg=? , bpdf=?  WHERE bid=?");

// Return a success response to the AJAX request
$response = array(
	'counter' => $counter,
	'result' => 'تم تحديث العداد بنجاح'
);
//array('status' => 'success', 'message' => 'Data processed successfully.');

echo json_encode($response);
?>