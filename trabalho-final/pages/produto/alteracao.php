<?php
    if(isset($_POST['alterar'])) {
        try{
            $IDFornecedor = isset($_POST['fornecedor']) ? $_POST['fornecedor'] : null;
            $IDCategoria = isset($_POST['categoria']) ? $_POST['categoria'] : null;
            $QuantidadePorUnidade = isset($_POST['qntdpuni']) ? $_POST['qntdpuni'] : null;
            $PrecoUnitario = isset($_POST['preco']) ? $_POST['preco'] : null;
            $UnidadesEmEstoque = isset($_POST['estoque']) ? $_POST['estoque'] : null;
            $UnidadesEmOrdem = isset($_POST['un-ordem']) ? $_POST['un-ordem'] : null;
            $NivelDeReposicao = isset($_POST['nv-repo']) ? $_POST['nv-repo'] : null;
            $Descontinuado = isset($_POST['status']) && $_POST['status'] == 0 ? 'T' : 'F';

            $stmt = $conn->prepare("UPDATE produtos SET
                                        NomeProduto= :NomeProduto,
                                        IDFornecedor= :IDFornecedor,
                                        IDCategoria= :IDCategoria,
                                        QuantidadePorUnidade= :QuantidadePorUnidade,
                                        PrecoUnitario= :PrecoUnitario,
                                        UnidadesEmEstoque= :UnidadesEmEstoque,
                                        UnidadesEmOrdem= :UnidadesEmOrdem,
                                        NivelDeReposicao= :NivelDeReposicao,
                                        Descontinuado= :Descontinuado
                                    WHERE IDProduto = :IDProduto");
            $stmt->bindParam(':IDProduto', $_GET['id'], PDO::PARAM_INT);
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
            echo $e;
            echo "<h2 class='danger'> Falha ao tentar alterar informação do Fornecedor! Verifique as informações e tente novamente. </h2>";
        }
    }

    if(isset($_GET['id'])) {
        $stmt = $conn->prepare("select 
                                    p.IDProduto,
                                    p.NomeProduto,
                                    f.IDFornecedor, 
                                    f.NomeCompanhia,
                                    c.IDCategoria,
                                    c.NomeCategoria,
                                    p.QuantidadePorUnidade,
                                    p.PrecoUnitario,
                                    p.UnidadesEmEstoque,
                                    p.UnidadesEmOrdem,
                                    p.NivelDeReposicao,
                                    p.Descontinuado
                                from produtos p
                                left join fornecedores f
                                    on f.IDFornecedor = p.IDFornecedor
                                left join categorias c
                                    on c.IDCategoria = p.IDCategoria 
                                WHERE IDProduto = :id;");
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
                <h2>Alterar Produto:</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-info float-right" href="?page=produto">Retornar</a>
            </div>
        </div>
        <hr />
        <form method="POST">
            <div class="form-group">
                <label for="nomeProduto">Nome do Produto:</label>
                <input type="text" class="form-control" name="nomeProduto" id="nomeProduto" placeholder="Nome do Produto" value="<?=$result[0]['NomeProduto']?>" required/>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="form-group">
                        <label for="fornecedor">Fornecedor:</label>
                        <select class="form-control" name="fornecedor" id="fornecedor">
                            <?php
                                echo "<option selected value='{$result[0]['IDFornecedor']}'>{$result[0]['IDFornecedor']} - {$result[0]['NomeCompanhia']}</option>";
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
                                echo "<option selected value='{$result[0]['IDCategoria']}'>{$result[0]['IDCategoria']} - {$result[0]['NomeCategoria']}</option>";
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
                        <input type="text" class="form-control" name="qntdpuni" id="qntdpuni" placeholder="Quantidade Por Unidade" value="<?=$result[0]['QuantidadePorUnidade']?>" />
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="preco">Preço Unitário:</label>
                        <input type="number" class="form-control" name="preco" id="preco" step="0.01" value="<?=$result[0]['PrecoUnitario']?>" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-3">
                    <div class="form-group">
                        <label for="estoque">Unidades em Estoque:</label>
                        <input type="number" class="form-control" name="estoque" id="estoque" placeholder="Unidades em Estoque" value="<?=$result[0]['UnidadesEmEstoque']?>" />
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="un-ordem">Unidades em Ordem:</label>
                        <input type="number" class="form-control" name="un-orde" id="un-orde" placeholder="Unidades em Ordem" value="<?=$result[0]['UnidadesEmOrdem']?>" />
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="nv-repo">Nível de Reposição:</label>
                        <input type="number" class="form-control" name="nv-repo" id="nv-repo" placeholder="Nível de Reposição" value="<?=$result[0]['NivelDeReposicao']?>" />
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="status">Status:</label>
                        <select class="form-control" name="status" id="status" required>
                            <option value='1' <?=$result[0]['Descontinuado'] == 'F' ? 'selected' : ''?>>Ativo</option>
                            <option value='0' <?=$result[0]['Descontinuado'] == 'T' ? 'selected' : ''?>>Desabilitado</option>
                        </select>
                    </div>
                </div>
            </div>
            <br />
            <input class="btn btn-success" type="submit" name="alterar" value="Alterar"/>
        </form>
    </div>
</div>