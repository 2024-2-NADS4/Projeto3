<?php
session_start();

// Incluindo o arquivo de configuração que contém a conexão com o banco de dados
include_once('config.php');

// Log para verificar o processo
error_log('Iniciando o login');

// Verificando se o formulário foi submetido
if (isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    // Pegando os dados do formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Criptografando a senha fornecida pelo usuário com MD5 (de acordo com o que foi feito no cadastro)
    $senha_hash = md5($senha);

    // Usando prepared statements para prevenir SQL Injection
    $stmt = $conexao->prepare("SELECT * FROM login WHERE email = ? AND senha = ?");
    if ($stmt === false) {
        die('Erro na preparação da consulta: ' . $conexao->error); // Se a preparação falhar, exibe erro.
    }

    $stmt->bind_param("ss", $email, $senha_hash);  // "ss" indica que são dois parâmetros string
    $stmt->execute();
    $result = $stmt->get_result();



    // Verificando se o login foi bem-sucedido
    if (mysqli_num_rows($result) > 0) {
        // O login foi bem-sucedido, armazenando os dados do usuário na sessão
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];
        $_SESSION['nome'] = $row['nome'];

        // Log para verificar o processo no console
        error_log("Login bem-sucedido: " . print_r($_SESSION, true));  // Log detalhado da sessão

        // Fechando a conexão antes de redirecionar
        $stmt->close();
        $conexao->close();

        // Redirecionando para a página de sucesso ou página inicial (reat.php ou outra)
        header('Location: reat.php');
        exit;  // Garantir que o script pare de ser executado após o redirecionamento
    }else {
        // Log para erro de login
        error_log('Falha no login, credenciais incorretas');
        
        // Fechando a conexão antes de exibir o modal
        $stmt->close();
        $conexao->close();
        
        // Armazenando a mensagem de erro na sessão
        $_SESSION['login_error'] = 'Falha no login, credenciais incorretas';
        
        // Redirecionando de volta para a página de login
        header('Location: login.php');
        exit;  // Garantir que o script pare de ser executado após o redirecionamento
    }
    
} else {
    // Log para erro no envio do formulário
    // Fechando a conexão antes de redirecionar
    $conexao->close();

    // Se o formulário não foi submetido corretamente, redireciona para a página de login
    header('Location: login.php');
    exit;  // Garantir que o script pare de ser executado após o redirecionamento
}
?>
