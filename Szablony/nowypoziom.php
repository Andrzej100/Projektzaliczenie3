<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
       
       
        <?php echo 'punkty  do rozdania'.' '.$punkty; ?>
        <form action="index.php?strona=nowypoziom" method="POST">
            Sila<?php echo $wynik[0]; if($punkty>0){ ?><input type="submit"  name="wybor" value="+1 Sila"/><?php } ?>
            Szybkosc<?php echo $wynik[1]; if($punkty>0){ ?><input type="submit"  name="wybor" value="+1 Szybkosc"/><?php } ?>
            Zrecznosc<?php echo $wynik[2]; if($punkty>0){ ?><input type="submit"  name="wybor" value="+1 Zrecznosc"/><?php } ?>
            Zycie<?php echo $wynik[3]; if($punkty>0){ ?><input type="submit"  name="wybor" value="+1 Zycie"/><?php } ?>
        </form>
    </body>
</html>
