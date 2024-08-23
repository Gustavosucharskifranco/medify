<?php

//Inclui o relatorio de usuarios 
include_once('../../backend/usuario/relatorioUsuario.php');

$mensagem = null;
//Verifica se recebeu alguma informação por meio de GET
if($_GET){
    //Verifica se essa informação é um status 
    if($_GET['status']){
        //Utiliza a estrutura de descisão switch para verificar qual
        //status foi recebido e atribuir uma mensagem conforme necessário
        switch($_GET['status']){
            case 201:
                //criado
                $mensagem = 'Adicionado com sucesso !';
                break;
            case 400:
                //Bad request
                $mensagem = 'Inserção nçao funcionou';
                break;
            case 500:
                //Erro no servidor 
                $mensagem = 'Erro ao tentar inserir informações';
                break;    
            
        }
    }
}

?>



<html>

<head>

    <title>Usuario | VittAlis</title>
    <link rel="stylesheet" href="usuario.css">
    <link rel="stylesheet" href="../../componentes/menu/menu.css">
</head>

<body>
    <?php

    include_once '../../componentes/menu/menu.php'
    ?>
    <section class="pagina">
        <header>
            <h1>Administração | Cadastro de usuários </h1>
        </header>
        <form action="../../backend/usuario/criarUsuario.php" method="post">
            <div class="inputs">
                <div class="linha">
                    <input type="text"  name="nome" placeholder="Nome">
                    <input type="text" name="sobrenome" placeholder="Sobrenome">
                    <input type="text" name="endereco" placeholder="Endereço">
                </div>

               
                <div class="linha">

                    <input type="text" name="email" placeholder="E-mail">
                    <input type="text" name="telefone" placeholder="Telefone">
                </div>
                <div class="linha">
                <input type="text" name="usuario" placeholder="Usuário">
                <select name="tipo">
                    <option value="">Tipo de Usuário</option>
                    <option value="300">Administrador</option>
                    <option value="301">Normal</option>
                </select>
                </div>

            </div>

            <div class="controles">
                <button type="submit" class="salvar">Salvar</button>
                <button type="reset" class="cancelar">Cancelar</button>
                <?php
                  echo('<p>'.$mensagem.'<p>');
                ?>
                    </div>
        </form>
<div class="relatorio">
            <h1>Relatório</h1>
            <table>
                <tr>
                    <th>Ação</th>
                    <th>Id</th>
                    <th>nome</th>
                    <th>Telefone</th>
                    <th>login</th>
                    <th>cargo</th>

                </tr>
                

                <?php
                
                //Utilizar a funçao foreach
                //para iterar entre os itens do array
                //que é o nosso $relatorio

                foreach($relatorio as $usuario){
                    echo("
                    <tr>
                    <td><button>Excluir</button></td>
                    <td>".$usuario['id']."</td>
                    <td>".$usuario['nome']." ".$usuario['sobrenome']."</td>
                    <td>".$usuario['telefone']."</td>
                    <td>".$usuario['login']."</td>
                    <td>".$usuario['decricao']."</td>
                </tr>
                    ");
                }
                
                
                
                ?>


            </table>
        </div>


    </section>
</body>

</html>