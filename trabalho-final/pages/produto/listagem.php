<?php
    try{
        
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
                                    on c.IDCategoria = p.IDCategoria");
        $stmt->execute();

        $resultado = $stmt->fetchAll();

?>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <h2>Produtos</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-success float-right" href="?page=produto&action=cadastrar">Cadastrar Novo Produto</a>
            </div>
        </div>
    </div>
    <br />
    <div class="table-responsive">
        <table border="1" class="table table-striped">
            <thead>
                <tr>
                    <td><b>ID</b></td>
                    <td><b>Nome do Produto</b></td>
                    <td><b>Fornecedor</b></td>
                    <td><b>Categoria</b></td>
                    <td><b>Quantidade por Unidade</b></td>
                    <td><b>Preço Unitário</b></td>
                    <td><b>Unidades em Estoque</b></td>
                    <td><b>Unidades em Ordem</b></td>
                    <td><b>Nível de Reposição</b></td>
                    <td><b>Status</b></td>
                    <td><b>Ações</b></td>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(count($resultado)){
                        foreach($resultado as $linha) {
                            ?>
                                <tr>
                                    <td><?=$linha['IDProduto']?></td>
                                    <td><?=$linha['NomeProduto']?></td>
                                    <td><?=($linha['IDFornecedor'] != null ? $linha['IDFornecedor'] . ' - ' . $linha['NomeCompanhia'] : '')?></td>
                                    <td><?=($linha['IDCategoria'] != null ? $linha['IDCategoria'] . ' - ' . $linha['NomeCategoria'] : '')?></td>
                                    <td><?=($linha['QuantidadePorUnidade'] != null ? $linha['QuantidadePorUnidade'] : '')?></td>
                                    <td><?=($linha['PrecoUnitario'] != null ? $linha['PrecoUnitario'] : '')?></td>
                                    <td><?=($linha['UnidadesEmEstoque'] != null ? $linha['UnidadesEmEstoque'] : '')?></td>
                                    <td><?=($linha['UnidadesEmOrdem'] != null ? $linha['UnidadesEmOrdem'] : '')?></td>
                                    <td><?=($linha['NivelDeReposicao'] != null ? $linha['NivelDeReposicao'] : '')?></td>
                                    <td><?=($linha['Descontinuado'] != null && $linha['UnidadesEmEstoque'] == 'T' ? 'Desabilitado' : 'Habilitado')?></td>
                                    <td class="text-center">
                                        <a href="?page=produto&action=alterar&id=<?=$linha['IDProduto']?>">Alterar</a>
                                        <b> | </b>
                                        <a href="?page=produto&action=deletar&id=<?=$linha['IDProduto']?>">Deletar</a>
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