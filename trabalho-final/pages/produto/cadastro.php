<?php
    
    if(isset($_POST['cadastrar'])) {
        try{
            $IDFornecedor = isset($_POST['fornecedor']) ? $_POST['fornecedor'] : null;
            $IDCategoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
            $QuantidadePorUnidade = isset($_POST['qntdpuni']) ? $_POST['qntdpuni'] : null;
            $PrecoUnitario = isset($_POST['preco']) ? $_POST['preco'] : null;
            $UnidadesEmEstoque = isset($_POST['estoque']) ? $_POST['estoque'] : null;
            $UnidadesEmOrdem = isset($_POST['un-ordem']) ? $_POST['un-ordem'] : null;
            $NivelDeReposicao = isset($_POST['nv-repo']) ? $_POST['nv-repo'] : null;
            $Descontinuado = isset($_POST['status']) && $_POST['status'] == 0 ? 'T' : 'F';

            $stmt = $conn->prepare("INSERT INTO PRODUTOS (IDProduto, NomeProduto, IDFornecedor, IDCategoria, QuantidadePorUnidade, PrecoUnitario, UnidadesEmEstoque, UnidadesEmOrdem, NivelDeReposicao, Descontinuado) 
                                                    VALUES (:IDProduto, :NomeProduto, :IDFornecedor, :IDCategoria, :QuantidadePorUnidade, :PrecoUnitario, :UnidadesEmEstoque, :UnidadesEmOrdem, :NivelDeReposicao, :Descontinuado);");
            $stmt->bindParam(':IDProduto', $_POST['IDProduto']);
            $stmt->bindParam(':NomeProduto', $_POST['nomeProduto']);
            $stmt->bindParam(':IDFornecedor', $IDFornecedor);
            $stmt->bindParam(':IDCategoria', $IDCategoria);
            $stmt->bindParam(':QuantidadePorUnidade', $QuantidadePorUnidade);
            $stmt->bindParam(':PrecoUnitario', $PrecoUnitario);
            $stmt->bindParam(':UnidadesEmEstoque', $UnidadesEmEstoque);;
            $stmt->bindParam(':UnidadesEmOrdem', $UnidadesEmOrdem);
            $stmt->bindParam(':NivelDeReposicao', $NivelDeReposicao);
            $stmt->bindParam(':Descontinuado', $Descontinuado);
            $stmt->execute();
            header('Location: ?page=produto');
        } catch (PDOException $e) {
            echo "<h2 class='danger'> Falha ao tentar cadastrar Fornecedor! Verifique as informações e tente novamente. </h2>";
        }
    }

?>


<div class="container">
    <div class="col-md">
        <div class="row">
            <div class="col-6">
                <h2>Novo Produto:</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-info float-right" href="?page=produto">Retornar</a>
            </div>
        </div>
        <hr />
        <form method="POST">
            <div class="form-group">
                <label for="IDProduto">ID do Produto:</label>
                <input type="number" class="form-control" name="IDProduto" id="IDProduto" placeholder="ID do Produto" required/>
            </div>
            <div class="form-group">
                <label for="nomeProduto">Nome do Produto:</label>
                <input type="text" class="form-control" name="nomeProduto" id="nomeProduto" placeholder="Nome do Produto" required/>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="fornecedor">Fornecedor:</label>
                        <select class="form-control" name="fornecedor" id="fornecedor">
                            <?php
                                $stmt = $conn->prepare("select IDFornecedor, nomeCompanhia from FORNECEDORES order by 1 asc");
                                $stmt->execute();
                                $resultado = $stmt->fetchAll();
                                if(count($resultado)){
                                    foreach($resultado as $linha) {
                                        echo "<option value='{$linha['IDFornecedor']}'>{$linha['IDFornecedor']} - {$linha['nomeCompanhia']}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="categoria">Categoria:</label>
                        <select class="form-control" name="categoria" id="categoria">
                            <?php
                                $stmt = $conn->prepare("select IDCategoria, Descricao from CATEGORIAS order by 1 asc");
                                $stmt->execute();
                                $resultado = $stmt->fetchAll();
                                if(count($resultado)){
                                    foreach($resultado as $linha) {
                                        echo "<option value='{$linha['IDCategoria']}'>{$linha['IDCategoria']} - {$linha['Descricao']}</option>";
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="qntdpuni">Quantidade Por Unidade:</label>
                        <input type="text" class="form-control" name="qntdpuni" id="qntdpuni" placeholder="Quantidade Por Unidade" />
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="preco">Preço Unitário:</label>
                        <input type="number" class="form-control" name="preco" id="preco" placeholder="Preço" step="0.1" value="0.00" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="estoque">Unidades em Estoque:</label>
                        <input type="number" class="form-control" name="estoque" id="estoque" placeholder="Unidades em Estoque" />
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="un-ordem">Unidades em Ordem:</label>
                        <input type="number" class="form-control" name="un-orde" id="un-orde" placeholder="Unidades em Ordem" />
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="nv-repo">Nível de Reposição:</label>
                        <input type="number" class="form-control" name="nv-repo" id="nv-repo" placeholder="Nível de Reposição" />
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value='1' selected>Ativo</option>
                            <option value='0'>Desabilitado</option>
                        </select>
                    </div>
                </div>
            </div>
            <br />
            <input class="btn btn-success" type="submit" name="cadastrar" value="Cadastrar"/>
        </form>
    </div>
</div>