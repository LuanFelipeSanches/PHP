<?php

// Redirecionar ou para o processamento quando o usuario nao acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    //header("Location: /");
    die("Erro: Página não encontrada!<br>");
}

// Destroi as sessoes do usuario logado
unset($_SESSION['user_id'], $_SESSION['user_name'], $_SESSION['user_nickname'], $_SESSION['user_email'], $_SESSION['user_image'], $_SESSION['user_key']);

// Criar a mensagem de sucesso e atribuir para variavel global
$_SESSION['msg'] = "<p style='color: green;'>Deslogado com sucesso!</p>";

// Criar a URL de destino
$url_destination = URLADM . "/login";

// Redirecionar o usuario
header("Location: $url_destination");
