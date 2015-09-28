<?php

namespace Postac;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Potwor
 *
 * @author andrzej.mroczek
 */
class Potwor extends Postac {
   /*
    * konstruktor wywoluje parametry tymczasowe i nadaje im wartosc parametrow stalych
    */
    public function __construct($name){
        $this->param = new \Parameters();
        $this->param->setStringParameter($name);
        $this->zycie = $this->Getparam()->getZycie();
        $this->zrecznosc= $this->Getparam()->getZrecznosc();
        $this->sila= $this->Getparam()->getSila();
        $this->szybkosc=$this->Getparam()->getSzybkosc();
        $this->setName($name[0]['imie']);
        
    }
    /*
     * zwraca imie
     */
    public function getName() {
        return $this->name;
    }
    /*
     * dodaje zloto potwora do bohatera
     */
    public function zlotopotwora(){
        return $this->Getparam()->getGold();
    }
    /*
     * dodaje doswiadczenie do bohatera
     */
    public function doswpotwora(){
        return $this->Getparam()->getDosw();
    }
}

