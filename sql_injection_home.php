<!DOCTYPE html>
<html>
<head>
</head>
<body>
<?php
$servername = "localhost";
$username = "niramay";
$password = "Unique123!";
$database = "sql_injection_testing";

// $conn = new mysqli($servername, $username, $password, $database);
$conn = mysqli_connect($servername, $username, $password, $database);

// if ($conn->connect_error) {
if (!$conn) {
	echo "<h1>Database connectivity failed</h1>";
}
else {
	if (isset($_POST["submit"])) {
		if (filter_has_var(INPUT_POST, "submit")) {
			$email = $_POST["email"];
			$password = $_POST["password"];
			$query = "select * from users where email = '$email' and password = md5($password);";
			// if ($conn->query($query)) {
			if (mysqli_query($conn, $query)) {
				echo "<h1>Welcome!</h1>";
			}
			else {
				echo "<h1>Login error</h1>";
			}
		}
		else {
			echo "<h1>Input method not POST</h1>";
		}
	}
	else {
		echo "<h1>Form not submitted correctly</h1>";
	}
?>
</body>
</html>
