<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Ekwipunek
 *
 * @author andrzej.mroczek
 */
class Ekwipunek {

  
    private $bohater_id;
    /*
     * konstruktor przypisuje id bohatera
     * 
     */
    public function __construct($bohater_id) {

        $this->bohater_id=$bohater_id;
    }
     /*
      * zwraca aktywny ekwipunek w postaci tablicy
      */
    public function aktywne(){
        $db = bazadanych::getInstance();
        $wynik=$db->select('ekwipunek',array('aktywne'=>1,'id_postaci'=>$this->bohater_id));
         if($wynik == false){
            return false;
        }
        
        return $wynik;
    }
    /*
     * pobiera nazwe broni wybranej w menu i zwraca jej parametry w tablicy
     */
    public function bron($aktywne,$nazwa){
        foreach($aktywne as $a){
            if($a['nazwa']==$nazwa){
                $aktywna=$a;
            }
        }
        return $aktywna;
    }
    /*
     * sprawdza bron i aktywuje jeżeli nie zostala aktywowana bądź zastepuje inna aktywna bron
     */
    public function aktywuj($nazwa){
        $db = bazadanych::getInstance();
        $aktywne=$this->aktywne();
        $ekwipunek=$this->showekwipunek();
        $bron=$this->bron($ekwipunek, $nazwa);
        if(isset($aktywne[0]) && $aktywne[0]['typ']==$bron['typ']){
         $db->update('ekwipunek',array('aktywne'=>0),array('nazwa'=>$aktywne[0]['nazwa'],'id_postaci'=>$this->bohater_id));
         $db->update('ekwipunek',array('aktywne'=>1),array('nazwa'=>$nazwa,'id_postaci'=>$this->bohater_id));
        }elseif(isset($aktywne[1]) && $aktywne[1]['typ']==$bron['typ']){
         $db->update('ekwipunek',array('aktywne'=>0),array('nazwa'=>$aktywne[1]['nazwa'],'id_postaci'=>$this->bohater_id));
         $db->update('ekwipunek',array('aktywne'=>1),array('nazwa'=>$nazwa,'id_postaci'=>$this->bohater_id));
        }else{
           $db->update('ekwipunek',array('aktywne'=>1),array('nazwa'=>$nazwa,'id_postaci'=>$this->bohater_id)); 
        }
        
    }
  /*
   * przypisuje aktywna bron i zwraca jako obiekt
   */
    public function aktywnabron($typ){
         $przedmiot=$this->aktywne();
         if($przedmiot!=false){
         if(isset($przedmiot[0]) && $przedmiot[0]['typ']==$typ){
             $bron=new $typ($przedmiot);
             return $bron;
         }elseif(isset($przedmiot[1]) && $przedmiot[1]['typ']==$typ){
             $bron=new $typ($przedmiot);
             return $bron;
         }
       }else{
           return false;
       }
    }
    
   
  
/*
 * pokazuje ekwipunek danej postaci kierowanej przez gracza
 */
    public function showekwipunek() {
       
        $db=bazadanych::getInstance();
        $wynik=$db->select('ekwipunek',array('id_postaci'=>$this->bohater_id));
      
        return $wynik;
        
    }
    
    
    
   

}
