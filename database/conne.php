<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "gerenciadorprod5";
try {
  $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
  echo "não entrou" . $e->getMessage();
}
?>