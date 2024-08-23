
<?php
include_once "relatoriodeestoque.php";
 include_once "../../componentes/menu/menu.php";
?>

<html>
    
    <head>

    <link rel="stylesheet" href="home.css">
    </head>
    <body>
        <div class="relatorio">
            <h1>Relatório de Estoque</h1>

            <table>
                <tr>
                    <th>ação</th>
                    <th>medicamento</th>
                    <th>estoque</th>
                    <th>ocPendente</th>
                    <th>vendaPendente</th>

                </tr>
               <?php
               
               foreach ($relatorioHome as $relatoriodeestoque) {
                echo ("
                <tr>
                <td><button>Excluir</button></td>
                <td>" . $relatoriodeestoque['nome'] . "</td>
                <td>" . $relatoriodeestoque['estoque'] . "</td>
                <td>" . $relatoriodeestoque['ocPendente'] . " </td>
                <td>" . $relatoriodeestoque['vendaPendente'] . "</td>
                </tr>
");
            }

               
               ?>
        </div>
    
   
              
            

    </body>
</html>