<?php

namespace controllers;

include_once "classes/Livro.php";
include_once "database/LivroDAO.php";

class LivroController
{
    public function index()
    {
        return [
            "data" => [
                "view" => "cadastraLivro.php",
                "title" => "Cadastro de livro",
                "header" => true,
                "footer" => false
            ]
        ];
    }

    public function cadastra()
    {
        $livro = new \Livro();
        $livro->setTitulo($_POST["titulo"]);
        $livro->setIsbn($_POST["isbn"]);
        $livro->setNumeroPaginas($_POST["numpaginas"]);
        $livro->setNumeroEdicao($_POST["numedicao"]);
        $livro->setAnoPublicacao($_POST["anopublicacao"]);
        $livro->setEditora(new \Editora($_POST["cod_editora"]));

        if (\LivroDAO::cadastraLivro($livro))
                return header("Location: http://localhost/estante_virtual/livros");
    }

    public function listagem()
    {
        return [
            "data" => [
                "view" => "listagemLivros.php",
                "title" => "Listagem de livros",
                "header" => true,
                "footer" => false
            ]
        ];
    }

    public function detalha()
    {
        var_dump($_GET);
    }
}