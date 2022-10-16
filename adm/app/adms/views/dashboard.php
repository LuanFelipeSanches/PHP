<?php

// Redirecionar ou para o processamento quando o usuario nao acessa o arquivo index.php
if(!defined('C7E3L8K9E5')){
    //header("Location: /");
    die("Erro: Página não encontrada!<br>");
} 

echo "Dashboard<br>";
// Recuperar e imprimir as variaveis globais
echo "ID: " . $_SESSION['user_id'] . "<br>";
echo "Name: " . $_SESSION['user_name'] . "<br>";
echo "Apelido: " . $_SESSION['user_nickname'] . "<br>";
echo "E-mail: " . $_SESSION['user_email'] . "<br>";
echo "Imagem: " . $_SESSION['user_image'] . "<br>";
echo "Chave: " . $_SESSION['user_key'] . "<br><br>";

// Link redirecionando para a pagina sair
echo "<a href='".URLADM."/sair'>Sair</a>";
