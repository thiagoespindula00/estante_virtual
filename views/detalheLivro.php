<?php 
    include_once "funcoes.php";
    include_once "Estante.php";
    include_once "LivroDAO.php";

    validaSessao();

    $codigoLivro = $_REQUEST["codigoLivro"];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="icon" href="https://cdn-icons.flaticon.com/png/512/5832/premium/5832416.png?token=exp=1649628173~hmac=4122928727bd855eee1b1abe61af39d1" sizes="32x32" type="image/png">
</head>
<body>
    <main style="margin: 10px;">
        <?php 
            $livro = LivroDAO::buscaLivro($codigoLivro);

            echo $livro->getCodigo() ."<br>";
            echo $livro->getTitulo() ."<br>";
            echo $livro->getIsbn() ."<br>";
            echo $livro->getNumeroPaginas() ."<br>";
            echo $livro->getAnoPublicacao() ."<br>";
            echo $livro->getNumeroEdicao() ."<br>";
            $strAutores = "";
            foreach ($livro->getListaAutores() as $autor) {
                if (!empty($strAutores))
                    $strAutores .= ", ";
                $strAutores .= "<a href=\"detalheAutor.php?codigoAutor=" .$autor->getCodigo(). "\">" .$autor->getNome(). "</a>";
            }
            echo $strAutores . "<br>";
            echo "<a href=\"detalheEditora.php?codigoEditora=" .$livro->getEditora()->getCodigo(). "\">" . $livro->getEditora()->getNome() . "</a><br>";

        ?>
    </main>
</body>
</html>
