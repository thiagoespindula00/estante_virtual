<?php

namespace controllers;

include_once "classes/Editora.php";
include_once "database/EditoraDAO.php";

class EditoraController
{
    public function index() {
        return [
            "data" => [
                "view" => "cadastraEditora.php",
                "title" => "Cadastro de editora",
                "header" => true,
                "footer" => false
            ]
        ];
    }

    public function cadastra() {
        $editora = new \Editora();
        $editora->setNome($_POST["nome"]);
        $editora->setCidade($_POST["cidade"]);
        $editora->setTelefone($_POST["telefone"]);
        $editora->setEmail($_POST["email"]);
        $editora->setWebSite($_POST["website"]);

        if (\EditoraDAO::cadastraEditora($editora))
            return header("Location: http://localhost/estante_virtual/editoras");
    }

    public function listagem() {
        return [
            "data" => [
                "view" => "listagemEditoras.php",
                "title" => "Listagem de editoras",
                "header" => true,
                "footer" => false
            ]
        ];
    }
}