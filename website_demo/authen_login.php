<?php  
	require('db_connect.php');
	if (isset($_POST['user_id']) and isset($_POST['user_pass'])) {
		/* Assigning POST values to variables
		 */
		$username = $_POST['user_id'];
		$username = mysqli_real_escape_string($username);
		$password = $_POST['user_pass'];
		$password = mysqli_real_escape_string($password);
		// $username = $_POST['user_id'];
		// $password = $_POST['user_pass'];

		/* Check for the record from table
		 */
		$query = "SELECT * FROM `user_login` WHERE username='$username' and Password='$password'";
 
		$result = mysqli_query($connection, $query) or die(mysqli_error($connection));
		$count = mysqli_num_rows($result);

		if ($count == 1) {
			echo "<script type='text/javascript'>alert('Login Credentials verified')</script>";
			//echo "Login Credentials Verified";
		}
		else {
			echo "<script type='text/javascript'>alert('Invalid Login Credentials')</script>";
			//echo "Invalid Login Credentials";
		}
	}
?>
