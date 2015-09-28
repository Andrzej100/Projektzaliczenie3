<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sklep
 *
 * @author andrzej.mroczek
 */
class Sklep {
    
     private $wiedzmin;
    
   /*
    * konstruktor pobiera wiedzmina
    */
    public function __construct(Postac\Wiedzmin $wiedzmin){
        $this->wiedzmin=$wiedzmin;
    }
 
    /*
     * pobiera z bazy rzeczy do kupienia
     */
    public function dokupienia(){
        $db=bazadanych::getInstance();
        $wynik=$db->select('sklep');
        
        
        return $wynik;
    }
    /*
     * pobiera ekwipunek do sprzedania
     */
    public function dosprzedania(){
        $db=bazadanych::getInstance();
        $wynik=$db->select('ekwipunek',array('id_postaci'=>$this->wiedzmin->Getparam()->getId()));
      
        return $wynik;
    }
   /*
    *  realizuje operacje kupowania
    */
    public function kupno2($kupione){
        $kupowane=$this->dokupienia();
        $posiadane=$this->dosprzedania();
        $kupione2=$this->zmiennadotablica($kupione, $kupowane);
        $dokupienia=$this->nieposiadanerzeczy($kupione2,$posiadane);
        $zloto=$this->potrzebnezloto($dokupienia);
        $gold=$this->wiedzmin->Getparam()->getGold();
        if($gold>$zloto){
            $this->kupno($kupione2);
            $gold=$this->wiedzmin->Getparam()->getGold();
            $this->wiedzmin->Getparam()->setGold($gold-$zloto);
            return true;
        }
        else{
            return false;
        }
    }
    /*
     * realizuje operacje sprzedazy
     */
    public function sprzedarz2($sprzedane){
        $zloto=$this->potrzebnezloto($sprzedane);
        $this->sprzedarz($sprzedane);
        $this->wiedzmin->Getparam->setGold($this->wiedzmin->Getparam->getGold+$zloto);
    }
    /*
     * dodaje do ekwipunku kupione obiekty
     */
    public function kupno($dokupienia){
    $db=bazadanych::getInstance();
    $id=$this->wiedzmin->Getparam()->getId();
    foreach($dokupienia as $k){
        $db->zapisz('ekwipunek',array('nazwa'=>$k['nazwa'],'param1'=>$k['param1'],'param2'=>$k['param2'],'cena'=>$k['cena'],'id_postaci'=>$id));
       }  
     }
     /*
      * usuwa z ekwipunku sprzedane obiekty
      */
     public function sprzedarz($sprzedane){
         $db=bazadanych::getInstance();
         foreach($sprzedane as $p){
          $db->usun('ekwipunek',array('nazwa'=>$p['nazwa'],'id_postaci'=>$this->wiedzmin->Getparam->getId()));    
         }
     }
     /*
      * sumuje potrebne zloto do kupienia badz 
      * zloto do odzyskania po sprzedazy
      */
public function potrzebnezloto($produkty){
    $zloto=0;
    foreach($produkty as $zaznaczone){
        
         $zloto+=$zaznaczone['cena'];
    }
     return $zloto;
}
/*
 * wyswietla  produkty zaznaczone jako jako tablice z ich parametrami
 * 
 */
public function zmiennadotablica($produkty,$kupowane){
    for($i=0; $i<count($kupowane); $i++){
        foreach($produkty as $produkty2){
        if($kupowane[$i]['nazwa']==$produkty2){
            $zakupione[]=$kupowane[$i];
        }
        }
}
return $zakupione;
}
/*
 * sprawdza czy posiada rzecz ktora chce kupic
 */
public function nieposiadanerzeczy($kupione,$zaznaczone){
       foreach($zaznaczone as $k){
               for($i=0; $i<count($kupione); $i++){
               if($kupione[$i]['nazwa']==$k['nazwa']){
                   unset($kupione[$i]);
                    array_values($kupione);
               }
           }
       }
       return $kupione;
}
}