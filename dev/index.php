<?php
session_start();
require_once('php/dbm.php');
$stm = $pdo->prepare("SELECT DISTINCT team FROM gubbar");
$stm->execute();
$teams = $stm->fetchAll();
$teamsWithMembers = [];
if (!isset($_GET['team'])) {
    foreach ($teams as $team) {
        $stm = $pdo->prepare('SELECT team, name, info, img FROM gubbar WHERE team="' . $team['team'] . '"');
        $stm->execute();
        array_push($teamsWithMembers, $stm->fetchAll());
    }
} else {
    $query = filter_input(INPUT_GET, 'team', FILTER_SANITIZE_MAGIC_QUOTES);
    $stm = $pdo->prepare('SELECT team, name, info, img FROM gubbar WHERE team="' . str_replace('_', ' ', $query) .'"');
    $stm->execute();
    array_push($teamsWithMembers, $stm->fetchAll());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = filter_input(INPUT_POST, '_username', FILTER_SANITIZE_MAGIC_QUOTES);
    $password = filter_input(INPUT_POST, '_password', FILTER_SANITIZE_MAGIC_QUOTES);
    $stm = $pdo->prepare('SELECT username FROM accounts WHERE username="' . $username . '" AND password="' . $password. '"');
    $stm->execute();
    $username = $stm->fetch();
    $_SESSION['user'] = $username['username'];
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
                <li class="nav-item <?php if (!isset($_GET['team'])) echo 'active'; ?>">
                    <a class="nav-link" href="index.php">Hem<span class="sr-only">(current)</span></a>
                </li>
                <?php foreach ($teams as $team) { ?>
                <li class="nav-item <?php if (isset($_GET['team'])) if (str_replace('_', ' ', $_GET['team']) === $team['team']) echo 'active' ?>">
                    <a class="nav-link" href="index.php?team=<?= str_replace(' ', '_', $team['team']) ?>"><?= $team['team'] ?></a>
                </li>
                <?php } ?>
            </ul>
            <?php
            if (!isset($_SESSION['user'])) {
                echo '<button type="button" class="btn btn-dark" data-toggle="modal" data-target="#loginWindow">Logga in</button>';
            } else { ?>
                <p class="nav text-muted mr-2">Inloggad som <?= $_SESSION['user'] ?></p>
                <button data-toggle="modal" data-target="#addItemWindow" class="btn btn-dark">Lägg till gubbe</button>
                <a href="logout.php" type="button" class="btn btn-dark">Logga ut</a>
            <?php } ?>
            <form action="search.php" method="get" class="form-inline my-2 my-lg-0">
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
        <?php
        $iterator = 0;
        foreach ($teams as $i => $team) { 
        if (!isset($_GET['team']) || isset($_GET['team']) && str_replace('_', ' ', $_GET['team']) === $team['team']) {
            if (isset($_GET['team']) && str_replace('_', ' ', $_GET['team']) === $team['team']) {
                $i = 0;
            }
            ?>
                <section class="army">
                    <h1 id="<?= str_replace(' ', '-', $team['team']) ?>" > <?= $team['team'] ?></h1>
                    <div class="row">
                        <?php
                        foreach ($teamsWithMembers[$i] as $teamMember) { 
                        $iterator++;
                        ?>
                        <div class=" d-flex align-content-stretch mb-2 col-12 col-md-6 col-lg-4 col-xl-3">
                            <div class="card">
                                <img class="card-img-top" src="img/<?= $teamMember['img'] ?>">
                                <div class="card-body">
                                    <h4 class="card-title"><?= $teamMember['name'] ?></h4>
                                    <p class="card-text"><?= $teamMember['info'] ?></p>
                                    <?php if(isset($_SESSION['user'])) { 
                                        echo '<button data-toggle="modal" data-target="#edit-window-' . $iterator . '" class="btn btn-secondary">Ändra</button>'; 
                                        echo '<button data-toggle="modal" data-target="#delete-window-' . $iterator . '" class="btn btn-secondary ml-2">Ta bort</button>'; ?>
                                        <div class="modal fade" id="edit-window-<?= $iterator ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Redigera <?= $teamMember['name'] ?></h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" action="edit.php" method="post">
                                                            <fieldset>
                                                                <div class="form-group d-none">
                                                                    <input class="form-control" placeholder="ID" type="text" name="_id" value="<?= $teamMember['id'] ?>" required><br>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input class="form-control" placeholder="Lag" type="text" name="_team" value="<?= $teamMember['team'] ?>" required><br>
                                                                </div>
                                                                <div class="form-group">
                                                                    <input class="form-control" placeholder="Namn" type="text" name="_name" value="<?= $teamMember['name'] ?>" required><br>
                                                                </div>
                                                                <div class="form-group">
                                                                    <textarea class="form-control" placeholder="Information" rows="10" type="text" name="_info" required><?= $teamMember['info'] ?></textarea><br>
                                                                </div>
                                                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Spara">
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="delete-window-<?= $iterator ?>" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Ta bort <?= $teamMember['name'] ?>?</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form role="form" action="delete.php" method="post">
                                                            <fieldset>
                                                                <div class="form-group d-none">
                                                                    <input class="form-control" placeholder="ID" type="text" name="_id" value="<?= $teamMember['id'] ?>" required><br>
                                                                </div>
                                                                <input class="btn btn-danger" type="submit" value="Ta bort">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Stäng</button>
                                                            </fieldset>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </section>
        <?php } } ?>
    </main>
    <div class="modal fade" id="loginWindow" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Logga in</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="index.php" method="post">
                        <fieldset>
                            <div class="form-group">
                                <input class="form-control" placeholder="Användarnamn" type="text" name="_username" required><br>
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Lösenord" type="password" name="_password" required><br>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Logga in">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php if (isset($_SESSION['user'])) { ?>
    <div class="modal fade" id="addItemWindow" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Lägg till gubbe</h4>
                </div>
                <div class="modal-body">
                    <form role="form" action="add.php" method="post" enctype="multipart/form-data">
                        <fieldset>
                            <div class="form-group">
                                <div class="form-group">
                                    <input class="form-control-file" type="file" name="_image" id="fileToUpload">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Lag" type="text" name="_team" required><br>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Namn" type="text" name="_name" required><br>
                                </div>
                                <div class="form-grdoup">
                                    <textarea class="form-control" placeholder="Information" rows="10" type="text" name="_info" required></textarea><br>
                                </div>
                                <input class="btn btn-lg btn-success btn-block" type="submit" value="Lägg till">
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
    <script src="js/jquery-3.2.1.slim.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>