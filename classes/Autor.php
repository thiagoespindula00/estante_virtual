<?php

class Autor
{
    private $codigo;
    private $nome;
    private $email;
    private $webSite;

    public function __construct()
    {
        $this->codigo = 0;
        $this->nome = "";
        $this->email = "";
        $this->webSite = "";
    }

    public function getCodigo()
    {
        return $this->codigo;
    }

    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getWebSite()
    {
        return $this->webSite;
    }

    public function setWebSite($webSite)
    {
        $this->webSite = $webSite;
    }
}

?>