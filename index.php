<?php
include 'general.php';
if(userLogged())
    header('Location:booking.php');
redirectHTTPS($_SERVER['HTTPS'], $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI']);
setcookie('testcookie', "hello");
if(!isset($_COOKIE['testcookie']))
	header('Location:error.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Booking site</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="functions.js"></script>
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
    <div id="tableHere">
        <?php
        echo "<p> Total seats: ".$total."</p>";
        $bght = boughtSeat();
        echo "<p class='bg'> Bought seats: ".$bght."</p>";
        $bk = bookedSeat();
        echo "<p class='bk'> Booked seats: ".$bk."</p>";
        $fr = $total - $bk - $bght;
        echo "<p class='fr'> Free seats: ".$fr."</p>";
        ?>
        <table id="tb1">
        <?php
        for($i=1; $i<=$N; $i++){
            echo "<tr id = ".$i.">";
            for($j=1; $j<=$M; $j++){
                $ids = $alphabet[$j-1].$i;
                $bkd = checkseat($ids);
                if($bkd==0)
                    echo "<td id = '".$ids."' class='free' onmouseover='mouseover(this);' onmouseout='mouseout(this);'>".$ids."</td>";
                else if($bkd>0)
                    echo "<td id = '".$ids."' class='booked'>".$ids."</td>";
                else
                    echo "<td id = '".$ids."' class='bought'>".$ids."</td>";
            }
            echo "</tr>";
        }
        ?>
        </table>
    </div>
    <div class="sidenav">
        <a href="index.php">Home</a>
        <a href="login.php">Login</a>
        <a href="registration.php">Registration</a>
    </div>
</div>
</body>
</html>