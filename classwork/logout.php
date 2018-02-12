<?php

 session_start();

 if (!isset($_SESSION['user'])) {
  header("Location: index.php");
 } else if(isset($_SESSION['user'])!="") {
  header("Location: home.php");
 }

 if (isset($_GET['logout'])) {
  unset($_SESSION['user']);
  session_unset();
  session_destroy();
  header("Location: index.php");
  exit;
 }
?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style.css">
	
	<title>Welcome - <?php echo $userRow['userEmail']; ?></title>
</head>

<body>
           
 
            <a href="logout.php?logout">Sign Out</a>

</body>
</html>