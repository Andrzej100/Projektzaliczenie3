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
        <?php echo $message; 
        if(!$_POST){
        ?>
        Rejestracja nowego użytkownika
        <form action="index.php?strona=rejestracja" method="POST">
            <input name="login"  />
            <input name="haslo" />
            <input type="submit"  value="Rejestruj"/>
        </form>
        <a href="index.php?strona=wybor">Wroc</a>
       <?php }
        ?>
        <a href="index.php?strona=logowanie">logowanie</a>
    </body>
</html>
