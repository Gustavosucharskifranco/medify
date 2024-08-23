<?php

include_once '../../backend/situacao/buscaSituacoes.php';
include_once '../../backend/ordemdecompra/relatoriodecomp.php';
include_once '../../backend/material/buscarmedicamento.php';

?>

<html>

<head>
    <title>Compra</title>
    <link rel="stylesheet" href="od-compra.css">
    <link rel="stylesheet" href="../../componentes/menu/menu.css">
</head>

<body><?php
        include_once "../../componentes/menu/menu.php";
        ?>
    <section class="cadastro">

        <header>
            <h1> Administração | Compra de Medicamentos </h1>
        </header>

        <form action="../../backend/ordemdecompra/criarcompra.php" method="post">
            <div class="inputs">
                <div class="linha">
                    <input type="date" name="dt_solicitacao" placeholder="solicitação">
                    <input type="date" name="dt_previsao" placeholder="Previsão">
                    <input type="date" name="dt_pagamento" placeholder="Pagamento">
                    <input type="date" name="dt_entregue" placeholder="Entregue">
                    <select name="situacao" >
                    <option value="">Situacao</option>
                    <?php
                    if (isset($arrSituacoes)) {
                        foreach($arrSituacoes as $tipo){
                            echo ("<option value=".$tipo["id"].">".$tipo["descricao"]."</option value>");
                        }


                    }
                    ?>
                </select>
                </div>

                <div class="linha">

                    <input type="number" name="quantidade" placeholder="Quantidade">
                    <select name="medicamento">
                    <option value="">Medicamentos</option>
                    <?php
                    if (isset($arrMedicamentos)) {
                        foreach($arrMedicamentos as $tipo){
                            echo ("<option value=".$tipo["id"].">".$tipo["nome"]."</optionvalue>");
                        }


                    }
                    ?>
                    </select>
                   
                </div>

               

                <div class="controles">
                    <button type="submit" class="salvar">Salvar</button>
                    <button type="reset" class="cancelar">Cancelar</button>

                </div>
            </div>
        </form>
        <div class="relatorio">
            <h1>Relatório</h1>
            <table>
                <tr>
                    <th>Ação</th>
                    <th>solicitação</th>
                    <th>entregue</th>
                    <th>Previsão</th>
                    <th>Pagamento</th>

                </tr>
                <tr>
                </tr>

                <?php

                //Utilizar a funçao foreach
                //para iterar entre os itens do array
                //que é o nosso $relatorio

                foreach ($relatorio as $compra) {
                    echo ("
    <tr>
    <td><button>Excluir</button></td>
    <td>" . $compra['dt_solicitacao'] . "</td>
    <td>" . $compra['dt_pagamento'] . "</td>
    <td>" . $compra['dt_previsao'] . " </td>
    <td>" . $compra['dt_pagamento'] . "</td>
</tr>
    ");
                }



                ?>


            </table>
        </div>

        </section>
        
</body>

</html>