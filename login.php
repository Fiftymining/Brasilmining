<?php
session_start();
include("conexao.php"); // Arquivo com conexão ao MySQL

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Evitar SQL Injection
    $email = mysqli_real_escape_string($conn, $email);
    $senha = mysqli_real_escape_string($conn, $senha);

    // Buscar usuário
    $query = "SELECT id, nome, senha FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 1) {
        $usuario = mysqli_fetch_assoc($result);

        // Verificar a senha
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            header("Location: dashboard.html"); // Redireciona para o painel
            exit();
        } else {
            $erro = "Senha incorreta.";
        }
    } else {
        $erro = "Usuário não encontrado.";
    }
}
?>

<!-- Formulário HTML -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Login - BrasilInvesting</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="login-container">
    <h2>Login</h2>
    <?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>
    <form method="POST" action="login.php">
      <label>E-mail:</label><br>
      <input type="email" name="email" required><br><br>
      <label>Senha:</label><br>
      <input type="password" name="senha" required><br><br>
      <button type="submit">Entrar</button>
    </form>
  </div>
</body>
</html>
