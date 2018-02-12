<!DOCTYPE html>
<html>
<head>
	<title>php verbinde mit datenbank</title>
</head>
<body>


<?php

        header("Content-Type: application/json; charset=UTF-8");

        $obj = json_decode($_GET["x"], false); // Convert the request into an object


        $conn = new mysqli("localhost", "root", "", "google"); // Access the database uising mysqli

        $result = $conn->query("SELECT name FROM " . $obj->table . " WHERE position = " . $obj->position);

        $outp = array(); // create an empty array

        $outp = $result->fetch_all(MYSQLI_ASSOC); // fill an array with the requested data and store it in the array


        echo json_encode($outp); // return the object as JSON

?>

</body>
</html>