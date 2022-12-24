<?php

//Calc breite Grafiks

$Maxvw = 100;
$codePerc = $codeBestellungen *$Maxvw;

$codePerc = $codePerc / $totalBestellungen;

$codePerc = round($codePerc,2);

//si $Maxvw% = total ## bb1 = 
//echo '$totalBluBox1'.$totalBluBox1 .'/';
//echo $totalBestellungen;
$breit1t = $totalBluBox1 * $Maxvw;
$breit1t = round($breit1t / $totalBestellungen) ;
$breit1c = $codeBluBox1 * $Maxvw;
$breit1c = round($breit1c / $totalBestellungen) ;

$breit2t = $totalBluBox2 * $Maxvw;
$breit2t = round($breit2t / $totalBestellungen) ;
$breit2c = $codeBluBox2 * $Maxvw;
$breit2c = round($breit2c / $totalBestellungen) ;


$breit3t = $totalBluBox3 * $Maxvw;
$breit3t = round($breit3t / $totalBestellungen) ;
$breit3c = $codeBluBox3 * $Maxvw;
$breit3c = round($breit3c / $totalBestellungen) ;


$breit4t = $totalBluBox4 * $Maxvw;
$breit4t = round($breit4t / $totalBestellungen) ;
$breit4c = $codeBluBox4 * $Maxvw;
$breit4c = round($breit4c / $totalBestellungen) ;


$breit5t = $totalBluBox5 * $Maxvw;
$breit5t = round($breit5t / $totalBestellungen) ;
$breit5c = $codeBluBox5 * $Maxvw;
$breit5c = round($breit5c / $totalBestellungen) ;


$breit6t = $totalBluBox6 * $Maxvw;
$breit6t = round($breit6t / $totalBestellungen) ;
$breit6c = $codeBluBox6 * $Maxvw;
$breit6c = round($breit6c / $totalBestellungen) ;
//importante se incluyen los estilos CSS

?>
<div class="zone">
<h4>Zusammenfassung</h4>
<h5 style="color:#00408B;">Bestellungen insgesamt: <strong><?php echo $totalBestellungen; ?></strong> und Bestellungen mit Code: <strong><?php echo $codeBestellungen; ?> ( <?php echo $codePerc; ?>%)</strong>.</h5>
<!-- BluBox 1-->
Bestellungen von BluBox #1: <strong><?php echo $totalBluBox1; ?></strong>
<div class="boxAnalitica pinky"style="width:<?php echo $breit1t; ?>vw"> </div>
Bestellungen von BluBox #1 mit Code: <strong><?php echo $codeBluBox1; ?></strong>
<div class="boxAnalitica blinky" style="width:<?php echo $breit1c; ?>vw"> </div>
<!--  Bestellungen von BluBox #2-->
Bestellungen von BluBox #2: <strong><?php echo $totalBluBox2; ?></strong>
<div class="boxAnalitica ponky"style="width:<?php echo $breit2t; ?>vw"> </div>
Bestellungen von BluBox #2 mit Code: <strong><?php echo $codeBluBox2; ?></strong>
<div class="boxAnalitica blonky" style="width:<?php echo $breit2c; ?>vw"> </div>
<!--  Bestellungen von BluBox #3-->
Bestellungen von BluBox #3: <strong><?php echo $totalBluBox3; ?></strong>
<div class="boxAnalitica penky"style="width:<?php echo $breit3t; ?>vw"> </div>
Bestellungen von BluBox #3 mit Code: <strong><?php echo $codeBluBox3; ?></strong>
<div class="boxAnalitica blenky" style="width:<?php echo $breit3c; ?>vw"> </div>
<!--  Bestellungen von BluBox #4-->
Bestellungen von BluBox #4: <strong><?php echo $totalBluBox4; ?></strong>
<div class="boxAnalitica pinky"style="width:<?php echo $breit4t; ?>vw"> </div>
Bestellungen von BluBox #4 mit Code: <strong><?php echo $codeBluBox4; ?></strong>
<div class="boxAnalitica blinky" style="width:<?php echo $breit4c; ?>vw"> </div>
<!--  Bestellungen von BluBox #5-->
Bestellungen von BluBox #5: <strong><?php echo $totalBluBox5; ?></strong>
<div class="boxAnalitica ponky"style="width:<?php echo $breit5t; ?>vw"> </div>
Bestellungen von BluBox #5 mit Code: <strong><?php echo $codeBluBox5; ?></strong>
<div class="boxAnalitica blonky" style="width:<?php echo $breit5c; ?>vw"> </div>
<!--  Bestellungen von BluBox #6-->
Bestellungen von BluBox #6: <strong><?php echo $totalBluBox6; ?></strong>
<div class="boxAnalitica penky"style="width:<?php echo $breit6t; ?>vw"> </div>
Bestellungen von BluBox #6 mit Code: <strong><?php echo $codeBluBox6; ?></strong>
<div class="boxAnalitica blenky" style="width:<?php echo $breit6c; ?>vw"> </div>


</div>

