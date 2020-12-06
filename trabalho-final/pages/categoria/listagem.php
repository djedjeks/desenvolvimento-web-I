<?php
    try{
        
        $stmt = $conn->prepare("select * from CATEGORIAS");
        $stmt->execute();

        $resultado = $stmt->fetchAll();

?>
    <div class="container">
        <div class="col-md">
            <div class="row">
                <div class="col-6">
                    <h2>Categorias</h2>
                </div>
                <div class="col-6">
                    <a class="btn btn-success float-right" href="?page=categoria&action=cadastrar">Cadastrar Nova Categoria</a>
                </div>
            </div>
            <br />

            <table border="1" class="table table-striped">
                <thead>
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>Nome</b></td>
                        <td><b>Descricao</b></td>
                        <td><b>Ações</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if(count($resultado)){
                            foreach($resultado as $linha) {
                                ?>
                                    <tr>
                                        <td><?=$linha['IDCategoria']?></td>
                                        <td><?=$linha['NomeCategoria']?></td>
                                        <td><?=$linha['Descricao']?></td>
                                        <td class="text-center">
                                            <a href="?page=categoria&action=alterar&id=<?=$linha['IDCategoria']?>">Alterar</a>
                                            <b> | </b>
                                            <a href="?page=categoria&action=deletar&id=<?=$linha['IDCategoria']?>">Deletar</a>
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
    </div>
            

<?php
    } catch(PDOException $e) {
        echo "Erro: {$e->getMessage()}";
    }