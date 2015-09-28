<?php

/**
 * Description of Game
 *
 * @author andrzej.mroczek
 */
class Game extends request {

    /**
     * Obsługa głównego wątku gry
     */
    public function start(){
      $session = Sesja::getInstance(); 
        //$rodzaj = $szablon->getSzablon();
        $szablon =  new Ladowanie();
          
           $this->laduj();
          
          
          
        $variable = array(
            'punkty'=>$session->get('punkty'),
            'akcja'=>$session->get('akcja'),
            'potwor'=>$session->get('potwor'),
            'statystyki'=>$session->get('statystyki'),
            'sklep'=>$session->get('sklep'),
            'wynik3'=>$session->get('wynik3'),
            'wynik2'=>$session->get('wynik2'),
            'wynik'=>$session->get('wynik'),
            'message'=>$session->getMessage(),
            'user'=>$session->get('user'),
            'postac'=>$session->get('postac')
        );
    $szablon->szablon($variable);
}
    
public function laduj(){
         $session = Sesja::getInstance(); 
         
            //  if($_GET['cofnij']){
               //   $session->delete($_GET['unset']);
             // }
         
             if($_GET && $_GET['strona']!='wybor' && $_GET['strona']!='wyboropcji'){
              $strona= $_GET['strona'];
              call_user_func_array(array($this,$strona), array($session));
         
                   
} }
    public function logowanie($session){
       $dane=$_POST;
        if($dane){
        $logowanie=new Logowanie(new Uzytkownik($dane['login'], $dane['haslo']));
               $user=$logowanie->sprawdz();
               if($user == false) {
                   $session->setMessage('Błąd logowania');
               }else{
                   $session->setMessage('Zalogowano');
               }
        $session->setUp(array('user'=>new Uzytkownik($user)));}
    }
     public function rejestracja($session,$dane=null){
         $dane=$_POST;
         if($_POST){
               $rejestracja = new Rejestracja(new Uzytkownik($dane['login'], $_POST['haslo']));
               $sprawdz=$rejestracja->sprawdz();
               if($sprawdz==$dane['login']){
                $session->setMessage('Uzytkownik o tej nazwie juz istnieje');   
               }else{
               $rejestracja->zapisz();
               $session->setMessage('Dodano Uzytkownika');
               }
         }
               
     }
     public function wyborpostaci($session,$dane=null){
         $dane=$_POST;
         if(!empty($dane['imie'])){
             $wyborpostaci=$session->get('wyborpostaci');
             $wyborpostaci->utwoz($dane['imie']);
             $session->setMessage('Utworzono postac, wybierz postac');
         }
         elseif(isset($dane['wybor']) && empty($dane['imie'])){
                $wyborpostaci=$session->get('wyborpostaci');
                $wybor=$wyborpostaci->wybierz($dane['wybor']);
                $session->setUp(array('postac'=>new Postac\Wiedzmin($wybor)));
                $session->setMessage('Wybrano postac');}
                else{
                 $user=$session->get('user');
                 $wyborpostaci=new Wyborpostaci($user);
                 $session->setUp(array('wyborpostaci'=>$wyborpostaci));
                 $session->setUp(array('wynik'=>$wyborpostaci->pobierz()));}
     
     }
     public function ekwipunek($session,$dane=null){
         $dane=$_POST;
         if(!empty($dane['wybor'])){
            $postac=$session->get('postac');
                   $ekwipunek=$session->get('ekwipunek');
                   $ekwipunek->aktywuj($dane['wybor']);
                   if($ekwipunek->aktywnabron('bron')!=false){
                   $postac->aktywnyEkwipunek($ekwipunek->aktywnabron('bron'),'bron');}
                   if($ekwipunek->aktywnabron('zbroja')!=false){
                   $postac->aktywnyEkwipunek($ekwipunek->aktywnabron('zbroja'),'zbroja');
                   } 
         }else{
               $postac=$session->get('postac');
               $ekwipunek = new Ekwipunek($postac->Getparam()->getId());
               $showekwipunek=$ekwipunek->showekwipunek();
               $session->setUp(array('wynik'=>$showekwipunek));
               $session->setUp(array('ekwipunek'=>$ekwipunek));
         }
     }
     public function przeciwnik($session,$dane=null){
         $dane=$_POST;
         if(isset($dane['wybor'])){
             $przeciwnik= $session->get('przeciwnik');
                  $potwor= new Postac\Potwor($przeciwnik->wybranyprzeciwnik($dane['wybor']));
                  $name=$potwor->getName();
                  $session->setMessage('wybrano'.' '.$name);
                  $session->setUp(array('potwor'=>$potwor));
         }
         else{
              $przeciwnik= new Przeciwnik();
               $przeciwnicy=$przeciwnik->wszyscyprzeciwnicy();
               $session->setUp(array('przeciwnik'=>$przeciwnik));
               $session->setUp(array('wynik'=>$przeciwnicy));
         }
     }
     
