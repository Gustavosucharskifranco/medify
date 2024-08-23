<?php



    //Requer conexão com o banco de dados 
    require_once '../../backend/database/conexao.php';

    //Inia váriavel de menssagem 
    $mensagem_erro = '';

    //Inicia a estrutura de tentativa try
    try{

    //Prepara a query SQL para execução
        $preparo = $conexao->prepare("
       select
        med.nome,
        sum(oci.quantidade) as quantidade
        from tb_ordedecompra oc
        inner join tb_oc_item oci on oci.ordem_compra = oc.id
        inner join tb_medicamento med on med.id = oci.medicamento
        where oc.situacao = 2
        group by med.nome"
            

    );
    //Executa a query 
    $preparo->execute();
    
    //coloca o resultado em um array usando fetch_assoc
    $relatorio = $preparo->fetchAll();

//testar se deu certo remover depois 
    //foreach($relatorio as $linha){
    //    print_r($linha);
    //}


    }catch(PDOException $erro){
        print_r($erro);
        //coloca que deu erro na variavel mensagem_erro 
        $mensagem_erro = 'erro';
    }




?>