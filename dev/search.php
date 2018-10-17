<?php
require_once('php/dbm.php');
$query = filter_input(INPUT_GET, 'searchQuery', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
$stm = $pdo->prepare('SELECT team, name, info, img FROM gubbar WHERE name LIKE "%' . $query . '%" OR team LIKE "%' . $query . '%" OR info LIKE "%' . $query . '%"');
$stm->execute();
$results = $stm->fetchAll();
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sök - Gubbspel</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/gubbspel.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="index.php">Gubbspel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toogle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Hem<span class="sr-only">(current)</span></a>
                </li>
            </ul>
            <form action="search.php" method="GET" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-smb-2" type="text" placeholder="Sök" aria-label="Search" name="searchQuery">
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Sök gubbe</button>
            </form>
        </div>
    </nav>
    <div class="jumbotron">
        <div class="container mt-3">
            <h1 class="display-3">Sökresultat för "<?= filter_input(INPUT_GET, 'searchQuery', FILTER_SANITIZE_FULL_SPECIAL_CHARS) . '"' ?></h1>
            <!--<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>-->
        </div>
    </div>
    <main role="main" class="container">
        <div class="row">
        <?php
        if (count($results) !== 0) {
            foreach ($results as $result) { ?>
                <div class="d-flex align-content-stretch mb-2 col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="card">
                        <img class="card-img-top" src="img/<?= $result['img'] ?>">
                        <div class="card-body">
                            <h4 class="card-title"><?= $result['name'] ?></h4>
                            <p class="card-text"><?= $result['info'] ?></p>
                            <a href="#" class="btn btn-secondary">Ändra</a>
                        </div>
                    </div>
                </div>
        <?php 
            } 
        } else {
            echo 'Inga resultat';
        }
        ?>
        </div>
    </main>
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>