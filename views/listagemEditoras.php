<?php

include_once "database/EditoraDAO.php";

$editoras = EditoraDAO::buscaEditoras();

?>

<table class="table table-hover">
    <thead>
    <th>
        Nome
    </th>
    <th>
        Telefone
    </th>
    <th>
        E-mail
    </th>
    </thead>
    <tbody>
    <?php
        foreach ($editoras as $editora) {
            echo "<tr>";
            echo "    <td>{$editora->getNome()}</td>";
            echo "    <td>{$editora->getTelefone()}</td>";
            echo "    <td>{$editora->getEmail()}</td>";
            echo "</tr>";
        }
    ?>
    </tbody>
</table>
