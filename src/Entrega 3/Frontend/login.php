<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="login-container">
        <div class="logo-container">
            <img src="img/logo.PNG" alt="Logo" class="logo">
        </div>
        <div class="login-form">
            <h2>Login</h2>
            <form action="testLogin.php" method="POST">
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" required>
                </div>
                <div class="login-actions">
                    <button type="submit" name="submit">Entrar</button>
                    <a href="cadastro.php">Não tem uma conta? Cadastrar</a>
                </div>
            </form>

            <!-- Mensagem de erro -->
            <?php
            if (isset($_SESSION['login_error'])) {
                echo '<p style="color: red;">' . $_SESSION['login_error'] . '</p>';
                unset($_SESSION['login_error']);  // Limpa a mensagem após exibir
            }
            ?>
        </div>
    </div>

</body>
</html>
