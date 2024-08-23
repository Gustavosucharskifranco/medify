<?php

    //Requer conexão com o banco de dados 
    require_once '../../backend/database/conexao.php';

    //Inia váriavel de menssagem 
    $mensagem_erro = '';

    //Inicia a estrutura de tentativa try
    try{

    //Prepara a query SQL para execução
        $preparo = $conexao->prepare("
                        with estoque as(
  select
  m.id,
  m.nome,
  sum(ioc.quantidade) - sum(iv.quantidade) as estoque
  from tb_medicamento m 
       left join tb_oc_item ioc on ioc.medicamento = m.id
       left join tb_ordedecompra oc on oc.id = ioc.ordem_compra
       left join tb_vendaitem iv on iv.medicamento = m.id
       left join tb_venda v on v.id - iv.venda
  where 1=1
	 and (oc.situacao = 2
     or v.situacao <> 2) 
  group by m.id,m.nome
), Pendente as(
    select
  m.id,
  m.nome,
  sum(ioc.quantidade) as ocPendente,
  sum(iv.quantidade) as vendaPendente
  from tb_medicamento m 
       left join tb_oc_item ioc on ioc.medicamento = m.id
       left join tb_ordedecompra oc on oc.id = ioc.ordem_compra
       left join tb_vendaitem iv on iv.medicamento = m.id
       left join tb_venda v on v.id - iv.venda
  where 1=1
	 and (oc.situacao = 2
     or v.situacao <> 2)
  group by m.id,m.nome
)
select
    e.id,
    e.nome,
    e.estoque,
    p.ocPendente,
    p.vendaPendente
from estoque e
     left join pendente p on p.id = e.id
     
                        ");
    //Executa a query 
    $preparo->execute();
    
    //coloca o resultado em um array usando fetch_assoc
    $relatorioHome = $preparo->fetchAll();

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