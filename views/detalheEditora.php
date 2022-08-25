<?php 
    include_once "funcoes.php";
    
    include_once "EditoraDAO.php";

    validaSessao();

    $codigoEditora = $_REQUEST["codigoEditora"];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editora</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="https://cdn-icons.flaticon.com/png/512/5832/premium/5832416.png?token=exp=1649628173~hmac=4122928727bd855eee1b1abe61af39d1" sizes="32x32" type="image/png">
</head>
<body>
    <main style="margin: 10px;">
        <?php 
            $editora = EditoraDAO::buscaEditora($codigoEditora);

            echo $editora->getCodigo() . "<br>";
            echo $editora->getNome() ."<br>";
            echo $editora->getCidade() ."<br>";
            echo $editora->getTelefone() ."<br>";
            echo $editora->getEmail() ."<br>";
            echo $editora->getWebSite() ."<br>";
        ?>
    </main>
</body>
</html>
