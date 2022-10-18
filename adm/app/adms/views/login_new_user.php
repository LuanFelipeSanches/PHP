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

    // Evitar SQL Injection
    $name = mysqli_real_escape_string($conn, $data['name']);
    $email = mysqli_real_escape_string($conn, $data['email']);
    $password = mysqli_real_escape_string($conn, $data['password']);

    // Criptografar a senha
    $password_encrypted = password_hash($password, PASSWORD_DEFAULT);

    $query_user = "INSERT INTO adms_users (name, email, username, password, created) VALUES ('$name', '$email', '$email', '$password_encrypted', NOW())";
    mysqli_query($conn, $query_user);

    if(mysqli_insert_id($conn)){
        $msg = "<p style='color: green;'>Cadastrado realizado com sucesso!</p>";
        unset($data);
    }else{
        $msg = "<p style='color: #f00;'>Erro: Cadastrado não realizado com sucesso!</p>";
    }
    
}
?>

<h1>Novo Usuário</h1>

<span id="msg"></span>

<?php
if(!empty($msg)){
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
    <input type="text" name="name" id="name" placeholder="Digite o nome completo" value="<?php echo $name; ?>" autofocus ><br><br>

    <?php
    // Manter os dados no campo
    $email = "";
    if (isset($data['email'])) {
        $email = $data['email'];
    }
    ?>
    <label>E-mail</label>
    <!-- Criar o campo email -->
    <input type="email" name="email" id="email" placeholder="Digite o seu melhor e-mail" value="<?php echo $email; ?>" ><br><br>

    <?php
    // Manter os dados no campo
    $password = "";
    if (isset($data['password'])) {
        $password = $data['password'];
    }
    ?>
    <label>Senha</label>
    <!-- Criar o campo senha -->
    <input type="password" name="password" id="password" placeholder="Digite a senha" onkeyup="passwordStrength()" autocomplete="on" value="<?php echo $password; ?>" >

    <span id="msgViewStrength"><br><br></span>

    <input type="submit" name="AddNewUser" value="Cadastrar">
</form>
<!-- Fim formulario -->

<p>
    <a href="<?php echo URLADM . '/login'; ?>">Clique aqui</a> para acessar
</p>