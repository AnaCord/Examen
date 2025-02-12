<?php
require_once('config.php');
try{
    $conn= new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    echo "Connected to $dbname at $host successfully.";
    $consulta= "SELECT * FROM film
                LIMIT 5";
    $stmt=$conn->query($consulta);
    $peliculas=$stmt->fetchAll(PDO::FETCH_ASSOC);


    }catch(PDOException $pe){
die(" Could not connect to the database $dbname :" . $pe->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <title>Los Primeros 5</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container-md">
    <h1 style="...">Cinco Peliculas </h1>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



    <div class="row">
        <?php foreach ($peliculas as $pelicula) { ?>
        <div class="col-md-4 mb-4">
            <div class="card" style="width: 18rem;">
                <img src="..." class="card-img-top" alt="Imagen del Usuario">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $pelicula['title'] ?></h5>
                    <p><?php echo $pelicula['description']?></p>
                    <p><b>Release Year: </b><?php echo $pelicula['release_year']?></p>
                    <p><b>Special Features: </b><?php echo $pelicula['special_features']?></p>
                    <a href="#" class="btn btn-primary">Ver detalles</a>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>

</div>




</body>

</html>