                <?php

                //Inclui o relatorio de usuarios 
                include_once('../../backend/material/relatoriomaterial.php');

                $mensagem = null;
                //Verifica se recebeu alguma informação por meio de GET
                if ($_GET) {
                    //Verifica se essa informação é um status 
                    if ($_GET['status']) {
                        //Utiliza a estrutura de descisão switch para verificar qual
                        //status foi recebido e atribuir uma mensagem conforme necessário
                        switch ($_GET['status']) {
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
                    <title>Medicamentos</title>
                    <link rel="stylesheet" href="medicamento.css">
                    <link rel="stylesheet" href="../../componentes/menu/menu.css">
                </head>

                <body><?php
                        include_once "../../componentes/menu/menu.php";
                        ?>
                    <section class="cadastro">

                        <header>
                            <h1>Administração | Cadastro de Medicamentos</h1>
                        </header>

                        <form action="../../backend/material/criarmaterial.php" method="post">
                            <div class="inputs">
                                <div class="linha">
                                    <input type="text" name="nome" placeholder="Nome">
                                    
                                    <input type="text" name="valor" placeholder="valor">
                                </div>

                                <div class="linha">

                                    <input type="checkbox" name="controlado" id="Controlado"><label for="controlado">Controlado</label>
                                    <input type="checkbox" name="ativo" id="ativo" checked><label for="ativo">Ativo</label>
                                    <input type="checkbox" name="alta_vigilancia" id="alta_vigilancia"> <label for="alta_vigilancia">Alta Vigilância</label>
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
                                    <th>Nome</th>
                                    <th>Id</th>
                                    <th>valor</th>
                                    <th>controlado</th>
                                    <th>Ativo</th>
                                    <th>Alta_vigilância</th>

                                </tr>
                                <tr>
                                    <td><button>Excluir</button></td>
                                    <td>paracetamol</td>
                                    <td>122</td>
                                    <td>R$ 20,00</td>
                                    <td></td>
                                    <td></td>
                                </tr>

                                <?php

                                //Utilizar a funçao foreach
                                //para iterar entre os itens do array
                                //que é o nosso $relatorio

                                foreach ($relatorio as $usuario) {
                                    echo ("
                    <tr>
                    <td><button>Excluir</button></td>
                    <td>" . $usuario['nome'] . "</td>
                    <td>" . $usuario['id'] . " </td>
                    <td>" . $usuario['valor'] . "</td>
                </tr>
                    ");
                                }



                                ?>


                            </table>
                        </div>

                        </section>
                        
                </body>

                </html>