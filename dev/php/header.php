<?php
require_once('dbm.php');
$stm = $pdo->prepare('SELECT DISRINCT team FROM gubbar');
$stm->execute();
$teams = $stm->fetchAll();
?>

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