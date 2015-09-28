<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of nowypoziom
 *
 * @author andrzej.mroczek
 */
class Nowypoziom {
    
    private $poziom=array(1=>15,2=>30,3=>50,4=>80,5=>100);
   
    private $wiedzmin;
    
    /*
     * konstruktor pobiera obiekt postaci kierowanej przez bohatera
     */
    public function __construct($wiedzmin) {
        $this->wiedzmin=$wiedzmin;
        
    }
   /*
    * pobiera informacje  z bazy o poziomie i punktach bohatera
    */
    public function pobierz(){
        $db = bazadanych::getInstance();
        $wynik=$db->select('nowypoziom',array('id_postaci'=>$this->wiedzmin->Getparam()->getId()));
        if($wynik == false){
            return false;
        }
        
        return $wynik;
    }
    /*
     * sprawdza czy ma awansowac bohater na wyzszy poziom
     */
    public function sprawdzpoziom(){
        foreach($this->poziom as $key=>$value){
            if($value>=$this->wiedzmin->Getparam()->getDosw()){
               $poziom=$key;
               break;
            }
        }
        return $poziom;
    }
    /*
     * oblicza punkty zdobyte przez bohatera i cz osiagnol nowy poziom
     */
    public function punkty(){
      if($this->pobierz()==false){
          $this->zapisz();
      }
      $wynik=$this->pobierz();
      $poziom=$wynik[0]['poziom'];
      $punkty=$wynik[0]['punkty'];
      $wynik2=$this->sprawdzpoziom();
      $zwiekszpoziom=0;
      if($wynik2>$poziom){
          $poziom++;
          $zwiekszpoziom++;
      }
      if($zwiekszpoziom==1){
          $punkty+=2;
      }
      $this->update($punkty);
      $this->updatep($poziom);
          return $punkty;
      
    }
    
    /*
     * aktualizuje
     * punkty umiejetnosci
     */
    public function update($punkty){
        $db = bazadanych::getInstance();
        $db->update('nowypoziom',array('punkty'=>$punkty),array('id_postaci'=>$this->wiedzmin->Getparam()->getId()));
    }
    /*
     * aktualizuje
     * poziom
     */
    public function updatep($poziom){
        $db = bazadanych::getInstance();
        $db->update('nowypoziom',array('poziom'=>$poziom),array('id_postaci'=>$this->wiedzmin->Getparam()->getId()));
    }
    /*
     * zapisuje informacje o poziomie i punktach do bazy danych
     */
    public function zapisz(){
        $db = bazadanych::getInstance();
        $db->zapisz('nowypoziom',array('poziom'=>1,'punkty'=>0,'id_postaci'=>$this->wiedzmin->Getparam()->getId()));
    }
    /*
     * dodaje punkty do ststystyki podanej jako parametr
     */
    public function setpoints($string){
        $pobierz=$this->pobierz();
        $punkty=$pobierz[0]['punkty'];
        $this->update($punkty-1);
        $wynik=explode(" ",$string);
        if($wynik[1]=='Sila'){
        $this->wiedzmin->Getparam()->setSila($this->wiedzmin->Getparam()->getSila()+1);
    }
    elseif($wynik[1]=='Szybkosc'){
         $this->wiedzmin->Getparam()->setSzybkosc($this->wiedzmin->Getparam()->getSzybkosc()+1);
    }
    elseif($wynik[1]=='Zrecznosc'){
         $this->wiedzmin->Getparam()->setZrecznosc($this->wiedzmin->Getparam()->getZrecznosc()+1);
    }
    elseif($wynik[1]=='Zycie'){
         $this->wiedzmin->Getparam()->setZycie($this->wiedzmin->Getparam()->getZycie()+1);
    }
}
}