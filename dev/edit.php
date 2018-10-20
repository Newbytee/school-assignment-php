<?php
require_once('php/dbm.php');
session_start();

function sanitise($str) {
    return filter_input(INPUT_POST, $str, FILTER_SANITIZE_MAGIC_QUOTES);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
    $id = sanitise('_id');
    $team = sanitise('_team');
    $name = sanitise('_name');
    $info = sanitise('_info');
    
    try {
        $stm = $pdo->prepare('UPDATE gubbar SET team = "' . $team . '", name = "' . $name . '", info = "' . $info . '" WHERE id = ' . $id);
        $stm->execute();
    } catch (PDOException $err) {
        echo $err->getMessage();
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sparar ...</title>
    <meta http-equiv="REFRESH" content="0;index.php">
    <script>
        document.location.href = "index.php";
    </script>
</head>
<body>
</body>
</html>