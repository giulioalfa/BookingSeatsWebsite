<?php
session_start();
include 'session.php';
if(isset($_POST['s']) && isset($_POST['u']) && isset($_POST['b'])){
    $s = $_POST['s'];
    $u = $_POST['u'];
    $b = $_POST['b'];
    $value = 0;
    $conn=mysqli_connect("localhost", "s267589", "ncepacer", "s267589");
    if(mysqli_connect_errno()){
        echo "Connessione fallita: ".mysqli_connect_error();
        die();
    }
    if($b==0){ //user vuole prenotare
        $query = "SELECT userid, bought FROM seats WHERE seatid = '".$s."'";
        $value = 1;
        if($ris = mysqli_query($conn, $query)){
            if(mysqli_num_rows($ris) >= 1 ){
                $row = mysqli_fetch_array($ris, MYSQLI_NUM);
                if($row[1]==1)
                    $value = 0;
                else{
                    $queryd = "DELETE FROM seats WHERE seatid = '".$s."'";
                    if(!mysqli_query($conn, $queryd)){
                        echo "Errore: ".mysqli_error($conn);
                        die();
                    }
                    else
                        $value = 1;
                }
            }
            if($value!=0 && $value!=-1){
                $queryd = "INSERT INTO seats(seatid, userid, bought) VALUES('".$s."', '".$u."', 0)";
                if(!mysqli_query($conn, $queryd)){
                    echo "Errore: ".mysqli_error($conn);
                    die();
                }
            }
        }
        else{
            echo "Errore: ".mysqli_error($conn);
            die();
        }
    }
    else if($b==1){ //user vuole comprare
        $sts = explode(" ", $s);
        $value = 1;
        for($i=0; $i<count($sts); $i++){
            $query = "SELECT userid, bought FROM seats WHERE seatid = '".$sts[$i]."'";
            if($ris = mysqli_query($conn, $query)){
                if(mysqli_num_rows($ris) >= 1 ){
                    $row = mysqli_fetch_array($ris, MYSQLI_NUM);
                    if($row[0]!=$u || $row[1]==1){
                        $value = 0;
                        break;
                    }
                }
            }
            else{
                echo "Errore: ".mysqli_error($conn);
                die();
            }
        }
        if($value){
            for($i=0; $i<count($sts); $i++){
                $query = "SELECT userid FROM seats WHERE seatid = '".$sts[$i]."'";
                if($ris = mysqli_query($conn, $query)){
                    $row = mysqli_fetch_array($ris, MYSQLI_NUM);
                    if($row[0]==$u){
                        $queryd = "UPDATE seats SET bought = 1 WHERE seatid = '".$sts[$i]."'";
                        if(!mysqli_query($conn, $queryd)){
                            echo "Errore: ".mysqli_error($conn);
                            die();
                        }
                    }
                    else{
                        $queryd = "DELETE FROM seats WHERE seatid = '".$sts[$i]."'";
                        if(!mysqli_query($conn, $queryd)){
                            echo "Errore: ".mysqli_error($conn);
                            die();
                        }
                        $queryd = "INSERT INTO seats(seatid, userid, bought) VALUES('".$sts[$i]."', '".$u."', 1)";
                        if(!mysqli_query($conn, $queryd)){
                            echo "Errore: ".mysqli_error($conn);
                            die();
                        }
                    }
                }
                else{
                    echo "Errore: ".mysqli_error($conn);
                    die();
                }
            }
        }
        else{
            for($i=0; $i<count($sts); $i++){
                $queryd = "DELETE FROM seats WHERE seatid = '".$sts[$i]."' AND userid = '".$u."'";
                if(!mysqli_query($conn, $queryd)){
                    echo "Errore: ".mysqli_error($conn);
                    die();
                }
            }
        }
    }
    else{ //user vuole cancellare prenotazione
        $query = "SELECT COUNT(*) FROM seats WHERE seatid = '".$s."' AND userid = '".$u."' AND bought = 0";
        if(!($ris = mysqli_query($conn, $query))){
            echo "Errore: ".mysqli_error($conn);
            die();
        }
        else{
            $row = mysqli_fetch_array($ris, MYSQLI_NUM);
            if($row[0]==0)
                $value = 1;
            else{
                $query= "DELETE FROM seats WHERE seatid = '".$s."' AND userid = '".$u."'";
                if(mysqli_query($conn, $query))
                    $value = 1;
                else{
                    echo "Errore: ".mysqli_error($conn);
                    die();
                }
            }
        }
    }
}
else{
    $s = null;
    $u = null;
    $value = 0;
}
echo $value;
?>