<?php

// Redirecionar ou parar o processamento quando o usuario nao acessa o arquivo index.php
if (!defined('C7E3L8K9E5')) {
    //header("Location: /");
    die("Erro: Página não encontrada!<br>");
}

// Verificar se o usuario esta logado
function validateAccess($path_page)
{
    // Criar o array de paginas publicas
    $page_public = ["login", "sair", "404","login_new_user"];

    // Criar o array de paginas restritas
    $page_restricted = ["dashboard"];

    // Verificar se a pagina esta no array de paginas publicas
    if (in_array($path_page, $page_public)) {
        // Retorna a pagina que o usuario pretende acessar
        return $path_page;
    } elseif (in_array($path_page, $page_restricted)) { //// Verificar se a pagina esta no array de paginas restritas
        // Chamar a funcao para verificar se o usuario esta logado
        if (verifyLogin()) {
            // Retorna a pagina que o usuario pretende acessar
            return $path_page;
        } else {
            // Retorna a pagina login porque o usuario nao esta logado
            return "login";
        }
    } else {
        // Retorna a pagina login porque o usuario enviou a pagina que nao existe
        return "login";//PODE COLOCAR A PAGINA 404
    }
}

// Funcao verificar se usuario esta logado
function verifyLogin()
{
    // Verificar se existe as sessoes com as informacoes do usuario
    if ((isset($_SESSION['user_id'])) and (isset($_SESSION['user_id'])) and isset($_SESSION['user_email'])) {
        // Retorne TRUE quando usuario esta logado
        return true;
    } else { // Acessa o ELSE quando usuario nao esta logado e cria a mensagem de erro
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Para acessar a página necessário estar logado!</p>";
        // Retorne FALSE quando usuario nao esta logado
        return false;
    }
}
