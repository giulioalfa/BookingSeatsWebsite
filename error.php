<?php
$v = 0;
setcookie('testcookie', "hello");
if (!isset($_COOKIE['testcookie']))
    $v=1; 
if(!$v)
    header('Location:index.php');
else
    echo "Cookies non abilitati, impossibile procedere";
?>