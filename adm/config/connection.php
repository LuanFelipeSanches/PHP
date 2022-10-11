<?php

// Redirecionar ou para o processamento quando o usuario nao acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    //header("Location: /");
    die("Erro: Página não encontrada!<br>");
}

$dbhost = DBHOST;
$dbuser = DBUSER;
$dbpass = DBPASS;
$dbname = DBNAME;
$dbport = DBPORT;

// Conexao com o banco de dados utilizado a porta
// $conn = mysqli_connect($dbhost . ":" . $dbport, $dbuser, $dbpass, $dbname);

// Conexao com o banco de dados nao utilizado a porta
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if ($conn) {
    echo "Conexão realizada com sucesso<br>";
} else {
    die("Erro: Por favor tente novamente. Caso o problema persista, entre em contato o administrador " . EMAIL . "!<br>");
}
