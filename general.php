<?php
$N = 10;
$M = 6;
$total = $N * $M;
$alphabet = range('A', 'Z');

function DBconnect(){
    $conn=mysqli_connect("localhost", "s267589", "ncepacer", "s267589");
    if(mysqli_connect_errno()){
        echo "Connessione fallita: ".mysqli_connect_error();
        die();
    }
    return $conn;
}

function checkUser($u, $pa){
    $conn = DBconnect();
    $found = 0;
    $query = "SELECT userid, email FROM users WHERE email = '".$u."' AND pass = '".$pa."'";
    if($ris = mysqli_query($conn, $query)){
        if(mysqli_num_rows($ris) >= 1 ){
            $row = mysqli_fetch_array($ris, MYSQLI_NUM);
            $found = $row[0];
        }
        mysqli_free_result($ris);
    }
    mysqli_close($conn);
    return $found;
}

function validation($u, $pa){
    $conn = DBconnect();
    $found = 0;
    $query = "SELECT email FROM users WHERE email = '".$u."'";
    if(!($ris = mysqli_query($conn, $query))){
        echo "ERROR: ".mysqli_error($conn);
        die();
    }
    else{
        if(mysqli_num_rows($ris) >= 1 ){
            $found = 1;
        }
        mysqli_free_result($ris);
    }
    if (!filter_var($u, FILTER_VALIDATE_EMAIL)) 
        $found = 1;
    if(ctype_alpha($pa)){
        $lowpa = strtolower($pa);
        if($lowpa==$pa)
            $found = 1;
    }
    mysqli_close($conn);
    return $found;
}

function insert($idC, $u, $pa){
    $conn = DBconnect();
    $query = "INSERT INTO users(userid, email, pass) VALUES ('".$idC."', '".$u."', '".$pa."')";
    if(!mysqli_query($conn, $query)){
        echo "ERROR: ".mysqli_error($conn);
        die();
    }
    mysqli_close($conn);
}

function searchID(){
    $conn = DBconnect();
    $query = "SELECT MAX(userid) FROM users";
    if(!($ris = mysqli_query($conn, $query))){
        echo "ERROR: ".mysqli_error($conn);
        die();
    }
    else{
        if(mysqli_num_rows($ris) >= 1 ){
            $row = mysqli_fetch_array($ris, MYSQLI_NUM);
            $val = $row[0];
            $val = $val + 1;
        }
        else $val = 1;
    }
    mysqli_close($conn);
    return $val;
}

function userLogged(){
    if(isset($_SESSION['loggedUser']))
        return $_SESSION['loggedUser'];
    else return false;
}

function checkSeat($idSeat){
    $conn = DBconnect();
    $ret = 0;
    $query = "SELECT seatid, userid, bought FROM seats WHERE seatid = '".$idSeat."'";
    if(!($ris = mysqli_query($conn, $query))){
        echo "ERROR: ".mysqli_error($conn);
        die();
    }
    else{
        if(mysqli_num_rows($ris)==0)
            $ret=0;
        else{
            $row = mysqli_fetch_array($ris, MYSQLI_NUM);
            if($row[2]==0)
                $ret = $row[1];
            else
                $ret = -1;
        }
    }
    mysqli_close($conn);
    return $ret;
}

function boughtSeat(){
    $conn = DBconnect();
    $query = "SELECT COUNT(*) FROM seats WHERE bought=1";
    if(!($ris = mysqli_query($conn, $query))){
        echo "ERROR: ".mysqli_error($conn);
        die();
    }
    $row = mysqli_fetch_array($ris, MYSQLI_NUM);
    mysqli_close($conn);
    return $row[0];
}

function bookedSeat(){
    $conn = DBconnect();
    $query = "SELECT COUNT(*) FROM seats WHERE bought=0";
    if(!($ris = mysqli_query($conn, $query))){
        echo "ERROR: ".mysqli_error($conn);
        die();
    }
    $row = mysqli_fetch_array($ris, MYSQLI_NUM);
    mysqli_close($conn);
    return $row[0];
}

function takeSeats($iduser){
    $ret = "";
    $conn = DBconnect();
    $query = "SELECT COUNT(*) FROM seats WHERE userid = '".$iduser."' AND bought=0";
    if(!($ris = mysqli_query($conn, $query))){
        echo "ERROR: ".mysqli_error($conn);
        die();
    }
    $row = mysqli_fetch_array($ris, MYSQLI_NUM);
    $n = $row[0];
    $query = "SELECT seatid FROM seats WHERE userid = '".$iduser."' AND bought=0";
    if(!($ris = mysqli_query($conn, $query))){
        echo "ERROR: ".mysqli_error($conn);
        die();
    }
    $i = 0;
    while($row = mysqli_fetch_array($ris, MYSQLI_NUM)){
        if($i==$n-1)
            $ret .= $row[0];
        else
            $ret .= $row[0]." ";
        $i++;
    }
    mysqli_close($conn);
    return $ret;
}

function redirectHTTPS($shttps, $shost, $sreq){
    if(!empty($shttps) && $shttps!=='off'){}
    else{
        $redirect='https://'.$shost.$sreq;
        header('HTTP/1.1 301 Moved Permanently');
        header('Location:'.$redirect);
        exit();
    }
}
?>