     public function tura($session,$dane=null){
         $dane=$_POST;
        if(!empty($dane['wybor'])){
            $tura=$session->get('tura');
                     if($tura->getKolejg()==1){ $akcja=$tura->akcja1($dane['wybor']);  $session->setUp(array('akcja'=>$akcja));}
                     if($tura->getKolejp()==1){$akcja=$tura->akcja3();  $session->setUp(array('akcja'=>$akcja));}
                     if($tura->getKolejg()==0 && $tura->getKolejp()==0){ $akcja=$tura->losowanie();$session->setMessage($akcja); }
                     if($tura->sprawdzCzyKoniec()==0){
                         $dane['wybor']=null;
                         $tura->dodajnagroda();
                         $session->setMessage('koniec gry');
                         $postac=$session->get('postac');
                       $nowypoziom=new Nowypoziom($postac);
                       $wynik[0]=true;
                       $wynik[1]=$nowypoziom->punkty();
                       $session->setUp(array('wynik3'=>$wynik));
                    } 
        }else{
              $session->delete('wynik3');
              $postac=$session->get('postac');
              $przeciwnik=$session->get('potwor');
              $tura=new Tura();
               $tura->dodajGracza($postac);
              $tura->dodajPrzeciwnika($przeciwnik);
              $session->setMessage('Rozpocznij');
              $tura->setKolejg();
              $tura->setKolejp();
             $postac->posiadaaktwnabron();
             $session->setUp(array('tura'=>$tura));
        }
     }
     public function nowypoziom($session,$dane=null){
         $dane=$_POST;
        if(isset($dane['wybor'])){
            $nowypoziom=$session->get('nowypoziom');
            $nowypoziom->setpoints($dane['wybor']);
            $postac=$session->get('postac');
            $wynik=$postac->Getparam()->getParameters();
              $punkty=$nowypoziom->punkty();
              $session->setUp(array('punkty'=>$punkty));
              $session->setUp(array('wynik'=>$wynik));
        }else{
              $postac=$session->get('postac');
              $nowypoziom=new Nowypoziom($postac);
              $wynik=$postac->Getparam()->getParameters();
              $punkty=$nowypoziom->punkty();
              $session->setUp(array('punkty'=>$punkty));
              $session->setUp(array('nowypoziom'=>$nowypoziom));
              $session->setUp(array('wynik'=>$wynik));
        }  
     }
     public function sklep($session,$dane=null){
         $dane=$_POST;
         if(isset($dane['kupione'])){
              $sklep=$session->get('sklep');
                    $wynik=$sklep->kupno2($dane['zaznaczone']);
                        if($wynik){$session->setMessage('Zakupiono produkty');}
                        else{$session->setMessage('Masz za malo zlota');}
         }elseif(isset($dane['sprzedane'])){
                        $sklep=$session->get('sklep');
                        $sklep->sprzedaz2($dane['zaznaczone']);
                        $session->setMessage('Sprzedales produkty');
                   }else{
                    $postac=$session->get('postac');
                    $sklep=new Sklep($postac);
                    $session->setUp(array('sklep'=>$sklep));
                    $session->setUp(array('wynik'=>$sklep->dokupienia()));
                    $session->setUp(array('wynik2'=>$sklep->dosprzedania()));
                   }
     }
     public function statystyki($session,$dane=null){
         $dane=$_POST;
         if(isset($dane['staty'])){
                       $session->setMessage('Statystyki'.$dane['staty']);
                       $statystyki= new Statystyki();
                       $session->setUp(array('statystyki'=>$statystyki->statystykiwyswietl($dane['staty'])));
                   }
     }
}
