<?php

include_once "classes/Autor.php";
include_once "ConexaoBD.php";

class AutorDAO {

    public static function buscaAutores() {
        $conexao = ConexaoBD::conecta();
        $dados = $conexao->query("select * from autor");
        $autores = array();
        foreach ($dados as $value) {
            $autor = self::buscaAutor($value["codigo"]);
            array_push($autores, $autor);
        }

        return $autores;
    }

    public static function buscaAutor($codigo) {
        $conexao = ConexaoBD::conecta();
        $preparedStatement = $conexao->prepare("select * from autor where autor.codigo = :codigo");
        $preparedStatement->execute(array("codigo" => $codigo));

        $autor = new Autor();
        while ($linha = $preparedStatement->fetch()) {
            $autor->setCodigo($linha["codigo"]);
            $autor->setNome($linha["nome"]);
            $autor->setEmail($linha["email"]);
            $autor->setWebSite($linha["website"]);
        }

        return $autor;
    }

    public static function cadastraAutor(Autor $autor) {
        $conexao = ConexaoBD::conecta();
        $sql  = "insert into autor (nome, email, website)";
        $sql .= "values (?,?,?)";
        $preparedStatement = $conexao->prepare($sql);

        return $preparedStatement->execute(
            [
                $autor->getNome(),
                $autor->getEmail(),
                $autor->getWebSite()
            ]
        );
    }

    public static function editaAutor(Autor $autor)
    {
        $conexao = ConexaoBD::conecta();
        $sql = "update autor set nome = ?, email = ?, website = ?";
        $sql .= "where autor.codigo = " .$autor->getCodigo();

        $preparedStatement = $conexao->prepare($sql);

        return $preparedStatement->execute(
            [
                $autor->getNome(),
                $autor->getEmail(),
                $autor->getWebSite()
            ]
        );
    }

    public static function excluiAutor($codigoAutor)
    {
        self::exluiAutorLivro($codigoAutor);

        $conexao = ConexaoBD::conecta();
        $sql  = "delete from autor where autor.codigo = " .$codigoAutor;

        return $conexao->exec($sql);
    }

    private static function exluiAutorLivro($codigoAutor)
    {
        $conexao = ConexaoBD::conecta();
        $sql  = "delete from livro_autor where livro_autor.cod_autor = " .$codigoAutor;

        return $conexao->exec($sql);
    }
}

?>