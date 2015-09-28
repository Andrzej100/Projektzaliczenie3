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
        Statystyki
        <?php echo $message; ?>
        <?php if(isset($statystyki)){echo $statystyki;} ?>
        <form action="index.php?strona=statystyki" method="POST">
            <select name="staty">
                <option value="sila">Sila</option>
                <option value="zrecznosc">Zrecznosc</option>
                <option value="szybkosc">Szybkosc</option>
                <option value="zycie">Zycie</option>
                <option value="wygrane">Wygrane</option>
                <option value="przegrane">Przegrane</option>
            </select>
            <input type="submit"  value="Wybierz"/>
        </form>
        <a href="index.php?strona=wyboropcji">Wroc</a>
    </body>
</html>
