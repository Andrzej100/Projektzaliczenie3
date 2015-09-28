<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Tura {

    /**
     *
     * @var Postac\Wiedzmin
     */
    private $gracz;

    /**
     *
     * @var Postac\Postac
     */
    private $przeciwnik;

    /**
     * Dodaje gracza do obiektu Tura
     * @param Postac\Wiedzmin $wiedzmin
     */
    private $punktyprzeciwnik;
    
    private $punktygracz;
    
    private $kolejg;
    
    private $kolejp;
    
    private $turag;
    
    private $turap;
    
    public function dodajGracza(Postac\Wiedzmin $wiedzmin) {
        $this->gracz = $wiedzmin;
    }

    /**
     * Dodaje przeciwnika do obiektu Tura
     * @param Postac\Potwor $potwor
     */
    public function dodajPrzeciwnika(Postac\Potwor $potwor) {
        $this->przeciwnik = $potwor;
    }
    public function dodajnagroda(){
        
       $this->gracz->Getparam()->setGold($this->gracz->Getparam()->getGold()+$this->przeciwnik->zlotopotwora());
       $this->gracz->Getparam()->setDosw($this->gracz->Getparam()->getDosw()+$this->przeciwnik->doswpotwora());
    }
    /**
     * Sprawdza czy pobrany obiektma parametr życie mniejszy bądź równy 0
     * @return boolean
     */
    public function sprawdzCzyKoniec() {
        if ($this->gracz->getZycie()<=0) {
            $this->gracz->restore();
            return 0;
        }
        elseif($this->przeciwnik->getZycie()<=0){
            $this->przeciwnik->restore();
            return 0;
        }
        return 1;
    }

    /**
     * wywołuje funkcje Obrona i punkty akcji
     */
    public function aktywne() {
        $this->gracz->koniecobrony();
        
    }

    /**
     * Wywołuje truę przeciwnika
     * Wywołuje funkcję wiadomość oraz czas_trwania
     */
    public function tura_przeciwnika() {
        if($this->turag==0){
        $this->kolejg=1;
        $this->kolejp=0;
        $this->turap=1;
        }
        else{$this->kolejp=0;
        $this->turap=1;
        }
        $ilosc=0;
        do{
            $this->punktyprzeciwnik--;
            $atak[]=$this->przeciwnik->wykonajAtak($this->gracz);
            ++$ilosc;
        }
        while( $this->punktyprzeciwnik==0);
        return $atak[0].'x'.$ilosc;
        
    }
   /*
    * funkcje akcji sa wyolywane
    * w zaleznosci czyja kolej albo jak poczatek tury to funkcja losowanie
    */
    public function akcja1($opcja) {
        
            return $this->punktygracz($opcja);
    }


   public function akcja3(){
       
        return $this->tura_przeciwnika();
        
   }
    public function losowanie(){
            $this->kolejg=0;
            $this->kolejp=0;
            $this->aktywne();
            $this->punktyakcji();
            $this->czyjatura();
            $this->gracz->czas_trwania();
            $this->turag=0;
            $this->turap=0;
            if($this->kolejg==0){
                $przeciwnik=$this->tura_przeciwnika();
            return $przeciwnik."przeciwnik rozpoczyna ture pierwszy";}
            elseif($this->kolejg==true){return "Gracz rozpoczyna ture pierwszy";}
        
    }
    public function nastepny(){
        if($this->turap==0){
            $this->kolejp=1;
            $this->kolejg=0;
            $this->turag=1;
        }
        else{
            $this->kolejg=0;
            $this->turag=1;
        }
    }

    /**
     * Ustawia akcję gracza
     * @param type $opcja
     */
    public function opcja($opcja) {
        switch ($opcja) {
            case "a":
                $this->punktygracz--;
                return $this->gracz->wykonajAtak($this->przeciwnik);
                
            case "b":
                $this->punktygracz--;
                return $this->gracz->utworz_eliksir();
            
            case "c":
                $this->punktygracz--;
                return $this->gracz->wypij();
                
            case "d":
                $this->punktygracz--;
                 $this->nastepny();
               return  $this->gracz->wykonajObrone();
               
            case "e":
                $this->nastepny();
               
            default:
                //                exit();
                break;
        }
    }

    /**
     * Oblicza punkty akcji po każdej turze
     */
    public function punktyakcji() {
        $szybkoscg = $this->gracz->Getparam()->getSzybkosc();
        $szybkoscp = $this->przeciwnik->Getparam()->getSzybkosc();
        if ($szybkoscg > $szybkoscp) {
            $punkty = $this->obliczpunkty($szybkoscg, $szybkoscp);
            $this->gracz->Getparam()->setpktakcji($punkty);
        } elseif ($szybkoscg < $szybkoscp) {
            $punkty = $this->obliczpunkty($szybkoscp, $szybkoscg);
            $this->przeciwnik->Getparam()->setpktakcji($punkty);
        }else{
        $this->punktygracz=$this->gracz->Getparam()->getpktakcji();
        $this->punktyprzeciwnik=$this->przeciwnik->Getparam()->getpktakcji();}
    }

    /**
     * Dodaje punkty za szybkosć 
     * @param type $szybkoscg
     * @param type $szybkoscp
     * @return type
     */
    public function obliczpunkty($szybkoscg, $szybkoscp) {
        $punkty = Floor($szybkoscg / $szybkoscp);
       

        return $punkty;
    }
    /*
     * losowanie tury
     * jezeli punkty szybkosci takie same
     */
public function losowy(){
    $losowy=rand(0,1);
    if($losowy==0){
        $this->kolejg=1; $this->koljep=0;
    }
    else{
        $this->kolejp=1; $this->kolejg=0;
        }
    }
/*
 * sprawdza czyja tura
 */
    public function czyjatura(){
        if($this->punktygracz>$this->punktyprzeciwnik){
            $this->kolejg=1; $this->koljep=0;
        }
        elseif($this->punktygracz<$this->punktyprzeciwnik){
            $this->kolejp=1; $this->kolejg=0;
        }
        elseif($this->punktygracz==$this->punktyprzeciwnik){
            $this->losowy();
        }
    }
    public function getKolejg(){
        return $this->kolejg;
    }
    
    public function getKolejp(){
        return $this->kolejp;
    }
    public function setKolejg(){
        $this->kolejg=0;
    }
   public function setKolejp(){
        $this->kolejp=0;
    }
   public function setKolejpp(){
       return  $this->punktygracz;
    }
    /*
     * sprawdza czy gracz ma jeszcze punkty akcji
     */
    public function punktygracz($opcja){
        if($opcja!='e' && $this->punktygracz<=0){
            $info="koniec punktów";
            return $info;
        }else{
           return $this->opcja($opcja); 
        }
    }
}
