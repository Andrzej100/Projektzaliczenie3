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
        <?php echo $message; ?>
        <form action="index.php?strona=przeciwnik" method="POST">
            <select name="wybor">
                <?php foreach($wynik as $p) { ?>
                    <option value="<?php echo $p['imie'];?>" ><?php echo $p['imie'].$p['sila'].$p['szybkosc'].$p['zrecznosc'].$p['zycie'];?></option>
                <?php }?>
                     
            </select>
             <input type="submit"  value="Wybierz przeciwnika"/>
        </form>
        <a href="index.php?strona=wyboropcji">Wroc</a>
       <?php if($_POST){?> <a href="index.php?strona=tura">rozpocznij gre</a> <?php } ?>
    </body>
</html>
