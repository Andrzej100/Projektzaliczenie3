<?php

namespace Postac;

/**
 * Description of Wiedzmin
 *
 * @author andrzej.mroczek
 * 
 */
class Wiedzmin extends Postac {

    private $aktywnaObrona = false;
    private $eliksir;
    private $wypij;
    private $iloscElixir = 1;
    private $czyWypiy = false;
    private $dodaj;      
    private $czas;
    private $bron;
    private $zbroja;
    /**
     * konstruktor wywoluje parametry tymczasowe i nadaje im wartosc parametrow stalych
     * 
     */
    public function __construct($param) {
        $this->param = new \Parameters();
        $this->param->setStringParameter($param);
        $this->zycie = $this->Getparam()->getZycie();
        $this->zrecznosc= $this->Getparam()->getZrecznosc();
        $this->sila= $this->Getparam()->getSila();
        $this->szybkosc=$this->Getparam()->getSzybkosc();
        
        $this->setName($param[0]['imie']);
    }
    
    /*
     * aktywuje obrone
     */
    public function wykonajObrone() {
        $this->dodaj = floor(($this->getZrecznosc() / 2)); //50%
        
        $this->setZrecznosc($this->getZrecznosc() + $this->dodaj);
        $this->aktywnaObrona = true;

        return "Obrona";
    }

    /**
     * Sprawadza obrone i jesli koniec zmniejsza zrecznosc
     * @return boolean
     */
    public function koniecobrony() {
        if ($this->aktywnaObrona == true) {

            $this->setZrecznosc($this->getZrecznosc() - $this->dodaj);

            $this->aktywnaObrona = false;
        }

        return $this->aktywnaObrona;
    }

    /**
     * Tworzy obiekt eliksir
     */
    public function utworz_eliksir() {
       
            $poziom=rand(1,3);
            $this->eliksir = new \Eliksir($this, $poziom);
            return "Eliksir Zostal utworzony";
        
    }

    /**
     * sprawdza czas trwania eliksiru
     */
    public function czas_trwania() {
        if (isset($this->eliksir) && $this->wypij == true) {
            $this->czas--;
            $this->wypij = $this->eliksir->czas_trwania($this->czas);
        }else{$this->czas=3; $this->czyWypiy=false;}
    }

    /**
     * uzywa obiektu eliksir zmienia parametry
     * ustawia czas trwania zmienionych parametrów
     * 
     */
    public function wypij() {
       if ($this->czyWypiy){
           return $this->czywypity();
       }
        $this->czyWypiy = true;
        switch (rand(1, 3)) {
            case 1:
                $this->eliksir->zycie();
                $this->czas_trwania();
                $this->wypij = true;
                return "wypito eliksir zycie";
            case 2:
                $this->eliksir->sila();
                $this->czas_trwania();
                $this->wypij = true;
                return "wypitio eliksir sila";
            case 3:
                $this->eliksir->szybkosc();
                $this->czas_trwania();
                $this->wypij = true;
                return "wypito eliksir szybkosc";

            default:
               return "Podaj z przedzialu 1-3";
        }
        $this->eliksir=false;
    }

    /**
     * wysyła komunikat ze  obiekt elikis juz został uzyty 
     * @return boolean
     */
    public function czywypity() {
        if ($this->czyWypiy == true) {
            
            return "zostal wypity";
        }
    }

    /**
     * Zwraca imie postaci
     * @return string  
     */
    public function getName() {
        return $this->name;
    }
    /*
     * aktywuje bonusy broni przed walka jezeli bron jest w ekwipunku i zaznaczona na aktywna 
     */
    public function posiadaaktwnabron(){
        if($this->bron){
        $this->setSila($this->getSila()+$this->bron->getparam1());
        $this->setZrecznosc($this->getZrecznosc()-$this->bron->getparam2());
        }
        if($this->zbroja){
         $this->setZycie($this->getZycie()+$this->zbroja->getparam1());
         $this->setSzybkosc($this->getSzybkosc()-$this->zbroja->getparam1());
        }
        
    }
    /*
     * 
     * sprawdza czy jakas zbroja lub bron jest aktywna
     */
    public function aktywnyEkwipunek($bron,$typ){
      
            if ($typ=='bron') {
                $this->bron = $bron;
            }
            if ($typ=='zbroja') {
                $this->zbroja =$bron;
            } 
           
        }
        
       
}