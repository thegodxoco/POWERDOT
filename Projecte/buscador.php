<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/buscador.css">
    <title>Document</title>
</head>
<body>
<nav>
<ul>
    <li><h1 style="color:#fff">PowerDot</h1></li>
    <li>
        <a href="funcionament.html">Funcionament</a>
    </li>
    <li >
        <a href="index.php">Crear Presentacions</a>
    </li>
    <li class = "active">
        <a href="buscador.php">Buscar Presentacions</a>
    </li>
    
</ul>
</nav>
<div>

</form>
<form action= "buscador.php" method="post"> 
        <label for="usuari"><b>Filtrar per usuari</b></label>          
            <input class="usuari" name="usuari" type="text"><br> 
        <label for="data"><b>Filtrar per data  </b></label>         
            <input class="usuari" name="data" type="text">
            <input class="button" type="submit" value="Filtrar"></submit>
        </form>
<div>
    <table>
        <tr>
            <th><b>Nom</b></th>
            <th><b>Usuari</b></th>
            <th><b>Data</b></th>
            <th><b>Editar</b></th>
        </tr>
        
    <?php
    require __DIR__ . '/vendor/autoload.php';
                    
    use MongoDB\Client;
        //$client = new MongoDB\Client("mongodb://127.10.0.100:27017"); 
        $client = new MongoDB\Client("mongodb://127.0.0.1:27017"); 
        
        $collection = $client->dipositivas->diapositiva; 

         if(isset($_POST['usuari'])){
        $usuari = $_POST['usuari'];
        $data = $_POST['data'];
        //$cursor=$collection->find(['usuari'=> $usuari]); 
        $cursor=$collection->find(['usuari'=> new MongoDB\BSON\Regex($usuari),'data'=> new MongoDB\BSON\Regex($data)]); 
        foreach ($cursor as $document) {
            
            echo "<tr><td>". $document->nom ."</td><td>". $document->usuari."</td><td>".$document->data."</td><td><a href='index.php?pres=". $document->_id  ."'>Ver</a></td></tr>";
         
        }
    }else{
        $cursor=$collection->find(); 
        $i = 0;
        foreach ($cursor as $document) {
            echo "<tr><td>". $document->nom ."</td><td>". $document->usuari."</td><td>".$document->data."</td><td><a href='index.php?pres=". $document->_id  ."'>Ver</a></td></tr>";
           
          //$text[$i]=$document->text;
          //$i++;
        }

    }
    ?>
       

</div>
</div>  

</body>
</html>