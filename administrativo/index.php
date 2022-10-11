<?php
//Receber a url
$url = filter_input(INPUT_GET, "url", FILTER_DEFAULT);

//Converter a string em array
$url_path = explode("/", $url);

//Verificar se existe a posicao 1 do array
if ((isset($url_path['0'])) and (!empty($url_path['0']))) {
    $path_page = $url_path['0'];
} else {
    $path_detail = "login";
}
//Verificar se existe a posicao 2 do array
if ((isset($url_path['1'])) and (!empty($url_path['1']))) {
    $path_detail = $url_path['1'];
} else {
    $path_detail = "";
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adm</title>
</head>

<body>
    <?php
    //Caso a pagina não existe, vai para login
    if (!empty($path_page)) {
        if (file_exists("app/adms/views/" . $path_page . ".php")) {
            include_once "app/adms/views/" . $path_page . ".php";
        } else {
            include_once "app/adms/views/login.php";
        }
    } else {
        include_once "app/adms/views/login.php";
    }
    ?>
</body>

</html>