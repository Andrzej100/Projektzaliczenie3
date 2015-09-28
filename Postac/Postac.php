<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Postac;

/**
 *
 * @author andrzej.mroczek
 */
abstract class Postac {

    /**
     *
     * @var \Parameters
     */
    protected $param;
    protected $zycie;
    protected $sila;   
    protected $name;
    protected $zrecznosc;
    protected $szybkosc;
   
      
/*
 * ustawia imie postaci
 */
    public function setName($name){
        $this->name=$name;
    }
    public abstract function getName();

    /**
     * Wykonuje atak i sprawdza czy skuteczny
     * @param \Postac\Postac $postac
     */
    public function wykonajAtak(Postac $postac) {
        $zmienna='';
        if ($this->czyAtakSkutecznoy($postac)) {
            $this->odbierzPunkt($postac);
            $zmienna="Atak Skuteczny";
            return $zmienna;
        }else{
            $zmienna="Atak Nieskuteczny";
    return $zmienna;}
    }

    /**
     * Odbiera punkty postaci wywoływana przez wykonajAtak
     * @param \Postac\Postac $postac
     */
    private function odbierzPunkt(Postac $postac) {
        $postac->setZycie($postac->getZycie()-1);
    }

    /**
     * Oblicza czy atak jest skuteczny wdl wzoru podanego
     * @param \Postac\Postac $postac
     * @return boolean
     */
    private function czyAtakSkutecznoy(Postac $postac) {
        $skutecznosc = $this->getZrecznosc() - $postac->getZrecznosc();
        
        $skutecznosc =($skutecznosc / $postac->getZrecznosc())*  100;

        if ($skutecznosc < 10) {
            $skutecznosc = 10;
        } elseif ($skutecznosc > 90) {
            $skutecznosc = 90;
        }

        if (rand(1, 100) >= $skutecznosc) {

            return true;
        }

        return false;
    }

    /**
     * Zwraca wartość parametru zycie
     * @return type
     */
    public function getZycie() {
        return $this->zycie;
    }

    /**
     * Ustawia wartośc parametru życie
     * @param type $value
     */
    public function setZycie($value) {
       $this->zycie=$value;
    }
    /*
     * przypisuje po walce parametrom tymczasowym wartosci parametrow stałych
     */
    public function restore(){
        $this->zycie=$this->Getparam()->getZycie();
        $this->zrecznosc= $this->Getparam()->getZrecznosc();
        $this->sila= $this->Getparam()->getSila();
        $this->szybkosc=$this->Getparam()->getSzybkosc();
        
    }
    /**
     * Zwraca wartość parametru zręczność parametry uzywane podczas walki(tymczasowe)
     * @return type
     */
    public function getZrecznosc() {
        return $this->zrecznosc;
    }
    public function getzSila() {
        return $this->sila;
    }
     public function getSzybkosc() {
        return $this->szybkosc;
    }
    public function setZrecznosc($zrecznosc){
        $this->zrecznosc=$zrecznosc;
    }
    public function setzSila($sila) {
        $this->sila=$sila;
    }
    public function setSzybkosc($szybkosc) {
        $this->szybkosc=$szybkosc;
    }
    /**
     * Zwraca obiekt Parameters
     * @return type
     */
    public function Getparam() {
        return $this->param;
    }
    

}
