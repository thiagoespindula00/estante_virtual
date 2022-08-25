<?php

include_once "classes/Estante.php";
include_once "database/LivroDAO.php";

$estante = new Estante();
$listaLivros = LivroDAO::buscaLivros();

foreach ($listaLivros as $livro) {
    $estante->adicionaLivro($livro);
}

?>

<table class="table table-hover">
    <thead>
    <th>
        Titulo livro
    </th>
    <th>
        Autor(es)
    </th>
    <th>
        Editora
    </th>
    </thead>
    <tbody>
    <?php
    foreach ($estante->getListaLivros() as $livro) {
        $strAutores = "";
        echo "<tr>";
        echo "  <td><a href=\"http://localhost/estante_virtual/livros/" . $livro->getCodigo() . "\">" . $livro->getTitulo() . "</a></td>";
        foreach ($livro->getListaAutores() as $autor) {
            if (!empty($strAutores))
                $strAutores .= ", ";
            $strAutores .= "<a href=\"detalheAutor.php?codigoAutor=" . $autor->getCodigo() . "\">" . $autor->getNome() . "</a>";
        }
        echo "  <td>" . $strAutores . "</td>";
        echo "  <td><a href=\"detalheEditora.php?codigoEditora=" . $livro->getEditora()->getCodigo() . "\">" . $livro->getEditora()->getNome() . "</a></td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>


