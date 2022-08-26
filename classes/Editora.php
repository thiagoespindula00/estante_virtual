<?php

class Editora
{
    private $codigo;
    private $nome;
    private $cidade;
    private $telefone;
    private $email;
    private $webSite;

    public function __construct($codigo = 0)
    {
        $this->codigo = $codigo;
        $this->nome = "";
        $this->cidade = "";
        $this->telefone = "";
        $this->email = "";
        $this->webSite = "";
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

    public function getNome()
    {
        return $this->nome;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
    }

    public function getCidade()
    {
        return $this->cidade;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
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