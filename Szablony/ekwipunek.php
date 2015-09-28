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
        
        <form action="index.php?strona=ekwipunek" method="POST">
            <?php foreach($wynik as $bron) { 
            
                 if($bron['aktywne']==1){
                     
                     echo $bron['nazwa'].$bron['param1'].$bron['param2']."-aktywne";
                 }}
                ?>
            <select name="wybor">
                <?php 
                foreach($wynik as $bron) { echo var_dump($wynik);
                if($bron['aktywne']==0){?>
                 <option value="<?php echo $bron['nazwa']; ?>" > <?php echo $bron['nazwa'].$bron['param1'].$bron['param2']; ?></option>
                <?php } }  
                ?>
                </select>
                <input type="submit"  value="aktywuj ekwipunek"/>
        </form>
        <a href="index.php?strona=wyboropcji">Wroc</a>
    </body>
</html>
