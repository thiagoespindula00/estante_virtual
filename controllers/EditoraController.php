<?php

namespace controllers;

include_once "classes/Editora.php";
include_once "database/EditoraDAO.php";

class EditoraController
{

    private function getCodigoEditoraUrl()
    {
        $urlSeparada = explode("/", parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH));
        return end($urlSeparada);
    }

    public function formCadastro() {
        return [
            "data" => [
                "view" => "formEditora.php",
                "title" => "Cadastro de editora",
                "header" => true,
                "footer" => false
            ]
        ];
    }

    public function formEdicao()
    {
        $editora = \EditoraDAO::buscaEditora($this->getCodigoEditoraUrl());
        if ($editora->getCodigo() == 0)
            return header("HTTP/1.0 404 Not Found");

        return [
            "data" => [
                "view"          => "formEditora.php",
                "title"         => "Edição de editora",
                "header"        => true,
                "footer"        => false,
                "editoraEdicao" => $editora
            ]
        ];
    }

    public function formExclusao()
    {
        $editora = \EditoraDAO::buscaEditora($this->getCodigoEditoraUrl());
        if ($editora->getCodigo() == 0)
            return header("HTTP/1.0 404 Not Found");

        $msgErro = "";
        $livroFiltro = new \Livro();
        $livroFiltro->setEditora(new \Editora($this->getCodigoEditoraUrl()));
        $livros = \LivroDAO::buscaLivros($livroFiltro);

        if (count($livros) > 0) {
            $msgErro = "Existem livros cadastrados para esta editora! <br> Exclua-os primeiro!";
        }

        return [
            "data" => [
                "view"         => "deletaRegistro.php",
                "title"        => "Exclusão de editora",
                "header"       => false,
                "footer"       => false,
                "msgErro"      => $msgErro,
                "rotaExclusao" => "http://localhost/estante_virtual/editora/exclui/{$editora->getCodigo()}",
                "rotaCancelar" => "http://localhost/estante_virtual/editoras"
            ]
        ];
    }

    private function coletaDados()
    {
        $editora = new \Editora();
        $editora->setNome($_POST["nome"]);
        $editora->setCidade($_POST["cidade"]);
        $editora->setTelefone($_POST["telefone"]);
        $editora->setEmail($_POST["email"]);
        $editora->setWebSite($_POST["website"]);

        return $editora;
    }

    public function cadastraEditora() {
        $editora = new \Editora();
        $editora->setNome($_POST["nome"]);
        $editora->setCidade($_POST["cidade"]);
        $editora->setTelefone($_POST["telefone"]);
        $editora->setEmail($_POST["email"]);
        $editora->setWebSite($_POST["website"]);

        if (\EditoraDAO::cadastraEditora($editora))
            return header("Location: http://localhost/estante_virtual/editoras");
    }

    public function editaEditora()
    {
        $editora = \EditoraDAO::buscaEditora($this->getCodigoEditoraUrl());
        if ($editora->getCodigo() == 0)
            return header("HTTP/1.0 404 Not Found");

        $editora = $this->coletaDados();
        $editora->setCodigo($this->getCodigoEditoraUrl());

        if (\EditoraDAO::editaEditora($editora))
            return header("Location: http://localhost/estante_virtual/editoras");
    }

    public function excluiEditora()
    {
        if (\EditoraDAO::buscaEditora($this->getCodigoEditoraUrl())->getCodigo() == 0)
            return header("HTTP/1.0 404 Not Found");

        if (\EditoraDAO::excluiEditora($this->getCodigoEditoraUrl()))
            return header("Location: http://localhost/estante_virtual/editoras");
    }

    public function listaEditoras() {
        return [
            "data" => [
                "view"   => "listagemEditoras.php",
                "title"  => "Listagem de editoras",
                "header" => true,
                "footer" => false
            ]
        ];
    }

    public function detalhaEditora()
    {
        $editora = \EditoraDAO::buscaEditora($this->getCodigoEditoraUrl());
        if ($editora->getCodigo() == 0)
            return header("HTTP/1.0 404 Not Found");

        return [
            "data" => [
                "view"    => "detalheEditora.php",
                "title"   => "Detalhes editora",
                "header"  => true,
                "footer"  => false,
                "editora" => $editora
            ]
        ];
    }
}