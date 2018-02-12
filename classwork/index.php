
<?php

 ob_start();

 session_start();

 require_once 'dbconnect.php';

 
// it will never let you open index(login) page if session is set

 if ( isset($_SESSION['user'])!="" ) {

  header("Location: home.php");

  exit;

 }

 $error = false;

 if( isset($_POST['btn-login']) ) {

 
// prevent sql injections/ clear user invalid inputs

  $email = trim($_POST['email']);

  $email = strip_tags($email);

  $email = htmlspecialchars($email);

 

  $pass = trim($_POST['pass']);

  $pass = strip_tags($pass);

  $pass = htmlspecialchars($pass);

  // prevent sql injections / clear user invalid inputs

 

  if(empty($email)){

   $error = true;

   $emailError = "Please enter your email address.";

  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {

   $error = true;

   $emailError = "Please enter valid email address.";

  }

 

  if(empty($pass)){

   $error = true;

   $passError = "Please enter your password.";

  }

 

  // if there's no error, continue to login

  if (!$error) {

   

   $password = hash('sha256', $pass); // password hashing using SHA256

 

   $res=mysqli_query($conn, "SELECT userId, userName, userPass FROM users WHERE userEmail='$email'");

   $row=mysqli_fetch_array($res, MYSQLI_ASSOC);

   $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

   

   if( $count == 1 && $row['userPass']==$password ) {

    $_SESSION['user'] = $row['userId'];

    header("Location: home.php");

   } else {

    $errMSG = "Incorrect Credentials, Try again...";

   }

  }

 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>



<!--//////////////////////////////////////_________NAVBAR + LOGIN________//////////////////////////////////////////-->
<!-- A grey horizontal navbar that becomes vertical on small screens -->
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">

<form class="form-inline" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

 <!--//////////Fehlermeldung////////////////-->  
            <?php

   if ( isset($errMSG) ) {
echo $errMSG; ?>

                <?php
   }
   ?>

<div class="form-group">
<input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" placeholder="Enter email" />

<span class="text-danger"><?php echo $emailError; ?></span>

<input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" placeholder="Enter password"/>

<span class="text-danger"><?php echo $passError; ?></span>


<button type="submit" name="btn-login">Login</button>

<a href="register.php">Registration</a>

</div>

</form>
</nav>
<!--///////////////////////////////_____END OF____NAVBAR + LOGIN________//////////////////////////////////////////-->
   
			
            



</body>

</html>

<?php ob_end_flush(); ?>



<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>