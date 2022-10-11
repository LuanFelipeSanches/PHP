<?php

// Constante que define que o usuario esta acessando paginas internas atraves da pagina "index.php".
define('C7E3L8K9E5', true);

// Incluir o arquivo de configuracao
include_once "./config/config.php";

// Incluir o arquivo com a conexao ao banco de dados
include_once "./config/connection.php";

// Receber a url
$url = filter_input(INPUT_GET, "url", FILTER_DEFAULT);
// var_dump($url);

// Incluir a biblioteca para limpar a URL
include_once "./app/adms/lib/lib_clean_url.php";
$url_clean = cleanUrl($url);

// Converte a string em array
$url_path = explode("/", $url_clean);
// var_dump($url_path);

// Verificar se existe a posicao 1 no array
if((isset($url_path['0'])) and (!empty($url_path['0']))){
    $path_page = $url_path['0'];
}else{
    $path_page = "login";
}
// var_dump($path_page);

// Verificar se existe a posicao 2 no array
if((isset($url_path['1'])) and (!empty($url_path['1']))){
    $path_detail = $url_path['1'];
}else{
    $path_detail = "";
}
// var_dump($path_detail);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Indicar que o site possui caracteres especiais -->
    <meta charset="UTF-8">
    <title>Adm - Celke</title>
</head>

<body>
    <?php
    // Verificar se tem o nome da pagina
    if (!empty($path_page)) {
        // Verificar se existe o arquivo
        if (file_exists("app/adms/views/" . $path_page . ".php")) {
            // Carregar a pagina
            include_once "app/adms/views/" . $path_page . ".php";
        } else { // Se nao existir o arquivo, carrega a pagina de erro 
            include_once "app/adms/views/404.php";
        }
    } else { // Se nao tiver a pagina, carrega a pagina login
        include_once "app/adms/views/login.php";
    }
    ?>
</body>

</html>