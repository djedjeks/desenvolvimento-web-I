<?php
    
    if(isset($_POST['cadastrar'])) {
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

            $stmt = $conn->prepare("INSERT INTO fornecedores (IDFornecedor, NomeCompanhia, NomeContato, TituloContato, Endereco, Cidade, Regiao, cep, Pais, Telefone, Fax, Website) 
                                                    VALUES (:IDFornecedor, :NomeCompanhia, :NomeContato, :TituloContato, :Endereco, :Cidade, :Regiao, :cep, :Pais, :Telefone, :Fax, :Website);");
            $stmt->bindParam(':IDFornecedor', $_POST['IDFornecedor']);
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
            echo $e.getMessage();
            echo "<h2 class='danger'> Falha ao tentar cadastrar Fornecedor! Verifique as informações e tente novamente. </h2>";
        }
    }

?>


<div class="container">
    <div class="col-md">
        <div class="row">
            <div class="col-6">
                <h2>Novo Fornecedor:</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-info float-right" href="?page=fornecedor">Retornar</a>
            </div>
        </div>
        <hr />
        <form method="POST">
            <div class="form-group">
                <label for="IDFornecedor">ID do fornecedor:</label>
                <input type="number" class="form-control" name="IDFornecedor" id="IDFornecedor" placeholder="ID do Fornecedor" />
            </div>
            <div class="form-group">
                <label for="nomeFornecedor">Nome do Fornecedor:</label>
                <input type="text" class="form-control" name="nomeFornecedor" id="nomeFornecedor" placeholder="Nome do Fornecedor" />
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="nomeContato">Nome para Contato:</label>
                        <input type="text" class="form-control" name="nomeContato" id="nomeContato" placeholder="Nome para Contato" />
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="tituloContato">Título do Contato:</label>
                        <input type="text" class="form-control" name="tituloContato" id="tituloContato" placeholder="Título do Contato" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="logradouro">Logradouro:</label>
                        <input type="text" class="form-control" name="logradouro" id="logradouro" placeholder="Logradouro" />
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="cidade">Cidade:</label>
                        <input type="text" class="form-control" name="cidade" id="cidade" placeholder="Cidade" />
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="regiao">Região:</label>
                        <input type="text" class="form-control" name="regiao" id="regiao" placeholder="Região" />
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="cep">CEP:</label>
                        <input type="number" class="form-control" name="cep" id="cep" placeholder="CEP" />
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="pais">País:</label>
                        <input type="text" class="form-control" name="pais" id="pais" placeholder="País" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="telefone">Telefone:</label>
                        <input type="phone" class="form-control" name="telefone" id="telefone" placeholder="Telefone" />
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="fax">Fax:</label>
                        <input type="text" class="form-control" name="fax" id="fax" placeholder="Fax" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="site">Website:</label>
                        <input type="text" class="form-control" name="site" id="site" placeholder="Site" />
                    </div>
                </div>
            </div>
            <input class="btn btn-success" type="submit" name="cadastrar" value="Cadastrar"/>
        </form>
        
    </div>
</div>