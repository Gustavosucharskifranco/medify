<?php

require '../database/conexao.php';

$username = $_POST["username"];
$password = sha1($_POST["password"]);

echo("O nome de usuario é: ". $username);
echo("E a senha é: ". $password);

try{
$estagio = $conexao->prepare('select id from tb_usuario where login = :usuario and senha = :senha');
$estagio->bindParam(':usuario',$username,PDO::PARAM_STR);
$estagio->bindParam(':senha',$password,PDO::PARAM_STR);
$estagio->execute();
$resultado = $estagio->fetchAll();
if(count($resultado)==1){
   // O usuário pode logar no sistema
   header('Location: ../../paginas/home/home.php');
   die();
}else{
    //Não autenticado
    header('Location: ../../index.php?erro=401');
    die();
}
}catch(PDOException $erro){
     echo('Erro'.$erro->getMessage());
     //Retorna erro
     header('Location: ../../index.php?erro=500');
     die();
}



?>  