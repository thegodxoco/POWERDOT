<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PowerDot</title>
    <link rel="stylesheet" href="css/index.css">
  </head>
        <body>


            <?php
            require __DIR__ . '/vendor/autoload.php';
            use MongoDB\Client;
            //$client = new MongoDB\Client("mongodb://172.10.0.100:27017"); 
            $client = new MongoDB\Client("mongodb://127.0.0.1:27017"); 
            $collection = $client->dipositivas->diapositiva;
            if(isset( $_POST['text'])){
                $text =  $_POST['text'];
                $usuari = $_POST['usuari'];
                $nom_diapo = $_POST['nom_diapo'];
                $data = date('m-d-Y', time());
                if(!ctype_alnum($nom_diapo)){
                    echo "<div class='error'>Error nom no valid</div>";
                }else if(!ctype_alnum($usuari)){
                    echo "<div class='error'>Error usuari no valid</div>";
                
            }else{
                $result = $collection->insertOne([ 
                    'nom' => $nom_diapo,
                    'usuari' => $usuari,
                    'text' => $text,
                    'data' => $data
                ]);
                echo '<div class="ok">Presentació: '.$nom_diapo.' inserida correctament amb ID '. $result->getInsertedId().'</div>';
                }  
            }
            //inici php
           session_start();
           for($e=0;$e<count($_SESSION);$e++){
               if(isset($_SESSION["id".$e])){
                  unset($_SESSION["id".$e]);
               }
           }
           if(isset($_SESSION["error"])){
                 
                 echo "<div class='error'>".$_SESSION["error"]."</div>";
                 unset($_SESSION["error"]);
                 
           }
            ?>

            <?php
            //pujar imatges php
    if (isset(($_FILES["myFile"]))) {

    if ($_FILES["myFile"]["error"] == UPLOAD_ERR_OK) { 
        // print_r($_FILES["myFile"]);
        if($_FILES["myFile"]["type"]=="image/png" || $_FILES["myFile"]["type"]=="image/jpeg" || $_FILES["myFile"]["type"]=="image/jpg"){
           
            
        $folderLocation = "img/".$_POST["ruta"];
        if(!str_contains($folderLocation, '..')){
        if (!file_exists($folderLocation)){ 
            mkdir($folderLocation);
        }
        /*elseif(!file_exists($folderLocation."/".$_FILES["myFile"]["name"])){
            echo "<div class='error'>Error al subir la imagen</div>";
        }*/
        if(file_exists($folderLocation."/".$_FILES["myFile"]["name"])){
            echo "<div class='error'>La imagen ja exsisteix en aquesta ruta</div>";
        }else{
        move_uploaded_file($_FILES["myFile"]["tmp_name"], "$folderLocation/" . basename($_FILES["myFile"]["name"])); 
        echo '<div class="ok">Imatge insertada correctament</div>';
        }
        }else{
            echo "<div class='error'>No pots utilitzar ../ en la ruta</div>";
            }
    }else{
        echo "<div class='error'>Error no es un tipus de fitxer acceptat</div>";
    }
    }else{
        echo "<div class='error'>Error al pujar la imagen</div>";
    }
}
?>
<nav>
<ul>
    <li><h1 style="color:#fff">PowerDot</h1></li>
    <li>
        <a href="funcionament.html">Funcionament</a>
    </li>

    <li class = "active">
        <a href="index.php">Crear Presentacions</a>
    </li>
    <li>
        <a href="buscador.php">Buscar Presentacions</a>
    </li>
    
</ul>
</nav>

            
                    
                
                
                <div class="guardar">
                <h2>Guardar Presentació</h2>
                <form action= "index.php" method="post"> 
                <label for="nom_diapo">Nom presentació:</label><br>           
                <input name="nom_diapo" type="text"><br>
                <label for="usuari">Usuari:</label><br> 
                <input name="usuari" type="text"><br>
                <label for="text">Text presentació:</label><br> 
                <textarea placeholder="Introduix el codi aqui" name="text" rows=25 cols=50></textarea>
                <br>
                <input class="button" type="submit" value="Guardar"></submit>
                </form>
            </div>
                
                <div class="text">
            <h2>Introductor de text</h2>
            <form action= "controlers/indexController.php" method="post">
                <textarea placeholder="Introduix el codi aqui" id="textInput" name="text" rows=25 cols=50><?php
                if(isset($_GET["pres"])){
                    $cursor=$collection->find(['_id'=> new MongoDB\BSON\ObjectId($_GET['pres'])]);
                        foreach ($cursor as $document) {
                            //echo "<b>Nom: </b>". $document->nom ."<b> Usuari: </b>". $document->usuari;
                            echo  $document->text;
                        }
                 } else if(isset($_SESSION["textarea"])){
                echo $_SESSION["textarea"];
                unset($_SESSION["textarea"]);
                }else{
                //echo "Introduix el codi aqui";
                }
                ?></textarea>
                <br>
                <input class="button" type="submit" value="Presentar"/>
                
            </form>
            </div>
            <div class="img">
            <h2>Guardar imatge</h2>
                        <form method="POST" enctype="multipart/form-data" action="<?= $_SERVER['PHP_SELF'] ?>"> 
                            Imagen:<input type="file" name="myFile" /><br>
                            Ruta: <input type="text" name="ruta" /><br>
                            <input class="button" type="submit" name="Submit" value="Guardar" />
                        </form>
                </div>
                    
            



        </body> 
</html>