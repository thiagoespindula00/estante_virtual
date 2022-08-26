<?php

namespace controllers;

include_once "classes/Livro.php";
include_once "database/LivroDAO.php";

class LivroController
{
    private function getCodigoLivroUrl()
    {
        $urlSeparada = explode("/", parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
        return end($urlSeparada);
    }


    public function formCadastro()
    {
        return [
            "data" => [
                "view"   => "formLivro.php",
                "title"  => "Cadastro de livro",
                "header" => true,
                "footer" => false
            ]
        ];
    }

    public function formEdicao()
    {
        $livro = \LivroDAO::buscaLivro($this->getCodigoLivroUrl());
        if ($livro->getCodigo() == 0)
            return header("HTTP/1.0 404 Not Found");

        return [
            "data" => [
                "view"        => "formLivro.php",
                "title"       => "Edição de livro",
                "header"      => true,
                "footer"      => false,
                "livroEdicao" => $livro
            ]
        ];
    }

    public function formExclusao()
    {
        $livro = \LivroDAO::buscaLivro($this->getCodigoLivroUrl());
        if ($livro->getCodigo() == 0)
            return header("HTTP/1.0 404 Not Found");

        $msgErro = "";

        return [
            "data" => [
                "view"         => "deletaRegistro.php",
                "title"        => "Exclusão de livro",
                "header"       => false,
                "footer"       => false,
                "msgErro"      => $msgErro,
                "rotaExclusao" => "http://localhost/estante_virtual/livro/exclui/{$livro->getCodigo()}",
                "rotaCancelar" => "http://localhost/estante_virtual/livros"
            ]
        ];
    }

    private function coletaDados()
    {
        $livro = new \Livro();
        $livro->setTitulo($_POST["titulo"]);
        $livro->setIsbn($_POST["isbn"]);
        $livro->setNumeroPaginas($_POST["numpaginas"]);
        $livro->setNumeroEdicao($_POST["numedicao"]);
        $livro->setAnoPublicacao($_POST["anopublicacao"]);
        $livro->setEditora(new \Editora($_POST["cod_editora"]));

        $listaAutores = [];
        if (isset($_POST["autores"]))
            $listaAutores = $_POST["autores"];

        foreach ($listaAutores as $autor) {
            $livro->adicionaAutor(new \Autor($autor));
        }

        return $livro;
    }

    public function cadastraLivro()
    {
        if (\LivroDAO::cadastraLivro($this->coletaDados()))
                return header("Location: http://localhost/estante_virtual/livros");
    }

    public function editaLivro()
    {
        if (\LivroDAO::buscaLivro($this->getCodigoLivroUrl())->getCodigo() == 0)
            return header("HTTP/1.0 404 Not Found");

        $livro = $this->coletaDados();
        $livro->setCodigo($this->getCodigoLivroUrl());

        if (\LivroDAO::editaLivro($livro))
            return header("Location: http://localhost/estante_virtual/livros");
    }

    public function excluiLivro()
    {
        if (\LivroDAO::buscaLivro($this->getCodigoLivroUrl())->getCodigo() == 0)
            return header("HTTP/1.0 404 Not Found");

        if(\LivroDAO::excluiLivro($this->getCodigoLivroUrl()))
            return header("Location: http://localhost/estante_virtual/livros");
    }

    public function listaLivros()
    {
        return [
            "data" => [
                "view"   => "listagemLivros.php",
                "title"  => "Listagem de livros",
                "header" => true,
                "footer" => false
            ]
        ];
    }

    public function detalhaLivro()
    {
        $livro = \LivroDAO::buscaLivro($this->getCodigoLivroUrl());
        if ($livro->getCodigo() == 0)
            return header("HTTP/1.0 404 Not Found");

        return [
            "data" => [
                "view"   => "detalheLivro.php",
                "title"  => "Detalhes livro",
                "header" => true,
                "footer" => false,
                "livro"  => $livro
            ]
        ];
    }
}