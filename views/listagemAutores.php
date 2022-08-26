<?php

include_once "database/AutorDAO.php";

$autores = AutorDAO::buscaAutores();

?>

<table class="table table-hover">
    <thead>
    <th>
        Nome
    </th>
    <th>
        E-mail
    </th>
    <th>
        Web site
    </th>
    </thead>
    <tbody>
    <?php
    foreach ($autores as $autor) {
        echo "<tr>";
        echo "    <td><a href=\"http://localhost/estante_virtual/autor/" .$autor->getCodigo(). "\">{$autor->getNome()}</a></td>";
        echo "    <td>{$autor->getEmail()}</td>";
        echo "    <td>{$autor->getWebsite()}</td>";
        echo "</tr>";
    }
    ?>
    </tbody>
</table>
