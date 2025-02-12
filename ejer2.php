<?php
require_once('config.php');
    try{
    $conn= new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    echo "Connected to $dbname at $host successfully.";
    $consulta= "SELECT * FROM category
                ORDER BY category_id DESC
                LIMIT 5";
    $stmt=$conn->query($consulta);
    $categorias=$stmt->fetchAll(PDO::FETCH_ASSOC);


    }catch(PDOException $pe){
    die(" Could not connect to the database $dbname :" . $pe->getMessage());
}

if($_SERVER["REQUEST_METHOD"] == "POST"){ //el metodo post es para enviar solicitud
    $name =$_POST["name"] ?? null;   //decalaracion de variable que almacenara el nombre proveniente del formulario


    if($name){
        $sql = "INSERT INTO category (name, last_update) VALUES (:name, NOW())"; //el now adquiere/registra la hora y fecha donde se ejecuta la consulta
        $stmt = $conn->prepare($sql); //en formularios se utiliza prepare para evitar ser victima de inyeccion de sql
        $stmt->execute([
            "name" => $name
        ]); // array asociativo
        echo "Categoria agregado correctamente";
        echo $_SERVER["REMOTE_ADDR"]; //usado para saber la ip remoto
    } else{
        echo "Todos los campos son obligatorios.";

    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"

    <title>Examen Ejer 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<h1 class="text-center">Agregado de Categoria</h1>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>


<!--FORMULARIO-->
<div class="container-md">
    <form method="post">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre de la nueva Categoría</label>
            <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <button type="submit" class="btn btn-primary">Enviar</button>

        </div>

    </form>


</div>



<div class="container-md">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Categoria</th>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($categorias as $categoria) { ?> <!-- Recorre todos los registros del arreglo. Itera sobre un array llamado $aulass. En cada iteración, asigna el valor actual a la variable $aulas.*/-->
            <tr>
                <td><?php echo $categoria['category_id']; ?></td>
                <td><?php echo $categoria['name']; ?></td>

            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>




</body>

</html>



