<?php

namespace controllers;

include_once "classes/Autor.php";
include_once "database/AutorDAO.php";

class AutorController
{

    private function getCodigoAutorUrl()
    {
        $urlSeparada = explode("/", parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
        return end($urlSeparada);
    }

    public function formCadastro()
    {
        return [
            "data" => [
                "view"   => "formAutor.php",
                "title"  => "Cadastro de autor",
                "header" => true,
                "footer" => false
            ]
        ];
    }

    public function formEdicao()
    {
        $autor = \AutorDAO::buscaAutor($this->getCodigoAutorUrl());
        if ($autor->getCodigo() == 0)
            return header("HTTP/1.0 404 Not Found");

        return [
            "data" => [
                "view"          => "formAutor.php",
                "title"         => "Edição de autor",
                "header"        => true,
                "footer"        => false,
                "autorEdicao"   => $autor
            ]
        ];
    }

    public function formExclusao()
    {
        $autor = \AutorDAO::buscaAutor($this->getCodigoAutorUrl());
        if ($autor->getCodigo() == 0)
            return header("HTTP/1.0 404 Not Found");

        $msgErro = "";

        return [
            "data" => [
                "view"         => "deletaRegistro.php",
                "title"        => "Exclusão de autor",
                "header"       => false,
                "footer"       => false,
                "msgErro"      => $msgErro,
                "rotaExclusao" => "http://localhost/estante_virtual/autor/exclui/{$autor->getCodigo()}",
                "rotaCancelar" => "http://localhost/estante_virtual/autores"
            ]
        ];
    }

    private function coletaDados()
    {
        $autor = new \Autor();
        $autor->setNome($_POST["nome"]);
        $autor->setEmail($_POST["email"]);
        $autor->setWebSite($_POST["website"]);

        return $autor;
    }

    public function cadastraAutor() {
        $autor = new \Autor();
        $autor->setNome($_POST["nome"]);
        $autor->setEmail($_POST["email"]);
        $autor->setWebSite($_POST["website"]);

        if (\AutorDAO::cadastraAutor($autor))
            return header("Location: http://localhost/estante_virtual/autores");
    }

    public function editaAutor()
    {
        if (\AutorDAO::buscaAutor($this->getCodigoAutorUrl())->getCodigo() == 0)
            return header("HTTP/1.0 404 Not Found");

        $autor = $this->coletaDados();
        $autor->setCodigo($this->getCodigoAutorUrl());

        if (\AutorDAO::editaAutor($autor))
            return header("Location: http://localhost/estante_virtual/autores");
    }

    public function excluiAutor()
    {
        if (\AutorDAO::buscaAutor($this->getCodigoAutorUrl())->getCodigo() == 0)
            return header("HTTP/1.0 404 Not Found");

        if(\AutorDAO::excluiAutor($this->getCodigoAutorUrl()))
            return header("Location: http://localhost/estante_virtual/autores");
    }

    public function listaAutores()
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

    public function detalhaAutor()
    {
        $autor = \AutorDAO::buscaAutor($this->getCodigoAutorUrl());
        if ($autor->getCodigo() == 0)
            return header("HTTP/1.0 404 Not Found");


        return [
            "data" => [
                "view" => "detalheAutor.php",
                "title" => "Detalhes autor",
                "header" => true,
                "footer" => false,
                "autor"  => $autor
            ]
        ];
    }
}