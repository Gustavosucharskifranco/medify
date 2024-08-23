<?php

//Requer conexão com o banco de dados 
require_once '../database/conexao.php';

//coloca todas as informações recebidas via POST
//em uma variável para ser utilizada posteriormente
$requisicao = $_POST;
print_r($requisicao);

//Utiliza uma estrutura de tentativa para tentar 
//inserir as informações no banco de dados 
try {
    //utiliza o método prepare() da váravel conexão (que está disponivel
    //no arquivo por meio de require_once), para prepar uma instrução
    //sql(banco de dados) 
    $preparacao = $conexao->prepare("
    insert into tb_ordedecompra(
        dt_solicitacao, dt_previsao, dt_entregue, dt_pagamento, situacao
    ) values (
        :dt_solicitacao, :dt_previsao, :dt_entregue, :dt_pagamento, :situacao)
        ");
    //Utiliza o método bindParam da classe Preparedstatement disponível
    //na variável preparação acima.
    //a função bindParam troca um dos spareamentos da instrução sql pelo 
    //valr contido em uma variavel. Não esquecer de mudar o tipo no 
    //ultimo argumento.
    $preparacao->bindParam(':dt_solicitacao', $requisicao['dt_solicitacao'], PDO::PARAM_STR);
    $preparacao->bindParam(':dt_previsao', $requisicao['dt_previsao'], PDO::PARAM_STR);
    $preparacao->bindParam(':dt_pagamento', $requisicao['dt_pagamento'], PDO::PARAM_STR);
    $preparacao->bindParam(':dt_entregue', $requisicao['dt_entregue'], PDO::PARAM_STR);
    $preparacao->bindParam(':situacao', $requisicao['situacao'], PDO::PARAM_STR);
    //Ao final da troca dos parametros estamos priontos para executar 
    //a instrução por isso utilizamos o método execute() da classe
    //Praparedstatemente
    $preparacao->execute();
    //ao executar, prcisamos verificar se o valor foi fato 
    //inserido no banco de dados, para isso varificamos se o valor do 
    //rowcout() é igua a 1 (quantidade de linhas que foram iserida )

    $stmt2 = $conexao->prepare('select last_insert_id() as id');
    $stmt2->execute();
    $res = $stmt2->fetchAll();
    $id = $res[0]['id'];

    $stmt3 = $conexao->prepare("insert into tb_oc_item(
    ordem_compra, medicamento, quantidade) 
    values(:ordem_compra, :medicamento, :quantidade )");
    $stmt3->bindparam(':ordem_compra', $id,PDO::PARAM_INT);
    $stmt3->bindparam(':medicamento', $requisicao['medicamento'], PDO::PARAM_INT);
    $stmt3->bindparam(':quantidade', $requisicao['quantidade'], PDO::PARAM_INT);

    $stmt3->execute();






    if ($preparacao->rowCount() == 1) {
        //caso isso seja positivo, retorna para a página de cadastro
        //com o status 201(created)
        header('Location: ../../paginas/cad-ordemdecompra/od-compra.php?status=201');
        //Morre a execução para evitar lacunas de segurança
        die();
    } else {
        //Caso a quantidade não seja q, retorna com o status 
        //400 (bad Request), informando que faltou algo
        header('Location: ../../paginas/cad-oredmdecompra/od-compra.php?status=400');
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
