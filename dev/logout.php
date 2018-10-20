<?php
session_start();
unset($_SESSION['user']);
?>
<!DOCTYPE html>
<html lang="sv">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Loggar ut ...</title>
    <meta http-equiv="REFRESH" content="0;index.php">
    <script>
        document.location.href = "index.php";
    </script>
</head>
<body>
</body>
</html>