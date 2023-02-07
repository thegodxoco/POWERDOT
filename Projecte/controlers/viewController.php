<?php
namespace Controller;
//session_start();
session_start();

if(isset($_POST['accio'])){
            if ($_POST['accio'] == "seg") {
                if(isset($_SESSION["id".($_SESSION["id"]+1)])){
                $_SESSION["id"]=$_SESSION["id"]+1;
                }else{
                    echo "<div class='limit'>No hi han mes diapositivas</div>";
                }
           }elseif ($_POST['accio'] == "ant") {
            if(isset($_SESSION["id".($_SESSION["id"]-1)])){
                $_SESSION["id"]=$_SESSION["id"]-1;
            }else{
                echo "<div class='limit'>No hi han mes diapositivas</div>";
            }
           }elseif($_POST['accio'] == "exit"){
            header('Location: ../index.php');
           }
       }
       $slide = $_SESSION["id".$_SESSION["id"]];
       include_once '../views/SlideView.php';

?>