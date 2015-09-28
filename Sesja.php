<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sesja
 *
 * @author Andrzej
 */
class Sesja {
    
    private static $session = false;
    /* 
     *pobiera instanjce obiektu
     * **/
    public static function getInstance() {
        if(self::$session == false){
            self::$session = new Sesja();
        }
        return  self::$session;
    }
    /* 
     *tworzy sesje
     */
    public function __construct() {
        session_start();
    }
    /*
     * ustawia zmienne do talicy w sesji
     * **/
     
    public function setUp($data) {
        if(empty($_SESSION['app'])){
            $_SESSION['app']=$data;
        }else{
            $this->append($data);
        }    
    }
    /*
     * dodaje rowniez zmienne tablicowe
     * **/
     
    private function append($data){
        foreach($data as $key=>$row){
            $_SESSION['app'][$key] = $row;
        }
    }
    /*
     * wyswietla zawartosc sesji
     * **/
     
    public function debug() {
        var_dump($_SESSION);
    }
    /*
     * usuwa zmienną z sesji
     */
    public function delete($key){
        unset($_SESSION['app'][$key]);
    }
    /*
     * ustawia informacje do wyswietlenia
     */
    public function setMessage($message) {
        $_SESSION['system']['message'] = $message;
    }
    /*
     * pobiera wiadomosc do wyswietlenia
     */
    public function getMessage() {
        $message = '';
        if(!empty($_SESSION['system']['message'])){
            $message = $_SESSION['system']['message'];
            unset($_SESSION['system']['message']);
        }

            
        return $message;
    }
    /*
     * pobiera zmienną z sesji
     */
    public function get($key) {
        if(empty($_SESSION)){
            return null;
        }
        if(isset($_SESSION['app'][$key])){
            return $_SESSION['app'][$key];
        }
        return false;   
    }
    /*
     * niszczy sesje
     */
    public function destroy() {
        session_destroy();
    }
    
   

}
