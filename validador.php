<?php
$host = 'localhost';
$dbname = 'camaras';
$username = $_POST["username"];
$password = $_POST["pass"];

try {
    $dsn = "mysql:host=$host;dbname=$dbname";
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Comprueba que el usuario es valido ejecutando un SHOW TABLES en 'camaras'
    $query = "SHOW TABLES";
    $stmt = $pdo->prepare($query);
    $stmt->execute();

    // Si funciona, el usuario es valido y se redirige a inicio.php
    echo "<form id='redirect-form' method='post' action='inicio.php'>";
    echo "<input type='hidden' name='user' value='$username'>";
    echo "<input type='hidden' name='pass' value='$password'>";
    echo "</form>";
    echo "<script>document.getElementById('redirect-form').submit();</script>";
} catch (PDOException $e) {
    // Si no funciona, el usuario es invalido y se redirige a login.php, avisando del error
    echo "<form id='redirect-form' method='post' action='index.php'>";
    echo "<input type='hidden' name='error' value='1'>";
    echo "</form>";
    echo "<script>document.getElementById('redirect-form').submit();</script>";
}
?>
