<?php
namespace Slide;
require_once  'Slide.php';
use Slide\Slide;

class ImgSlide extends Slide{
public $titol;
public $text;
public $img;

public function __construct($id, $all){
       //echo $all[1];
       if(substr($all[1],0,1)=="="){
       $this->titol= substr($all[1], 1);
       }else{
              $_SESSION["error"]="error en la diapositiva tipo img";
             header('Location: ../index.php');
       }
       parent::__construct($id);
       $textcount=0;

       for($i = 2; $i< count($all)-1;$i++){
       if(substr($all[$i], 0,1)=== "*"){
              
        $this->text[$textcount]=substr($all[$i],1);
        $textcount++;
       }elseif(substr($all[$i],0,1)==="$"){
        $this->img=substr($all[$i],1);
       
       
    }else{
       $_SESSION["error"]="error en la diapositiva tipo img";
              header('Location: ../index.php');
       }
       
       }
      
}

public function getTitol(){
       return $this->titol;
}
public function getText(){
       return $this->text;
}
public function getImg(){
    return $this->img;
}



}