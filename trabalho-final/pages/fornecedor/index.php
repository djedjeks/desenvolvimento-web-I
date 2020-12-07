<?php
    if(isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'cadastrar':
                include_once('./pages/fornecedor/cadastro.php');
                break;
            case 'alterar':
                include_once('./pages/fornecedor/alteracao.php');
                break;
            case 'deletar':
                if(isset($_GET['id'])){
                    $stmt = $conn->prepare("DELETE FROM fornecedores WHERE IDFornecedor = :id;");
                    $stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
                    $stmt->execute();
                header('Location: ?page=fornecedor');
            }
            break;
            default:
                include_once('./pages/fornecedor/listagem.php');
                break;
        }
    } else {
        include_once('./pages/fornecedor/listagem.php');
    }