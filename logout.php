<?php
function destroysess(){
    $_SESSION=array();
    if(ini_get("session.use_cookies")){
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time()-3600*24, $params['path'], $params['domanin'], $params['secure'], $params['httponly']);
    }
    if(session_destroy())
        return true;
    else return false;
}
session_start();
if(destroysess())
    header('Location:index.php');
?>