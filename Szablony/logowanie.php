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
        Logowanie użytkownika
        <?php echo $message;
        if(!$_POST){
        ?>
        <form action="index.php?strona=logowanie" method="POST">
            <input name="login"  />
            <input name="haslo" />
            <input type="submit"  value="Zaloguj"/>
        </form>
        <a href="index.php?strona=wybor">Wroc</a>
        <?php }else{
        ?>
        <a href="index.php?strona=wyborpostaci">wybor postacii</a>
        <?php }
        ?>
    </body>
</html>
