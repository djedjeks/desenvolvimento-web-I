<!DOCTYPE HTML>
<html lang="pt-br">
     <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Calculadora PHP</title>
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    </head>
    
    <body>
        <?php
            session_start();
            if(!isset($_SESSION["NUM"])){
                $_SESSION["NUM"] = 0;
                $_SESSION["RESULTADO"] = 0;
                $_SESSION["OPERADOR"] = "";
            }
            if(isset($_POST["num"])){
                if($_SESSION["NUM"] == 0){
                    $_SESSION["NUM"] = $_POST["num"];
                } else {
                    $_SESSION["NUM"] = $_SESSION["NUM"] . $_POST["num"];
                }
            }
            if(isset($_POST["op"])){
                switch ($_POST["op"]){
                    case "CE":
                        $_SESSION["RESULTADO"] = 0;
                        $_SESSION["OPERADOR"] = "";
                        $_SESSION["NUM"] = 0;
                        break;
                    case "=":
                        realizaCalculo();
                        $_SESSION["NUM"] = $_SESSION["RESULTADO"];
                        $_SESSION["RESULTADO"] = 0;
                        break;
                    case "+":
                        if($_SESSION["OPERADOR"] != ""){
                            realizaCalculo();
                        }
                        $_SESSION["OPERADOR"] = "+";
                        $_SESSION["RESULTADO"] = $_SESSION["NUM"];
                        $_SESSION["NUM"] = 0;
                        break;
                    case "-":
                        if($_SESSION["OPERADOR"] != ""){
                            realizaCalculo();
                        }
                        $_SESSION["OPERADOR"] = "-";
                        $_SESSION["RESULTADO"] = $_SESSION["NUM"];
                        $_SESSION["NUM"] = 0;
                        break;
                    case "X":
                        if($_SESSION["OPERADOR"] != ""){
                            realizaCalculo();
                        }
                        $_SESSION["OPERADOR"] = "X";
                        $_SESSION["RESULTADO"] = $_SESSION["NUM"];
                        $_SESSION["NUM"] = 0;
                        break;
                    case "%":
                        if($_SESSION["OPERADOR"] != ""){
                            realizaCalculo();
                        }
                        $_SESSION["OPERADOR"] = "%";
                        $_SESSION["RESULTADO"] = $_SESSION["NUM"];
                        $_SESSION["NUM"] = 0;
                        break;
                }
            }

            function realizaCalculo(){
                switch ($_SESSION["OPERADOR"]){
                    case "+":
                        $_SESSION["RESULTADO"] = $_SESSION["RESULTADO"] + $_SESSION["NUM"];
                        break;
                    case "-":
                        $_SESSION["RESULTADO"] = $_SESSION["RESULTADO"] - $_SESSION["NUM"];
                        break;
                    case "X":
                        $_SESSION["RESULTADO"] = $_SESSION["RESULTADO"] * $_SESSION["NUM"];
                        break;
                    case "%":
                        $_SESSION["RESULTADO"] = floatval($_SESSION["RESULTADO"]) / floatval($_SESSION["NUM"]);
                        break;
                }
                $_SESSION["OPERADOR"] = "";
                $_SESSION["NUM"] = 0;
            }
        ?>

        <header>
            <h1 class="text-center">Calculadora PHP</h1>
        </header>
        <hr>

        <main>
            <form method="post" class="container calculadora" action="index.php">
                <div class="row">
                    <div class="col-12 resultado"> <?php echo $_SESSION["NUM"] <> 0 ? $_SESSION["NUM"] : $_SESSION["RESULTADO"]; ?></div>
                </div>
                <div class="row">
                    <input class="col-3 text-center bot_calc" type="submit" name="num" value="7" >
                    <input class="col-3 text-center bot_calc" type="submit" name="num" value="8" >
                    <input class="col-3 text-center bot_calc" type="submit" name="num" value="9" >
                    <input class="col-3 text-center bot_calc" type="submit" name="op" value="%" >
                </div>
                <div class="row">
                    <input class="col-3 text-center bot_calc" type="submit" name="num" value="4" >
                    <input class="col-3 text-center bot_calc" type="submit" name="num" value="5" >
                    <input class="col-3 text-center bot_calc" type="submit" name="num" value="6" >
                    <input class="col-3 text-center bot_calc" type="submit" name="op" value="X" >
                </div>
                <div class="row">
                    <input class="col-3 text-center bot_calc" type="submit" name="num" value="1" >
                    <input class="col-3 text-center bot_calc" type="submit" name="num" value="2" >
                    <input class="col-3 text-center bot_calc" type="submit" name="num" value="3" >
                    <input class="col-3 text-center bot_calc" type="submit" name="op" value="+" >
                </div>
                <div class="row">
                    <input class="col-3 text-center bot_calc" type="submit" name="num" value="0" >
                    <input class="col-3 text-center bot_calc" type="submit" name="op" value="CE" >
                    <input class="col-3 text-center bot_calc" type="submit" name="op" value="=" >
                    <input class="col-3 text-center bot_calc" type="submit" name="op" value="-" >
                </div>
            </div>
        </main>

    </body>

</html>