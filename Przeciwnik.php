<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of przeciwnik
 *
 * @author andrzej.mroczek
 */
class Przeciwnik {
     /*
      * pobiera z bazy wszystkich przeciwnikow i zwraca jako tablice
      */
    public function wszyscyprzeciwnicy(){
          $db = bazadanych::getInstance();
        $wynik=$db->select('przeciwnik');
         if($wynik == false){
            return false;
        }
        
        return $wynik;
     }
 /*
  * zwraca tablice z parametrami wybranego przeciwnika
  */
    public function wybranyprzeciwnik($nazwa){
      $db = bazadanych::getInstance();
        $wynik=$db->select('przeciwnik',array('imie'=>$nazwa));
         if($wynik == false){
            return false;
        }
        
        return $wynik;
}


}