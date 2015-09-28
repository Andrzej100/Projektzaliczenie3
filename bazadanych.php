<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of bazadanych
 *
 * @author andrzej.mroczek
 */
class bazadanych {

    private $pdo;
   
    private static $Instance = false;
  /*
  *Singleton pobiera bądz tworzy instancje bazy danych 
  */
    private function __construct() {
        $this->pdo= new PDO(
                'mysql:host=localhost;dbname=nowabaza',
                'Andrzej',
                'Andrzej27');
    }

    public static function getInstance() {
        if (self::$Instance == false) {
            self::$Instance = new bazadanych();
        }
        return self::$Instance;
    }

    private function __clone() {
        
    }

    public function getConnection() {
        return $this->pdo;
    }
    
    
    /*
     * zapisuje do bazy
     */
    public function zapisz($tabela, array $dane){
            
        $pola ='';
        $wartosci='';
        foreach($dane as $pole=>$wartosc){
//            $sql.= 
            $wartosci.=$this->jestString($wartosc).', ';
            $pola.=$pole.', ';
            
        }
        $wartosci= substr($wartosci, 0, strlen($wartosci)-2);
        $pola= substr($pola, 0, strlen($pola)-2);
        
        $sql = "insert into $tabela ($pola) values ($wartosci)";
        
        $result =$this->pdo->exec($sql);
        return $result;
        
    }
    /*
     * pobiera z bazy
     */
    public function select($tabela,array $name=null) {
        if($name == null) {
            $pdost = $this->pdo->prepare("Select * from $tabela");
        } else {
            $wynik ='';
            foreach ($name as $pole => $wartosc) {
                $wynik.=$pole . '=' . $this->jestString($wartosc) . ' AND ';
            }
            $wynik = substr($wynik,0, -4);
            $pdost = $this->pdo->prepare("Select * from $tabela Where $wynik");
        }
        $pdost->execute();
        return $pdost->fetchAll();
        
    }
    /*
     * usuwa z bazy
     */
    public function usun($tabela,array $name=null){
        if($name == null){
            $pdost = $this->pdo->prepare("DELETE * from $tabela");
        }
        else{
            $wynik='';
            foreach ($name as $pole => $wartosc) {
                $wynik.=$pole . '=' . $this->jestString($wartosc) . ' AND ';
            }
            $wynik = substr($wynik,0, -4);
            $pdost = $this->pdo->prepare("DELETE * from $tabela Where $wynik");
        }
        $pdost->execute();
    }
    /*
     * aktualizuje baze
     */
    public function update($tabela,$value,$name){
        $wynik='';
        foreach($value as $pole=>$wartosc){
            $wynik.=$pole.'='.$this->jestString($wartosc).', ';
        }
        $wynik=substr($wynik, 0, strlen($wynik)-2);
        //if($name==null){
          //   $pdost = $this->pdo->prepare("UPDATE $tabela SET $wynik");
        //}
        //else{
        $wynik2='';
            foreach($name as $pola=>$wartosci){
                $wynik2.=$pola. '=' .$this->jestString($wartosci) .' AND ';
            }
            $wynik2=substr($wynik2,0, -4);
            $pdost = $this->pdo->prepare("UPDATE $tabela SET $wynik WHERE $wynik2");
        //}
        $pdost->execute();
    }

    /*
     * zwraca zmienna w cudzyslowach(jako string)
     */
    private function jestString($krotka)
    {
        if(is_int($krotka))
        {
            return $krotka;
        }
        if(is_string($krotka))
        {
            return '"'.$krotka.'"';
        }
        return $krotka;
    }
 
}
