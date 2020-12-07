<?php
    try{
        
        $stmt = $conn->prepare("select * from FORNECEDORES");
        $stmt->execute();

        $resultado = $stmt->fetchAll();

?>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h2>Fornecedores</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-success float-right" href="?page=fornecedor&action=cadastrar">Cadastrar Novo Fornecedor</a>
            </div>
        </div>
    </div>
    <br />
    <div class="table-responsive">
        <table border="1" class="table table-striped">
            <thead>
                <tr>
                    <td><b>ID</b></td>
                    <td><b>Nome da Companhia</b></td>
                    <td><b>Nome para Contato</b></td>
                    <td><b>Endereço</b></td>
                    <td><b>Telefone</b></td>
                    <td><b>Fax</b></td>
                    <td><b>Website</b></td>
                    <td><b>Ações</b></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(count($resultado)){
                        foreach($resultado as $linha) {
                            $enderecoDesc = $linha['Endereco'] 
                                . ' - ' . $linha['Cidade'] 
                                . ($linha['Regiao'] != null ? ' (' . $linha['Regiao'] . ') ' : '')
                                . ($linha['cep'] != null ? ' - ' . $linha['cep'] . ' ' : '')
                                . ($linha['Pais'] != null ? ' - ' . $linha['Pais'] : '');
                            $contato = ($linha['NomeContato'] != null ? $linha['NomeContato'] : '')
                                . ($linha['TItuloContato'] != null ? ' (' . $linha['TItuloContato'] . ')' : '')
                            ?>
                                <tr>
                                    <td><?=$linha['IDFornecedor']?></td>
                                    <td><?=$linha['NomeCompanhia']?></td>
                                    <td><?=$contato?></td>
                                    <td><?=$enderecoDesc?></td>
                                    <td><?=($linha['Telefone'] != null ? $linha['Telefone'] : '')?></td>
                                    <td><?=($linha['Fax'] != null ? $linha['Fax'] : '')?></td>
                                    <td><?=($linha['Website'] != null ? $linha['Website'] : '')?></td>
                                    <td class="text-center">
                                        <a href="?page=fornecedor&action=alterar&id=<?=$linha['IDFornecedor']?>">Alterar</a>
                                        <b> | </b>
                                        <a href="?page=fornecedor&action=deletar&id=<?=$linha['IDFornecedor']?>">Deletar</a>
                                    </td>
                                </tr>
                            <?php
                        }
                    } else {
                        echo "<tr><td colspan=\"3\"> Nenhum resultado encontrado </td></tr>";
                    }
                ?>
            </tbody>
        </table>
    </div>
            

<?php
    } catch(PDOException $e) {
        echo "Erro: {$e->getMessage()}";
    }