<?php

    if(isset($_POST['alterar'])) {
        try{
            $stmt = $conn->prepare("UPDATE CATEGORIAS SET NomeCategoria = :nome, Descricao = :desc where IDCategoria = :id;");
            $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
            $stmt->bindParam(':nome', $_POST['nome']);
            $stmt->bindParam(':desc', $_POST['desc']);
            $stmt->execute();
            header('Location: ?page=categoria');
        } catch (PDOException $e) {
            echo "Erro: {$e->getMessage()}";
        }
    }

    if(isset($_GET['id'])) {
        $stmt = $conn->prepare("SELECT * FROM Categorias WHERE IDCategoria = :id;");
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
                <h2>Alterar Categoria:</h2>
            </div>
            <div class="col-6">
                <a class="btn btn-success float-right" href="?page=categoria">Listagem de Categorias</a>
            </div>
        </div>
        <hr />
        <form method="POST">
            <div class="form-group">
                <label for="nome">Nome da Categoria:</label>
                <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome da Categoria" value="<?=$result[0]['NomeCategoria']?>"/>
            </div>
            <div class="form-group">
                <label for="desc">Descrição para a Categoria:</label>
                <input type="text" class="form-control" name="desc" id="desc" placeholder="Descrição para a Catagoria" value="<?=$result[0]['Descricao']?>"/>
            </div>
            <input class="btn btn-success" type="submit" name="alterar" value="Alterar"/>
        </form>
        
    </div>
</div>



<hr>
<br />
<!--
    <p> Não possui uma conta? [<a href="./cadastro.php">Cadastre-se</a>] </p>
-->