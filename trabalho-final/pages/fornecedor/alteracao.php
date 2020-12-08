<?php
    
    if(isset($_POST['alterar'])) {
        try{
            $nomeContato = isset($_POST['nomeContato']) ? $_POST['nomeContato'] : null;
            $tituloContato = isset($_POST['tituloContato']) ? $_POST['tituloContato'] : null;
            $logradouro = isset($_POST['logradouro']) ? $_POST['logradouro'] : null;
            $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : null;
            $regiao = isset($_POST['regiao']) ? $_POST['regiao'] : null;
            $cep = isset($_POST['cep']) ? $_POST['cep'] : null;
            $pais = isset($_POST['pais']) ? $_POST['pais'] : null;
            $telefone = isset($_POST['telefone']) ? $_POST['telefone'] : null;
            $fax = isset($_POST['fax']) ? $_POST['fax'] : null;
            $site = isset($_POST['site']) ? $_POST['site'] : null;
            $stmt = $conn->prepare("UPDATE fornecedores SET
                                        NomeCompanhia = :NomeCompanhia, 
                                        NomeContato = :NomeContato, 
                                        TituloContato = :TituloContato, 
                                        Endereco = :Endereco, 
                                        Cidade = :Cidade, 
                                        Regiao = :Regiao, 
                                        cep = :cep, 
                                        Pais = :Pais, 
                                        Telefone = :Telefone, 
                                        Fax = :Fax, 
                                        Website = :Website 
                                    WHERE IDFornecedor = :IDFornecedor");
            $stmt->bindParam(':IDFornecedor', $_GET['id'], PDO::PARAM_INT);
            $stmt->bindParam(':NomeCompanhia', $_POST['nomeFornecedor']);
            $stmt->bindParam(':NomeContato', $nomeContato);
            $stmt->bindParam(':TituloContato', $tituloContato);
            $stmt->bindParam(':Endereco', $logradouro);
            $stmt->bindParam(':Cidade', $cidade);
            $stmt->bindParam(':Regiao', $regiao);;
            $stmt->bindParam(':cep', $cep);
            $stmt->bindParam(':Pais', $pais);
            $stmt->bindParam(':Telefone', $telefone);
            $stmt->bindParam(':Fax', $fax);
            $stmt->bindParam(':Website', $site);
            $stmt->execute();
            header('Location: ?page=fornecedor');
        } catch (PDOException $e) {
            echo $e;
            echo "<h2 class='danger'> Falha ao tentar alterar informação do Fornecedor! Verifique as informações e tente novamente. </h2>";
        }
    }

    if(isset($_GET['id'])) {
        $stmt = $conn->prepare("SELECT * FROM Fornecedores WHERE IDFornecedor = :id;");
        $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetchAll();
    } else {
        echo "Necessário informar o ID para alterar um registro!";
    }

?>


<div class="container">
    <div class="col-md">
        <div class="row">
            <div class="col-6">
                <h2>Alterar Fornecedor:</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-info float-right" href="?page=fornecedor">Retornar</a>
            </div>
        </div>
        <hr />
        <form method="POST">
            <div class="form-group">
                <label for="nomeFornecedor">Nome do Fornecedor:</label>
                <input type="text" class="form-control" name="nomeFornecedor" id="nomeFornecedor" placeholder="Nome do Fornecedor" value="<?=$result[0]['NomeCompanhia']?>"/>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="nomeContato">Nome para Contato:</label>
                        <input type="text" class="form-control" name="nomeContato" id="nomeContato" placeholder="Nome para Contato" value="<?=$result[0]['NomeContato']?>"/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="tituloContato">Título do Contato:</label>
                        <input type="text" class="form-control" name="tituloContato" id="tituloContato" placeholder="Título do Contato" value="<?=$result[0]['TItuloContato']?>"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="logradouro">Logradouro:</label>
                        <input type="text" class="form-control" name="logradouro" id="logradouro" placeholder="Logradouro" value="<?=$result[0]['Endereco']?>"/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="cidade">Cidade:</label>
                        <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade" value="<?=$result[0]['Cidade']?>"/>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="regiao">Região:</label>
                        <input type="text" class="form-control" name="regiao" id="regiao" placeholder="Região" value="<?=$result[0]['Regiao']?>"/>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input type="number" class="form-control" name="cep" id="cep" placeholder="CEP" value="<?=$result[0]['cep']?>"/>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="pais">País:</label>
                        <input type="text" class="form-control" name="pais" id="pais" placeholder="País" value="<?=$result[0]['Pais']?>"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="phone" class="form-control" name="telefone" id="telefone" placeholder="Telefone" value="<?=$result[0]['Telefone']?>"/>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="fax">Fax:</label>
                        <input type="text" class="form-control" name="fax" id="fax" placeholder="Fax" value="<?=$result[0]['Fax']?>"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="site">Website:</label>
                        <input type="text" class="form-control" name="site" id="site" placeholder="Site" value="<?=$result[0]['Website']?>"/>
                    </div>
                </div>
            </div>
            <input class="btn btn-success" type="submit" name="alterar" value="Alterar"/>
        </form>
        
    </div>
</div>