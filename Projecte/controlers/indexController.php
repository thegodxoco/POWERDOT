<?php

namespace Controller;
require_once  '../classes/SlideFactory.php';
use Slide\SlideFactory;
require_once  '../classes/CoverSlide.php';
use Slide\CoverSlide;
require_once '../classes/SimpleContentSlide.php';
use Slide\SimpleContentSlide;
require_once '../classes/ImgSlide.php';
use Slide\ImgSlide;
session_start();
    if(isset($_POST['text'])){
        $text = $_POST['text'];
        $_SESSION["textarea"]=$text; 
        $linia=explode( "\n", $text );
        $slidefactori = new SlideFactory($linia);

        $covers = $slidefactori->getCover();
        //for(){
           // $cov = new CoverSlide($covers[$i]);
           $bol=true;
           if($covers!= null){
          if(count($covers)>=1){ 
       for($i = 0;$i<count($covers);$i++){
           if(str_contains($covers[$i][0],"[cover]")){
                $cov = new CoverSlide($i, $covers[$i]);
                $_SESSION["id".$i]["titol"] =$cov->getTitol();
                $_SESSION["id".$i]["sub"] =$cov->getSubtitol();
                $_SESSION["id".$i]["tipus"] = "cover";
           }elseif(str_contains($covers[$i][0],"[simple]")){
                 $sim = new SimpleContentSlide($i, $covers[$i]);
                 $_SESSION["id".$i]["titol"] =$sim->getTitol();
                 $_SESSION["id".$i]["text"] =$sim->getText();
                 $_SESSION["id".$i]["tipus"] = "simple";
                 //
           }elseif(str_contains($covers[$i][0],"[img]")){
                    $sim = new ImgSlide($i, $covers[$i]);
                    $_SESSION["id".$i]["titol"] =$sim->getTitol();
                    $_SESSION["id".$i]["text"] =$sim->getText();
                    $_SESSION["id".$i]["img"] =$sim->getImg();
                    $_SESSION["id".$i]["tipus"] = "img";
                    //
           }else{
            $_SESSION["error"]="error al leer el tipo de diapositiva: ".$covers[$i][0];
            header('Location: ../index.php');
            $bol = false;
           }
        }

        }else{
            $_SESSION["error"]="error al leer el tipo de diapositiva: ".$covers[$i][0];
            header('Location: ../index.php');
            $bol = false;
               
       }
    }else{
        $_SESSION["error"]="Texto no valido en la diapositiva: ".$covers[$i][0];
            header('Location: ../index.php');
            $bol = false;
    }
        //$cov = new CoverSlide($slidefactori->getCover());

        //}
        if($bol){
            $_SESSION["id"]=0;
            $slide = $_SESSION["id".$_SESSION["id"]];
            include_once '../views/SlideView.php';
        }
       
        //include_once '../views/SimpleContentSlideView.php';
        //require __DIR__ . '../views/CoverSlideView.php';
}
?>
      
