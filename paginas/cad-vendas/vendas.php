<?php

include_once '../../backend/situacao/buscaSituacoes.php';
include_once '../../backend/ordemdevenda/relatoriovenda.php';
include_once '../../backend/material/buscarmedicamento.php';
include_once '../../backend/material/buscatipo.php';

?>

<html>

<head>
    <title>Compra</title>
    <link rel="stylesheet" href="vendas.css">
    <link rel="stylesheet" href="../../componentes/menu/menu.css">
</head>

<body><?php
        include_once "../../componentes/menu/menu.php";
        ?>
    <section class="cadastro">

        <header>
            <h1> Administração | Venda de Medicamentos </h1>
        </header>

        <form action="../../backend/ordemdevenda/criarvenda.php" method="post">
            <div class="inputs">
                <div class="linha">
                    <label for="">Data da venda</label><input type="date" name="dt_venda" placeholder="dt_venda">
                    <input type="text" name="metododepagamento" placeholder=" Metodo de Pagamento">
                    <label for="">Data de Pagamento</label><input type="date" name="dt_pagamento" placeholder="Pagamento">
                    <select name="tipo" >
                    <option value="">Tipo</option>
                    <?php
                    if (isset($arrTipo)) {
                        foreach($arrTipo as $tipo){
                            echo ("<option value=".$tipo["id"].">".$tipo["decricao"]."</option>");
                        }


                    }
                    ?>
                </select>
                    <select name="situacao" >
                    <option value="">Situacao</option>
                    <?php
                    if (isset($arrSituacoes)) {
                        foreach($arrSituacoes as $tipo){
                            echo ("<option value=".$tipo["id"].">".$tipo["descricao"]."</option>");
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
                    <th>dt_venda</th>
                    <th>metododepagamento</th>
                    <th>dt_pagamento</th>
                    <th>tipo</th>
                    <th>situação</th>

                </tr>
               

                <?php

                //Utilizar a funçao foreach
                //para iterar entre os itens do array
                //que é o nosso $relatorio

                foreach ($relatorio as $compra) {
                    echo ("
    <tr>
    <td><button>Excluir</button></td>
    <td>" . $compra['dt_venda'] . "</td>
    <td>" . $compra['metododepagamento'] . " </td>
    <td>" . $compra['dt_pagamento'] . "</td>
     <td>" . $compra['tipo'] . "</td>
      <td>" . $compra['situacao'] . "</td>
</tr>
</tr>
    ");
                }



                ?>


            </table>
        </div>

        </section>
        
</body>

</html>