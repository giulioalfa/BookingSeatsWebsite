<?php 
include 'general.php';
redirectHTTPS($_SERVER['HTTPS'], $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI']);
$message = "<p>La pw dovrebbe contenere un carattere minuscolo e uno maiuscolo o un numero</p><br>";
if(isset($_POST['user']) && isset($_POST['pw'])){
    if(empty($_POST['user']) || empty($_POST['pw']))
        $message = "<p class='alertt'>Servono tutti i campi!</p><br>";
    else{
        $us = strip_tags($_POST['user']);
        $pw = $_POST['pw'];
        $us = htmlentities($us);
        $us = stripslashes($us);
        $pass = md5($pw);
        $valid = checkUser($us, $pass);
        if($valid>0){
            $user = array(
                'id' => $valid,
                'email' => $us,
                'password' => $pass
            );
            session_start();
            $_SESSION['loggedUser'] = $user;
            $_SESSION['time'] = time();
            header("Location:booking.php");
        }
        else
            $message ="<p class='alertt'>Email o password errate!</p><br>";
    }
}
if(userLogged())
  header('Location:booking.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Booking site</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="functions.js">
</script>
<noscript>
    Javascript non abilitato, impossibile procedere
   <style>div { display:none; }</style>
</noscript>
</head>
<body>
  <div class="header"><h1>Plane</h1></div>
<div class="subt">
<h3>Book your seats</h3>
</div>
<div class="maindiv">
  <div id="loginHere">
    <form method="POST">
        <?php echo $message; ?>
        <label>User email: </label>
        <input type="text" name="user" value="Inserire un'email valida"><br><br>
        <label>Password: </label>
        <input type="password" name="pw"><br><br>
        <input type="submit" name="submit" value="Login">
    </form>
  </div>
  <div class="sidenav">
    <a href="index.php">Home</a>
    <a href="login.php">Login</a>
    <a href="registration.php">Registration</a>
  </div>
</div>
</body>
</html>