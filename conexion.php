<?php
// conexion.php
function getConnection() {
    $host = 'localhost';
    $dbname = 'shgabriel';
    $user = 'root';
    $password = '';

    $dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
    $pdo = new PDO($dsn, $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}
?>
