<?php
namespace Slide;
require_once  '../classes/CoverSlide.php';
use Slide\CoverSlide;
class SlideFactory{
    public $r;
    public function __construct($a){
     $this->build($a);
     //print_r($a);
    }
    public function build($all){
        $cont = 0; 
        $last = 0;
        //
        $id = 0;
        
        
        for($i = 0;$i<count($all);$i++){
            $cont++;
            if(str_contains($all[$i],">>>")){
              $pr[$id] = array_slice($all,$last,$cont);
              //guardem a r
              $last = $last+$cont;
              $id++;
              $cont=0;
            }
            
        }
        $this->r= $pr;
       /* foreach ($all as $valor) {
            //detectar tipo diapositiva gurdar s o guarda r dependiendo del tipo
            //solucionar 
            $cont++;
            if($valor===">>>"){
              $pr[$id] = array_slice($all,$last,$cont);
              //guardem a r
              $this->r= $pr;

              $last = $cont+1;
              $id++;
              $cont=0;
            }
            
            
        }*/
       
        
    }
    
    public function getCover(){
        return $this->r;
    }
   
}