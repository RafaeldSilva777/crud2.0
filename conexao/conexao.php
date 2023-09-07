<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "biblioteca";


// Estabelece a conexão usando mysqli
$conn = new mysqli($host, $username, $password, $database);

// Verifica se houve um erro na conexão
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

// Retorna a conexão para ser usada em outras partes do seu código
return $conn;
?>