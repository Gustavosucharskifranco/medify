<?php

//Requer conexão com o banco de dados 
require_once '../database/conexao.php';

//coloca todas as informações recebidas via POST
//em uma variável para ser utilizada posteriormente
$requisicao = $_POST;

$ativo = true;
$controlado = true;
$alta_vig = true;

if(!isset($requisicao['ativo'])){
    $ativo = false;
}
if(!isset($requisicao['controlado'])){
    $controlado = false;
}
if(!isset($requisicao['alta_vigilancia'])){
    $alta_vig = false;
}

//Utiliza uma estrutura de tentativa para tentar 
//inserir as informações no banco de dados 
try {
    //utiliza o método prepare() da váravel conexão (que está disponivel
    //no arquivo por meio de require_once), para prepar uma instrução
    //sql(banco de dados) 
    $preparacao = $conexao->prepare("
    insert into tb_medicamento(
        nome, controlado, valor, ativo, alta_vigilancia
    ) values (
        :nome, :controlado, :valor, :ativo, :alta_vigilancia 
    )
        ");
    //Utiliza o método bindParam da classe Preparedstatement disponível
    //na variável preparação acima.
    //a função bindParam troca um dos spareamentos da instrução sql pelo 
    //valr contido em uma variavel. Não esquecer de mudar o tipo no 
    //ultimo argumento.
    $preparacao->bindParam(':nome', $requisicao['nome'], PDO::PARAM_STR);
    $preparacao->bindParam(':controlado', $controlado, PDO::PARAM_BOOL);
    $preparacao->bindParam(':valor', $requisicao['valor'], PDO::PARAM_STR);
    $preparacao->bindParam(':ativo', $ativo, PDO::PARAM_BOOL);
    $preparacao->bindParam(':alta_vigilancia', $alta_vig, PDO::PARAM_BOOL);
    //Ao final da troca dos parametros estamos priontos para executar 
    //a instrução por isso utilizamos o método execute() da classe
    //Praparedstatemente
    $preparacao->execute();
    //ao executar, prcisamos verificar se o valor foi fato 
    //inserido no banco de dados, para isso varificamos se o valor do 
    //rowcout() é igua a 1 (quantidade de linhas que foram iserida )
    if ($preparacao->rowCount() == 1) {
        //caso isso seja positivo, retorna para a página de cadastro
        //com o status 201(created)
        header('Location: ../../paginas/cad.material/medicamento.php?status=201');
        //Morre a execução para evitar lacunas de segurança
        die();
    } else {
        //Caso a quantidade não seja q, retorna com o status 
        //400 (bad Request), informando que faltou algo
        header('Location: ../../paginas/cad.material/medicamento.php?status=400');
        die();
    }
} catch (PDOException $erro) {
    //Executa caso receba algum erro
    //volta para a página de cadastro e apresenta
    //um erro do tipo 500(server Error)
    echo ''. $erro->getMessage() .'';
    //header('Location: ../../paginas/cad-usuario/usuario.php?status=500');
    //Morre a execção para evitar lacunas de segurança.
    die();
}
