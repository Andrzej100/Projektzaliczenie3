<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Statystyki
 *
 * @author andrzej.mroczek
 */
class Statystyki {
   
    
    
/*
 * wyswietla i sortuje statystyki wedlug podanego parametru
 */
    public function statystykiwyswietl($param){
           
        $db = bazadanych::getInstance();
        $wynik=$db->select('postac');
        if(isset($wynik)){
        for($i=0; $i<count($wynik); $i++){
            $stat[$wynik[$i]['imie']]=$wynik[$i][$param];
        }
        asort($stat);
        $pos="";
        foreach ($stat as $key => $val) {
            $pos.=$key."=".$val."";
      
        }
        return $pos;
        }
        else{
            return false;
        }
        }
       
    
}



