<?php

// Redirecionar ou para o processamento quando o usuario nao acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    //header("Location: /");
    die("Erro: Página não encontrada!<br>");
}

//Criptografar a senha
//password_hash("123456a",PASSWORD_DEFAULT);

//Recebendo os dados do formulario
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);


//Verificar se o usuario clicou no botão
if (!empty($data['SendLogin'])) {
    var_dump($data);
}
?>

<form method="POST" action="">
    <label>Usuário</label>
    <input type="text" name="usurname" placeholder="Digite o usuário ou e-mail" autofocus required><br><br>
    <label>Senha</label>
    <input type="password" name="password" placeholder="Digite a senha" required><br><br>

    <input type="submit" name="SendLogin" value="Acessar">
</form>