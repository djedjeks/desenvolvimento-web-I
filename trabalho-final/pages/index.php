<?php
    if(isset($_SESSION['usuariologado']) && $_SESSION['usuariologado']){
        include 'header.php';

        if(isset($_GET['page'])) {
            switch ($_GET['page']) {
                case 'categoria':
                    include_once('./pages/categorias/index.php');
                    break;
                case 'fornecedor':
                    include_once('./pages/fornecedores/index.php');
                    break;
                case 'produto':
                    include_once('./pages/produtos/index.php');
                    break;
                case 'logoff':
                    $_SESSION['usuariologado'] = false;
                    header('Location: ./');
                    break;
                default:
                    include_once('./pages/home.php');
                    break;
            }
        } else {
            include_once('./pages/home.php');
        }

        include 'footer.php';

    } else {
        if(isset($_GET['action']) && $_GET['action'] == 'cadastrar'){
            include 'cadastro.php';
        } else {
            include 'login.php';
        }
    }