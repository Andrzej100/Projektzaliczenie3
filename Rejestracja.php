<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Rejestracja
 *
 * @author andrzej.mroczek
 */
class Rejestracja {

    private $uzytkownik;
    
    /*
     * konstruktor pobierz obiekt uzytkownika
     */
    public function __construct(Uzytkownik $uzytkownik) {
        $this->uzytkownik = $uzytkownik;
        
    }
    /*
     * zapisuje nowego uzytkownika
     */
    public function zapisz() {
        
        $db = bazadanych::getInstance();
        $db->zapisz('uzytkownik', array(
            'login'=>$this->uzytkownik->getLogin(),
            'haslo'=>$this->uzytkownik->getHaslo()
        ));
    }
    /*
     * pobiera z bazy juz zarejestrowanych uzytkownikow
     */
    public function sprawdz(){
        $db = bazadanych::getInstance();
        $wynik=$db->select('uzytkownik',array('login'=>$this->uzytkownik->getLogin()));
        if($wynik == false){
            return false;
        }
        
        return $wynik[0]['login'];
    }
}
