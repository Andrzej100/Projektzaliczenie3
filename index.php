<?php

//magincza fukcja autoloadera 
//
function __autoload($file) {

    include __DIR__.DIRECTORY_SEPARATOR.$file.'.php';

}
if(!$_GET){
?>

 Rejestracja
        <form action="index.php" method="GET">
            <input type="hidden" name="strona" value="rejestracja">
            <input type="submit"  value="rejestracja"/>
        </form>
        Logowanie
        <form action="index.php" method="GET">
            <input type="hidden" name="strona" value="logowanie">
            <input type="submit"  value="logowanie"/>
        </form>
<?php
}
$game = new Game();
$game->start();

