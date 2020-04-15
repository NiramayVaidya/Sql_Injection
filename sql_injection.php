<?php
/* the php tag below is used to switch out template mode into script mode
 * if this is not mentioned, php -f <filename> works like cat
 */
/* for php --version output 7 and above mysql_* API removed completely
 * replaced by mysqli_*? be careful, both APIs are distinct
 * using object-oriented mysqli, procedural mysqli is commented out
 * object oriented way uses the object created by new mysqli and then calls
 * functions on it
 * procedural way does not use an object and calls functions with the mysqli_
 * prefix instead
 */

/* for query_evil, the second query in it is delete and hence next_result()
 * returns a boolean (true if succeeded, false otherwise) instead of a resource
 * as returned in the first select query (in this case, passing result to
 * mysqli_num_rows() results in 0 rows) and hence a PHP warning is raised since
 * the mysqli_num_rows() expects a result resource and is provided with a
 * boolean instead
 */
function print_query_result($conn, $query) {
	if ($conn->multi_query($query)) {
		if ($result = $conn->store_result()) {
			do {
				// TODO use the object-oriented way for checking number of rows
				if (mysqli_num_rows($result)) {
					echo "id\tname\n";
					while ($row = $result->fetch_assoc()) { // fetch_row() ?
						$id = $row["id"];
						$name = $row["name"];
						echo $id . "\t" . $name . "\n";
					}
					$result->free();
				}
				else {
					echo "Empty set\n";
				}	
			} while ($result = $conn->next_result());
		}
	}
	else {
		echo "Query failed\n" . $conn->error() . "\n";
	}
}

$servername = "localhost";
$username = "niramay";
$password = "Unique123!";
$database = "sql_injection_testing";

// TODO use mysqli variable name instead
$conn = new mysqli($servername, $username, $password, $database);
// $conn = mysqli_connect($servername, $username, $password, $database);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
// if (!$conn) {
//	die("Connection failed" . mysqli_error()); // mysqli_connect_error
// }
else {
	echo "Connection successful\n";
}
/* second parameter for connection is not mandatory, if omitted latest created
 * connection will be used, though php throws a warning in this case
 */
// mysqli_select_db($conn, "sql_injection_testing");
/* Niramay and niramay is the same as sql data stored in mysql tables in case
 * in sensitive
 */
$name = "Niramay";
$query = "select * from basic_testing where name = '$name';";
echo "Normal: " . $query . "\n";
print_query_result($conn, $query);

/* real_escape_string() has been used to escape sql injections in both cases
 */

$name_bad = "' or '1";
// $name_bad = $conn->real_escape_string($name_bad);
$query_bad = "select * from basic_testing where name = '$name_bad';";
echo "Injection: " . $query_bad . "\n";
// echo "Escaped bad injection: " . $query_bad . "\n";
print_query_result($conn, $query_bad);

$name_evil = "';delete from basic_testing where 1 or name = '";
// $name_evil = $conn->real_escape_string($name_evil);
$query_evil = "select * from basic_testing where name = '$name_evil';";
echo "Injection: " . $query_evil . "\n";
// echo "Escaped evil injection: " . $query_evil . "\n";
print_query_result($conn, $query_evil);

$conn->close();
// mysqli_close($conn);
?>
