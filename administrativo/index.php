<?php
$path_page = "login";
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