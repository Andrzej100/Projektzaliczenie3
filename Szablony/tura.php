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
         <?php echo 'Zycie postaci gracza'.' '.$postac->getZycie(); echo ' Zycie potwora'.' '.$potwor->getZycie();?></br>
       
          <?php if(!isset($_POST['wybor'])){ ?>
          <?php echo $message; ?>
        <form action="index.php?strona=tura" method="POST">
        <input type="submit" name="wybor" value="rozpocznij gre"/>
        </form>
    <?php }?>
        <?php if(isset($_POST['wybor']) && empty($wynik3)){ ?>
        
        <?php echo $akcja.'ruch'; ?>
        <?php echo $message; ?>
        <form action="index.php?strona=tura" method="POST">
            <select name="wybor">
                 <option value="a" >atak</option>
                 <option value="b" >utworz eliksir</option>
                 <option value="c" >wypij eliksir</option>
                 <option value="d" >obrona(konczy ture)</option>
                 <option value="e" >koniec tury</option>
            </select>
            <input type="submit"  value="wybierz ruch"/>
        </form>
    <?php }?>
      <?php 
      if(isset($wynik3) && $wynik3[0]){?>
         <?php echo $message; ?>
        <form action="index.php?strona=przeciwnik" method="POST">
        <input type="submit"  name="strona" value="przeciwnik"/>
        </form>
        
        <?php if($wynik3[1]>0){ ?>
         <form action="index.php?strona=nowypoziom" method="POST">
         <input type="submit"  name="strona" value="nowypoziom"/>
          </form>
        <?php }?> 
      <?php }?> 
    </body>
</html>
