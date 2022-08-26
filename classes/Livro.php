<?php

include_once "classes/Editora.php";
include_once "classes/Autor.php";

class Livro
{
    private $codigo;
    private $titulo;
    private $isbn;
    private $numeroPaginas;
    private $anoPublicacao;
    private $numeroEdicao;
    private $listaAutores;
    private $editora;

    public function __construct()
    {
        $this->codigo = 0;
        $this->titulo = "";
        $this->isbn = "";
        $this->numeroPaginas = 0;
        $this->anoPublicacao = 0;
        $this->numeroEdicao = 0;
        $this->listaAutores = array();
        $this->editora = new Editora();
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo)
    {
        if (!empty($codigo))
            $this->codigo = $codigo;
    }

    public function getTitulo()
    {
        return $this->titulo;
    }

    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    public function getIsbn()
    {
        return $this->isbn;
    }

    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    public function getNumeroPaginas()
    {
        return $this->numeroPaginas;
    }

    public function setNumeroPaginas($numeroPaginas)
    {
        if (!empty($numeroPaginas))
            $this->numeroPaginas = $numeroPaginas;
    }

    public function getAnoPublicacao()
    {
        return $this->anoPublicacao;
    }

    public function setAnoPublicacao($anoPublicacao)
    {
        if (!empty($anoPublicacao))
            $this->anoPublicacao = $anoPublicacao;
    }

    public function getNumeroEdicao()
    {
        return $this->numeroEdicao;
    }

    public function setNumeroEdicao($numeroEdicao)
    {
        if (!empty($numeroEdicao))
            $this->numeroEdicao = $numeroEdicao;
    }

    public function getListaAutores()
    {
        return $this->listaAutores;
    }

    public function adicionaAutor(Autor $autor)
    {
        array_push($this->listaAutores, $autor);
    }

    public function getAutor($posicao)
    {
        return $this->listaAutores[$posicao];
    }

    public function getEditora()
    {
        return $this->editora;
    }

    public function setEditora(Editora $editora)
    {
        $this->editora = $editora;
    }
}

?>
