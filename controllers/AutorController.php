<?php

namespace controllers;

include_once "classes/Autor.php";
include_once "database/AutorDAO.php";

class AutorController
{
    public function index()
    {
        return [
            "data" => [
                "view" => "cadastraAutor.php",
                "title" => "Cadastro de autor",
                "header" => true,
                "footer" => false
            ]
        ];
    }

    public function cadastra() {
        $autor = new \Autor();
        $autor->setNome($_POST["nome"]);
        $autor->setEmail($_POST["email"]);
        $autor->setWebSite($_POST["website"]);

        if (\AutorDAO::cadastraAutor($autor))
            return header("Location: http://localhost/estante_virtual/autores");
    }

    public function listagem()
    {
        return [
            "data" => [
                "view" => "listagemAutores.php",
                "title" => "Listagem de autores",
                "header" => true,
                "footer" => false
            ]
        ];
    }
}