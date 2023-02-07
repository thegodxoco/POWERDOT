<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/Slide.css">
    <title>Document</title>
</head>
<body>
    <?php
       // print_r($_SESSION);
        
    ?>
<div class= "diapositiva" style="height:60 %">

<?php
    //echo "<h1 class='title'>". $_SESSION[1]["titol"] ."</h1>";
    //echo "<h2 class='sub'>". $_SESSION[1]["sub"] ."</h2>";
    if($slide["tipus"]== "cover"){
        echo "<h1 class='title'>". $slide["titol"]  ."</h1>";
        echo "<h2 class='sub'>". $slide["sub"]  ."</h2>";
    }elseif($slide["tipus"]== "simple"){
        echo "<h1 class='title'>". $slide["titol"] ."</h1>";
        for($i = 0; $i<count($slide["text"]);$i++){
            echo "<p class='text'>". $slide["text"][$i] ."</p>";
    }
    }else{
        echo "<h1 class='title'>". $slide["titol"] ."</h1>";
        for($i = 0; $i<count($slide["text"]);$i++){
            echo "<p class='text'>". $slide["text"][$i] ."</p>";
    }
        echo "<img src='../img/". $slide["img"] ."'>";
    }
    
    ?>


</div>
<form action="../controlers/viewController.php" method="post">
            <button class="button" type="submit" name="accio" value="ant">Anterior</button>
            
            <button class="button" type="submit" name="accio" value="seg">Següent</button>
            <br>
            <button class="button" type="submit" name="accio" value="exit">Exit</button>

</form>

<?php 

?>


</body>
</html>

