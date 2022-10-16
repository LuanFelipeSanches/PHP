<?php

// Redirecionar ou para o processamento quando o usuario nao acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    //header("Location: /");
    die("Erro: Página não encontrada!<br>");
}

//True - Apresentar a mensagem de alerta com o erro
//False - Nao apresentar a mensagem de alerta com o erro
ini_set('display_errors', true);

// Criar a constante global
// Constante com o endereco do site
define("URLSITE", "http://localhost/celke");

// Constante com o endereco do administrativo
define("URLADM", "http://localhost/celke/adm");

// Constante com o e-mail do administrador
define("EMAIL", "cesar@celke.com.br");

// Credenciais do banco de dado
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "celke");
define("DBPORT", 3306);
