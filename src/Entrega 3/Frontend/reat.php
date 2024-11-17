<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['email']) || !isset($_SESSION['nome'])) {
    // Se não estiver logado, redireciona para a página de login
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receitas com Ingredientes</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <img src="img/logo.PNG" alt="reat" class="logo">
    </header>
    <main>
        <div class="container">
            <p>Vamos cozinhar? Me diga quais ingredientes você tem em casa e eu te dou uma receita para fazer com eles!</p>
            <form action="#">
                <input type="text" placeholder="Digite os ingredientes aqui" required>
                <button type="submit">Enviar</button>
            </form>
        </div>
    </main>
</body>
</html>
