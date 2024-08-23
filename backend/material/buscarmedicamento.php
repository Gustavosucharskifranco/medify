<?php

//Requer conexão com o banco de dados 
require_once '../../backend/database/conexao.php';

//Inia váriavel de menssagem 
$mensagem_erro = '';

//Inicia a estrutura de tentativa try
try {

    //Prepara a query SQL para execução
    $preparo = $conexao->prepare(
        "
        select
            id,
            nome
        from tb_medicamento"
    );
    //Executa a query 
    $preparo->execute();

    //coloca o resultado em um array usando fetch_assoc
    $arrMedicamentos = $preparo->fetchAll();

    //testar se deu certo remover depois 
    //foreach($relatorio as $linha){
    //    print_r($linha);
    //}


} catch (PDOException $erro) {
    print_r($erro);
    //coloca que deu erro na variavel mensagem_erro 
    $mensagem_erro = 'erro';
}
