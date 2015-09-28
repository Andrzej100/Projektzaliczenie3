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
        Wybór postaci kierowanej przez bohatera
        <?php echo $message;?>
        <?php if($postac!=false){echo $postac->getName();} ?>
        <?php if(!$_POST){?>
        <form action="index.php?strona=wyborpostaci" method="POST">
         <label>Wybierz postac</label><select name="wybor">
                <?php foreach($wynik as $p) { ?>
                    <option value="<?php echo $p['id'];?>" > <?php echo $p['imie'];?></option>
                <?php }?>
            </select>
            <label>Nowa postac</label>
            <input type ="text" name="imie"/>
            <input type="submit"  value="Wybierz postac"/>
        </form>
        <a href="index.php?strona=logowanie">wroc</a><?php } else{ ?>
        <a href="index.php?strona=wyboropcji">wyboropcji</a>
        <?php } ?>
    </body>
</html>
