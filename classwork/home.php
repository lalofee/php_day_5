<?php

//Display all the records from MySQL table using PHP and MySQL.



 ob_start();

 session_start();

 require_once 'dbconnect.php';

 // if session is not set this will redirect to login page

 if( !isset($_SESSION['user']) ) {

  header("Location: index.php");

  exit;

 }

 // select logged-in users detail

 $res=mysqli_query($conn, "SELECT * FROM users WHERE userId=".$_SESSION['user']);

 $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome - <?php echo $userRow['userEmail']; ?></title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<!-- A grey horizontal navbar that becomes vertical on small screens -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <form class="form-inline" action="/action_page.php">
    <input class="form-control mr-sm-2" type="text" placeholder="Search">
    <button class="btn btn-success" type="submit">Search</button>
  </form>
</nav>

 Hi' <?php echo $userRow['userEmail']; ?>

 <a href="logout.php?logout">Sign Out</a>


 <!---//////////////////Start of Table///////////////////-->
<?php

$sql = "SELECT dresses.dress_name, dresses.dress_color, dresses.dress_price
		FROM dresses";

$result = mysqli_query($conn, $sql);


echo

"<div class='container'>
   <table class='table table-dark table-hover'>
    <thead>
      <tr>
        <th>Name</th>
        <th>Color</th>
        <th>Price</th>
      </tr>
    </thead>";

// fetch a next row (as long as there are some) into $row
while($row = mysqli_fetch_assoc($result)) {

	echo

    "<tbody>
      <tr>
        <td>" . $row["dress_name"] . "</td>
        <td>" . $row["dress_color"] . "</td>
        <td>" . $row["dress_price"] . "</td>
      </tr>";
}

echo "</tbody></table></div>";

// Free result set
mysqli_free_result($result);
// Close connection
mysqli_close($conn);

?>

   

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>

<?php ob_end_flush(); ?>