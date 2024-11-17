<?php
if (isset($_POST['submit'])) {
    include_once('config.php');

    // Pegando os dados do formulário
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Criptografando a senha usando MD5 (não recomendado para produção, mas atendendo ao requisito)
    $senha_hash = md5($senha);

    // Usando prepared statements para evitar SQL injection
    $stmt = $conexao->prepare("INSERT INTO login (nome, email, senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha_hash); // "sss" indica que são três parâmetros string
    $stmt->execute();

    // Fechando a conexão
    $stmt->close();
    $conexao->close();

    // Redirecionando para a página de cadastro com a mensagem de sucesso
    header('Location: cadastro.php?success=Cadastro%20efetuado%20com%20sucesso!');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

    <div class="login-container">
        <!-- Logo maior sem o círculo -->
        <div class="logo-container">
            <img src="img/logo.PNG" alt="Logo" class="logo">
        </div>
        <div class="login-form">
            <H2>Cadastro</H2>
            <form action="cadastro.php" method="POST">
                <div class="input-group">
                    <label for="nome">Nome</label>
                    <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
                </div>
                <div class="input-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Digite seu email" required>
                </div>
                <div class="input-group">
                    <label for="senha">Senha</label>
                    <input type="password" id="senha" name="senha" placeholder="Digite uma senha" required>
                </div>
                <div class="login-actions">
                    <button type="submit" name="submit" id="submit">Cadastrar</button>
                    <a href="login.php">Já tem uma conta? Entrar</a>
                </div>
            </form>

            <!-- Mensagem de sucesso -->
            <?php
            if (isset($_GET['success'])) {
                echo '<p style="color: green;">' . htmlspecialchars($_GET['success']) . '</p>';
            }
            ?>
        </div>
    </div>

</body>
</html>
