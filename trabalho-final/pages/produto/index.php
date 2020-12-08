<?php
    if(isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'cadastrar':
                include_once('./pages/produto/cadastro.php');
                break;
            case 'alterar':
                include_once('./pages/produto/alteracao.php');
                break;
            case 'deletar':
                if(isset($_GET['id'])){
                    $stmt = $conn->prepare("DELETE FROM PRODUTOS WHERE IDProduto = :id;");
                    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                    $stmt->execute();
                header('Location: ?page=produto');
            }
            break;
            default:
                include_once('./pages/produto/listagem.php');
                break;
        }
    } else {
        include_once('./pages/produto/listagem.php');
    }