<?php
    
    if(isset($_POST['cadastrar'])) {
        try{
            $stmt = $conn->prepare("INSERT INTO CATEGORIAS (IDCategoria, NomeCategoria, Descricao) VALUES (:idcategoria, :nomecategoria, :descricao);");
            $stmt->bindParam(':idcategoria', $_POST['IDCategoria']);
            $stmt->bindParam(':nomecategoria', $_POST['nome']);
            $stmt->bindParam(':descricao', $_POST['desc']);
            $stmt->execute();
            header('Location: ?page=categoria');
        } catch (PDOException $e) {
            echo "<h2 class='danger'> Falha ao tentar cadastrar a categoria! Verifique as informações e tente novamente. </h2>";
        }
    }

?>


<div class="container">
    <div class="col-md">
        <div class="row">
            <div class="col-6">
                <h2>Nova Categoria:</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-info float-right" href="?page=categoria">Retornar</a>
            </div>
        </div>
        <hr />
        <form method="POST">
            <div class="form-group">
                <label for="IDCategoria">ID da Categoria:</label>
                <input type="number" class="form-control" name="IDCategoria" id="IDCategoria" placeholder="ID da Categoria" required/>
            </div>
            <div class="form-group">
                <label for="nome">Nome da Categoria:</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome da Categoria" required/>
            </div>
            <div class="form-group">
                <label for="desc">Descrição para a Categoria:</label>
                <input type="text" class="form-control" name="desc" id="desc" placeholder="Descrição para a Catagoria" />
            </div>
            <input class="btn btn-success" type="submit" name="cadastrar" value="Cadastrar"/>
        </form>
        
    </div>
</div>