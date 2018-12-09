<?php

$db_host = "localhost";
$db_username = "root";
$db_pass = "root";
$db_name = "zaphahDB";

$conn = mysqli_connect("$db_host","$db_username","$db_pass") or die ("Could Not Connect to MySQL");
mysqli_select_db($conn,"$db_name") or die("No database with that name");

// Adding a table
// $sql = "create table my_guests (
// 	id int(158) unsigned auto_increment primary key,
// 	first_name varchar(30) not null,
// 	last_name varchar(30) not null,
// 	email varchar(50),
// 	reg_date timestamp
// 	)";

// Inserting into a table
// $sql = "INSERT INTO my_guests (first_name, last_name, email)
//	VALUES ('Bonnie', 'Cape', 'bonniecape@gmail.com')";

// Selecting
// $sql = "SELECT id, first_name, last_name FROM my_guests";
// $results = mysqli_query($conn,$sql);

// if (mysqli_num_rows($results)) {
// 	echo "<table><tr><th>ID<th>Name";
// 	while ($row = mysqli_fetch_assoc($results)) {
// 		echo "<tr><td>".$row["id"]."<td>".$row["first_name"]." ".$row["last_name"]."</tr>";
// 	}
// } else {
// 	echo "0 results";
// }

// Deleting
// $sql = "DELETE FROM my_guests WHERE id=3";

// if (mysqli_query($conn,$sql)) {
// 	echo "Delete was succesful";
// } else {
// 	echo "error" .mysqli_error($conn);
// }

?>