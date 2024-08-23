<?php
$erro = null;

 
if($_GET){
    if($_GET['erro']){
        $erro = $_GET['erro'];
    }
}

?>



<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Farmácia fred</title>
  
      <link rel="stylesheet" href="index.css">
   
</head>
<body>
    <div class="login-container">
        <h2>Login - VitAlis</h2>
        <form action="backend/login/login.php" method="POST">
            <input type="text" name="username" placeholder="Usuário" required>
            <br>
            <input type="password" name="password" placeholder="Senha" required>
            <br>
            <input type="submit" value="Entrar">
        </form>
        <p><a href="esqueci_minha_senha.php">Esqueci minha senha</a></p>
        <p><a href="criar_conta.php">Criar uma conta</a></p>
    </div>
    <?php
if($erro){
    switch($erro != null){
        case '401':
            echo('<p class="erro">Usuario ou senha inválidos</p>');
            break;
            case '500':
                echo('<p class="erro">Erro no servidor, tente novamnete, mais trade </p>');
                break;
    }

}
?>
</body>
</html>