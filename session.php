<?php 
$t=time();
$diff=0;
$new=false;
if (isset($_SESSION['time'])){
    $t0=$_SESSION['time'];
    $diff=($t-$t0);
} else {
    $new=true;
}
if ($new || ($diff > 120)) {
    $_SESSION=array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 3600*24,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    header('HTTP/1.1 307 temporary redirect');
    header('Location: login.php?msg=SessionTimeOut');
    exit;
} else {
    $_SESSION['time']=time();
}
?> 