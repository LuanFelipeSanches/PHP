<?php

// Redirecionar ou para o processamento quando o usuario nao acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    //header("Location: /");
    die("Erro: Página não encontrada!<br>");
}

// Criptografar a senha
//echo password_hash("123456a", PASSWORD_DEFAULT);

// Receber os dados do formulario
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Verificar se o usuario clicou no botao
if (!empty($data['SendLogin'])) {
    //var_dump($data);

    // Variavel para receber se ha erro no formulario - FALSE: nao ha erro, TRUE: ha erro no formulario
    $empty_input = false;

    // Validar o campo individual
    /*if (empty($data['username'])) {
        $empty_input = true;
        echo "<p style='color: #f00;'>Erro: Necessário preencher o campo usuário!</p>";
    }
    if (empty($data['password'])) {
        $empty_input = true;
        echo "<p style='color: #f00;'>Erro: Necessário preencher o campo senha!</p>";
    }*/

    // Validar todos os campos
    // Retirar o espaco em branco
    $data = array_map('trim', $data);

    // Acessa o IF quando houver campo vazio
    if (in_array("", $data)) {
        $empty_input = true;
        echo "<p style='color: #f00;'>Erro: Necessário preencher todos os campos!</p>";
    }


    // Acessa o IF quando nao ha erro no formulario
    if (!$empty_input) {
        // QUERY para pesquisar o usuario no banco de dados
        $username = mysqli_real_escape_string($conn, $data['username']);
        $query_user = "SELECT id, name, nickname, email, password, image, adms_sits_user_id 
                FROM adms_users
                WHERE email = '$username' 
                OR username = '$username'
                LIMIT 1";

        // Executar a QUERY
        $result_user = mysqli_query($conn, $query_user);

        // Verificar se encontrou usuario no BD
        if (($result_user) and ($result_user->num_rows != 0)) {

            // Ler o registro recuperado do banco de dados
            $row_user = mysqli_fetch_assoc($result_user);

            // Verificar se o perfil so usuario esta ativo
            if ($row_user['adms_sits_user_id'] != 1) {
                echo "<p style='color: #f00;'>Erro: Necessário confirmar o e-mail!</p>";
            } elseif (password_verify($data['password'], $row_user['password'])) { // Verificar se a senha digita no formulario he igual a senha que esta salva no BD
                //echo "<p style='color: green;'>Login realizado com sucesso!</p>";

                // Destruir os dados da variavel $data
                unset($data);

                // Criar as variaveis globais com as informacoes do usuario
                $_SESSION['user_id'] = $row_user['id'];
                $_SESSION['user_name'] = $row_user['name'];
                $_SESSION['user_nickname'] = $row_user['nickname'];
                $_SESSION['user_email'] = $row_user['email'];
                $_SESSION['user_image'] = $row_user['image'];
                $_SESSION['user_key'] = password_hash($row_user['id'], PASSWORD_DEFAULT);

                // Criar a URL de destino
                $url_destination = URLADM . "/dashboard";

                // Redirecionar o usuario
                header("Location: $url_destination");
            } else {
                echo "<p style='color: #f00;'>Erro: Usuário ou senha inválida!</p>";
            }
        } else {
            echo "<p style='color: #f00;'>Erro: Usuário ou senha inválida!</p>";
        }
    }
}

// Verificar se existe a mensagem na sessao
if (isset($_SESSION['msg'])) {
    // Imprimir a mensagem
    echo $_SESSION['msg'];
    // Destroi a variavel global que possui a mensagem
    unset($_SESSION['msg']);
}
?>
<h1>Login</h1>

<!-- Recebe a mensagem do JavaScript -->
<span id="msg"></span>

<!-- Inicio formulario -->
<form method="POST" action="" id="form-login">
    <?php
    // Manter os dados no campo
    $username = "";
    if (isset($data['username'])) {
        $username = $data['username'];
    }
    ?>
    <label>Usuário</label>
    <!-- Criar o campo usuario -->
    <input type="text" name="username" id="username" placeholder="Digite o usuário ou e-mail" value="<?php echo $username; ?>" autofocus required><br><br>

    <?php
    // Manter os dados no campo
    $password = "";
    if (isset($data['password'])) {
        $password = $data['password'];
    }
    ?>
    <label>Senha</label>
    <!-- Criar o campo senha -->
    <input type="password" name="password" id="password" placeholder="Digite a senha" value="<?php echo $password; ?>" required><br><br>

    <input type="submit" name="SendLogin" value="Acessar">
</form>
<!-- Fim formulario -->

<p>
    <a href="<?php echo URLADM . '/login_new_user'; ?>">Cadastrar</a> - <a href="<?php echo URLADM . '/login_recover_password'; ?>">Esqueceu a senha</a>
</p>

Usuário: cesar@celke.com.br<br>
Senha: 123456a