<?php
require_once('php/dbm.php');
$stm = $pdo->prepare("SELECT DISTINCT team FROM gubbar");
$stm->execute();
$teams = $stm->fetchAll();
$teamsWithMembers = [];
foreach ($teams as $team) {
    $stm = $pdo->prepare('SELECT team, name, info, img FROM gubbar WHERE team="' . $team['team'] . '"');
    $stm->execute();
    array_push($teamsWithMembers, $stm->fetchAll());
}
?>

<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/gubbspel.css" rel="stylesheet">
    <title>Gubbspel</title>
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="#">Gubbspel</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toogle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Hem<span class="sr-only">(current)</span></a>
                </li>
                <?php foreach ($teams as $team) { ?>
                <li class="nav-item">
                    <a class="nav-link" href="#<?= str_replace(' ', '-', $team['team']) ?>"><?= $team['team'] ?></a>
                </li>
                <?php } ?>
            </ul>
            <form action="search.php" method="GET" class="form-inline my-2 my-lg-0">
                <input class="form-control mr-smb-2" type="text" placeholder="Sök" aria-label="Search" name="searchQuery">
                <button class="btn btn-outline-secondary my-2 my-sm-0" type="submit">Sök gubbe</button>
            </form>
        </div>
    </nav>
    <div class="jumbotron">
        <div class="container mt-3">
            <h1 class="display-3">Gubbspel!</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo dolore maxime, tempora officia! Nam molestiae quaerat consequatur nesciunt laborum molestias, sequi est, quae odio velit accusantium dolor doloribus eaque, error.</p>
            <!--<p><a class="btn btn-primary btn-lg" href="#" role="button">Learn more »</a></p>-->
        </div>
    </div>
    <main role="main" class="container">
        <?php foreach ($teams as $i => $team) { ?>
            <section class="army">
            <h1 id="<?= str_replace(' ', '-', $team['team']) ?>" > <?= $team['team'] ?></h1>
            <div class="row">
                <?php foreach ($teamsWithMembers[$i] as $teamMember) { ?>
                <div class=" d-flex align-content-stretch mb-2 col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="card">
                        <img class="card-img-top" src="img/<?= $teamMember['img'] ?>">
                        <div class="card-body">
                            <h4 class="card-title"><?= $teamMember['name'] ?></h4>
                            <p class="card-text"><?= $teamMember['info'] ?></p>
                            <a href="#" class="btn btn-secondary">Ändra</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            </section>
        <?php } ?>
    </main>
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>