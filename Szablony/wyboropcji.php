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
        Wybierz co chcesz robic
        <form action="index.php?strona=ekwipunek" method="GET">
            <input type="submit"  name="strona" value="ekwipunek"/>
        </form>
         <form action="index.php?strona=sklep" method="GET">
            <input type="submit"  name="strona" value="sklep"/>
        </form>
         <form action="index.php?strona=statystyki" method="GET">
            <input type="submit"  name="strona" value="statystyki"/>
        </form>
         <form action="index.php?strona=przeciwnik" method="GET">
            <input type="submit"  name="strona" value="przeciwnik"/>
        </form>
    </body>
</html>
