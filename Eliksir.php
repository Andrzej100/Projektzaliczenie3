<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Eliksir {

    /**
     *
     * @var Postac\Postac
     */
    private $postac;
    private $poziom;
    private $typ;

    /**
     * Konstruktor obiektu eliksir
     * @param Postac\Wiedzmin $gracz
     * @param type $poziom
     */
    public function __construct(Postac\Wiedzmin $gracz, $poziom) {
        $this->postac = $gracz;
        $this->poziom = $poziom;
    }

    /**
     * Zwieksza siłe o poziom elikisru
     */
    public function sila() {
        $sila = $this->postac->getSila();
        $this->postac->setSila($sila + $this->poziom);
        $this->typ = 'sila';
    }

    /**
     * Zwieksza szybkość o poziom elikisru
     */
    public function szybkosc() {
        $szybkosc = $this->postac->getSzybkosc();
        $this->postac->setSzybkosc($szybkosc + $this->poziom);
        $this->typ = 'szybkosc';
    }

    /**
     * Zwieksza życie o poziom elikisru
     */
    public function zycie() {
        $this->postac->setZycie($this->postac->getZycie() + $this->poziom);
    }

    /**
     * Licznik tur 
     * Sprawdza kiedy koniec zwiększonego parametru
     * @return boolean
     */
    public function czas_trwania($czas) {

        if ($czas > 0) {
            return true;
        } elseif ($czas <= 0) {
            $this->odejmij_bonus();
            return false;
        }
    }

    /**
     * Odejmuje bonus pod koniec działania funkcji czas_trwania
     */
    public function odejmij_bonus() {
        if ($this->typ == "szybkosc") {
            $szybkosc = $this->postac->getSzybkosc();
            $this->postac->setSzybkosc($szybkosc - $this->poziom);
        } elseif ($this->typ == "sila") {
            $sila = $this->postac->getSila();
            $this->postac->setSila($sila - $this->poziom);
        }
    }

}
