<?php

// Redirecionar ou para o processamento quando o usuario nao acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    //header("Location: /");
    die("Erro: Página não encontrada!<br>");
}

// Recebe a mensagem de sucesso ou erro
$msg = "";

// Receber os dados do formulario
$data = filter_input_array(INPUT_POST, FILTER_DEFAULT);

// Verificar se o usuario clicou no botao
if (!empty($data['AddNewUser'])) {

    // Variavel para receber se ha erro no formulario - FALSE: nao ha erro, TRUE: ha erro no formulario
    $empty_input = false;

    // Validar todos os campos
    // Retirar o espaco em branco
    $data = array_map('trim', $data);

    // Acessa o IF quando houver campo vazio
    if (in_array("", $data)) {
        $empty_input = true;
        $msg = "<p style='color: #f00;'>Erro: Necessário preencher todos os campos!</p>";
    } elseif (stristr($data['name'], "'")) {
        $empty_input = true;
        $msg = "<p style='color: #f00;'>Erro: Caracter ( ' ) utilizado no campo nome inválido!</p>";
    } elseif (stristr($data['name'], '"')) {
        $empty_input = true;
        $msg = '<p style="color: #f00;">Erro: Caracter ( " ) utilizado no campo nome inválido!</p>';
    } elseif (stristr($data['email'], "'")) {
        $empty_input = true;
        $msg = "<p style='color: #f00;'>Erro: Caracter ( ' ) utilizado no campo e-mail inválido!</p>";
    } elseif (stristr($data['email'], '"')) {
        $empty_input = true;
        $msg = '<p style="color: #f00;">Erro: Caracter ( " ) utilizado no campo e-mail inválido!</p>';
    } elseif (stristr($data['email'], " ")) {
        $empty_input = true;
        $msg = "<p style='color: #f00;'>Erro: Proibido utilizar espaço em branco no campo e-mail!</p>";
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $empty_input = true;
        $msg = "<p style='color: #f00;'>Erro: E-mail inválido!</p>";
    } elseif (stristr($data['password'], "'")) {
        $empty_input = true;
        $msg = "<p style='color: #f00;'>Erro: Caracter ( ' ) utilizado no campo senha inválido!</p>";
    } elseif (stristr($data['password'], '"')) {
        $empty_input = true;
        $msg = '<p style="color: #f00;">Erro: Caracter ( " ) utilizado no campo senha inválido!</p>';
    } elseif (stristr($data['password'], " ")) {
        $empty_input = true;
        $msg = "<p style='color: #f00;'>Erro: Proibido utilizar espaço em branco no campo senha!</p>";
    } elseif (strlen($data['password']) < 6) {
        $empty_input = true;
        $msg = "<p style='color: #f00;'>Erro: A senha deve ter no mínimo 6 caracteres!</p>";
    } elseif (!preg_match('/^(?=.*[0-9])(?=.*[a-zA-Z])[a-zA-Z0-9]{6,}$/', $data['password'])) {
        $empty_input = true;
        $msg = "<p style='color: #f00;'>Erro: A senha deve ter letras e números!</p>";
    }

    // Acessa o IF quando nao ha erro no formulario
    if (!$empty_input) {
        $format_a = '"!@#$%*()+{[}];:,\\\'<>°ºª';
        $format_b = '                            ';
        $data['name'] = strtr($data['name'], $format_a, $format_b);

        // Evitar SQL Injection
        $name = mysqli_real_escape_string($conn, $data['name']);
        $email = mysqli_real_escape_string($conn, $data['email']);
        $password = mysqli_real_escape_string($conn, $data['password']);

        // Criptografar a senha
        $password_encrypted = password_hash($password, PASSWORD_DEFAULT);

        // QUERY para cadastrar o usuario no banco de dados
        $query_user = "INSERT INTO adms_users (name, email, username, password, created) VALUES ('$name', '$email', '$email', '$password_encrypted', NOW())";

        // Executar a QUERY
        mysqli_query($conn, $query_user);

        // Verificar se cadastrou o usuario no BD
        if (mysqli_insert_id($conn)) {
            $msg = "<p style='color: green;'>Cadastrado realizado com sucesso!</p>";
            // Destruir os dados do formulario
            unset($data);

            // Criar a mensagem de sucesso e atribuir para variavel global
            $_SESSION['msg'] = "<p style='color: green;'>Cadastrado realizado com sucesso!</p>";

            // Criar a URL de destino
            $url_destination = URLADM . "/login";

            // Redirecionar o usuario
            header("Location: $url_destination");
        } else {
            $msg = "<p style='color: #f00;'>Erro: Cadastrado não realizado com sucesso!</p>";
        }
    }
}
?>

<h1>Novo Usuário</h1>

<span id="msg"></span>

<?php
if (!empty($msg)) {
    echo $msg;
    unset($msg);
}
?>

<!-- Inicio formulario -->
<form method="POST" action="" id="form-new-user">
    <?php
    // Manter os dados no campo
    $name = "";
    if (isset($data['name'])) {
        $name = $data['name'];
    }
    ?>
    <label>Usuário</label>
    <!-- Criar o campo nome usuario -->
    <input type="text" name="name" id="name" placeholder="Digite o nome completo" value="<?php echo $name; ?>" autofocus required><br><br>

    <?php
    // Manter os dados no campo
    $email = "";
    if (isset($data['email'])) {
        $email = $data['email'];
    }
    ?>
    <label>E-mail</label>
    <!-- Criar o campo email -->
    <input type="email" name="email" id="email" placeholder="Digite o seu melhor e-mail" value="<?php echo $email; ?>" required><br><br>

    <?php
    // Manter os dados no campo
    $password = "";
    if (isset($data['password'])) {
        $password = $data['password'];
    }
    ?>
    <label>Senha</label>
    <!-- Criar o campo senha -->
    <input type="password" name="password" id="password" placeholder="Digite a senha" onkeyup="passwordStrength()" autocomplete="on" value="<?php echo $password; ?>" required>

    <span id="msgViewStrength"><br><br></span>

    <input type="submit" name="AddNewUser" value="Cadastrar">
</form>
<!-- Fim formulario -->

<p>
    <a href="<?php echo URLADM . '/login'; ?>">Clique aqui</a> para acessar
</p>