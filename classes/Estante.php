<?php

include_once "classes/Livro.php";

class Estante
{
    private $listaLivros;

    public function __construct()
    {
        $this->listaLivros = array();
    }

    public function getListaLivros()
    {
        return $this->listaLivros;
    }

    public function adicionaLivro(Livro $livro)
    {
        array_push($this->listaLivros, $livro);
    }

    public function getQuantidade()
    {
        return array_count_values($this->listaLivros);
    }

    public function getLivro($posicao)
    {
        return $this->listaLivros[$posicao];
    }
}

?>