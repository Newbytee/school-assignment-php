<?php
require_once('php/dbm.php');
session_start();

function sanitise($str) {
    return filter_input(INPUT_POST, $str, FILTER_SANITIZE_MAGIC_QUOTES);
}

function checkIdentical($name, $imageNames) {
    foreach ($imageNames['img'] as $imageName) {
        if ($imageName === $name) {
            return true;
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['user'])) {
    $uploadDir = 'img/';
    $generatedName = uniqid('uploaded-');
    $_FILES['_image']['name'] = $generatedName;
    $uploadFile = $uploadDir . basename($_FILES['_image']['name']);
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $check = $_FILES['_image']['size'];
    
    if (!$check) {
        echo 'Filen är inte en bild';
        exit();
    }
    
    if (file_exists($uploadFile)) {
        echo 'Filen finns redan';
        exit();
    }
    
    if ($_FILES['_image']['size'] > 2000000) {
        echo 'Filen är för stor';
    }
    
    if (move_uploaded_file($_FILES['_image']['tmp_name'], $uploadFile)) {
        echo 'Bilduppladdning lyckades';
        
    } else {
        echo 'Ett fel inträffade när bildfilen skulle laddas upp.';
        exit();
    }
    
    $id = sanitise('_id');
    $team = sanitise('_team');
    $name = sanitise('_name');
    $info = sanitise('_info');
    $query = 'INSERT INTO gubbar (team, name, info, img) VALUES ("' . $team . '", "' . $name . '", "' . $info . '", "' . basename($_FILES['_image']['name']) . '")';
    try {
        $stm = $pdo->prepare($query);
        $stm->execute();
    } catch (PDOException $err) {
        echo $err->getMessage();
        var_dump($query);
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