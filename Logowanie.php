<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Logowanie
 *
 * @author andrzej.mroczek
 */
class Logowanie {
    private $uzytkownik;
     /*
      * konstruktor pobiera uzytkownika
      */
    public function __construct(Uzytkownik $uzytkownik) {
        $this->uzytkownik = $uzytkownik;
        
    }
    /*
     * sprawdza czy istnieje uzytkownik jezeli tak zwraca tablice z jego parametrami
     * jeżeli nie zwraca false
     */
    public function sprawdz(){
        $db = bazadanych::getInstance();
        $wynik=$db->select('uzytkownik',array('login'=>$this->uzytkownik->getLogin(),
            'haslo'=>$this->uzytkownik->getHaslo()));
        if($wynik == false){
            return false;
        }
        
        return $wynik[0];
    }
}
