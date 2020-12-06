<?php
    if(isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'cadastrar':
                include_once('./pages/categoria/cadastro.php');
                break;
            case 'alterar':
                include_once('./pages/categoria/alteracao.php');
                break;
            case 'deletar':
                if(isset($_GET['id'])){
                    $stmt = $conn->prepare("DELETE FROM CATEGORIAS WHERE IDCategoria = :id;");
                    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                    $stmt->execute();
                header('Location: ?page=categoria');
            }
            break;
            default:
                include_once('./pages/categoria/listagem.php');
                break;
        }
    } else {
        include_once('./pages/categoria/listagem.php');
    }