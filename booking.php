<?php
include 'general.php';
session_start();
if(!userLogged())
  header('Location:index.php');
redirectHTTPS($_SERVER['HTTPS'], $_SERVER['HTTP_HOST'], $_SERVER['REQUEST_URI']);
include 'session.php';
$userbook = $_SESSION['loggedUser']['id'];?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Booking site</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
<script type="text/javascript" src="functions.js">
</script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js">
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
  <div id="tableHere">
    <?php
    echo "<p> Total seats: ".$total."</p>";
    $bght = boughtSeat();
    echo "<p class='bg'> Bought seats: <span id='bbg'>".$bght."</span></p>";
    $bk = bookedSeat();
    echo "<p class='bk'> Booked seats: <span id='bbk'>".$bk."</span></p>";
    $fr = $total - $bk - $bght;
    echo "<p class='fr'> Free seats: <span id='frr'>".$fr."</span></p>";
    ?>
    <input id="inp" type="submit" name="Submit" value="Compra" onclick='buySeat(<?php echo $userbook;?>);'><br><br>
    <input id="inp" type="submit" name="Submit" value="Aggiorna" onclick='aggiorna();'>
    <table id="tb2">
    <?php
    for($i=1; $i<=$N; $i++){
        echo "<tr id = ".$i.">";
        for($j=1; $j<=$M; $j++){
            $ids = $alphabet[$j-1].$i;
            $bkd = checkseat($ids);
            if($bkd==0)
              echo "<td id = '".$ids."' class='free' onmouseover='mouseover(this);' onmouseout='mouseout(this);' onclick='bookSeat(this, ".$userbook.");'>".$ids."</td>";
            else if($bkd>0){
              if($bkd==$userbook)
                echo "<td id = '".$ids."' class='cli' onmouseover='mouseover(this);' onmouseout='mouseout(this);' onclick='bookSeat(this, ".$userbook.");'>".$ids."</td>";
              else
                echo "<td id = '".$ids."' class='booked' onmouseover='mouseover(this);' onmouseout='mouseout(this);' onclick='bookSeat(this, ".$userbook.");'>".$ids."</td>";
            }
            else{
              echo "<td id = '".$ids."' class='bought'>".$ids."</td>";
            }
        }
        echo "</tr>";
    }
    ?>
    </table>
  </div>
  <div class="sidenav">
    <a href="booking.php">Home</a>
    <a href="logout.php">Logout</a>
  </div>
</div>
</body>
</html>