<?php
namespace Slide;
require_once  'Slide.php';
use Slide\Slide;

class CoverSlide extends Slide{
public $titol;
public $subtitol;
public $id;
public function __construct($id, $text){
      // echo count($text);
       if(count($text)!==4){
              $_SESSION["error"]="error en la diapositiva tipo cover";
              header('Location: ../index.php');
       }else{
              if(substr($text[1],0,1)=="="){
                     $this->titol= substr($text[1], 1);
              }else{
                     $_SESSION["error"]="error en la diapositiva tipo cover";
                     header('Location: ../index.php');
              }
             if(substr($text[2],0,2)=="=="){
                     $this->subtitol = substr($text[2],2);
             }else{
              $_SESSION["error"]="error en la diapositiva tipo cover";
                     header('Location: ../index.php');
             }
              
              parent::__construct($id);
       }
       
       
             // $_SESSION[$this->id ]["titol"] = $this->titol;
             // $_SESSION[$this->id ]["sub"] = $this->subtitol;
}

public function getTitol(){
       return $this->titol;
}
public function getSubtitol(){
       return $this->subtitol;
}

}