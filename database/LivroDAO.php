<?php

include_once "classes/Livro.php";
include_once "EditoraDAO.php";
include_once "AutorDAO.php";

class LivroDAO {
    public static function buscaLivros() {
        $conexao = ConexaoBD::conecta();
        $dados = $conexao->query("select * from livro");
        $livros = array();
        foreach ($dados as $value) {
            $livro = self::buscaLivro($value["codigo"]);
            array_push($livros, $livro);
        }

        return $livros;
    }

    public static function buscaLivro($codigo) {
        $conexao = ConexaoBD::conecta();
        $preparedStatement = $conexao->prepare("select * from livro where livro.codigo = :codigo");
        $preparedStatement->execute(array("codigo" => $codigo));

        $livro = new Livro();
        while ($linha = $preparedStatement->fetch()) {
            $livro->setCodigo($linha["codigo"]);
            $livro->setTitulo($linha["titulo"]);
            $livro->setIsbn($linha["isbn"]);
            $livro->setNumeroPaginas($linha["numpaginas"]);
            $livro->setAnoPublicacao($linha["anopublicacao"]);
            $livro->setNumeroEdicao($linha["numEdicao"]);
            $livro->setEditora(EditoraDAO::buscaEditora($linha["cod_editora"]));
            
            $preparedStatement = $conexao->prepare("select * from livro_autor where livro_autor.codi_livro = :codigoLivro");
            $preparedStatement->execute(array("codigoLivro" => $livro->getCodigo()));
            while ($linha = $preparedStatement->fetch()) {
                $autor = AutorDAO::buscaAutor($linha["cod_autor"]);
                $livro->adicionaAutor($autor);
            }
        }

        return $livro;
    }

    public static function cadastraLivro(Livro $livro) {
        $conexao = ConexaoBD::conecta();
        $sql  = "insert into livro(titulo, isbn, numpaginas, numEdicao, anopublicacao, cod_editora)";
        $sql .= "values (?,?,?,?,?,?)";
        //$sql .= "values (:titulo, :isbn, :numpaginas, :numEdicao, :anopublicacao, :cod_editora)";
        $preparedStatement = $conexao->prepare($sql);
        return $preparedStatement->execute(
            [
                $livro->getTitulo(),
                $livro->getIsbn(),
                $livro->getNumeroPaginas(),
                $livro->getNumeroEdicao(),
                $livro->getAnoPublicacao(),
                $livro->getEditora()->getCodigo()
            ]
        );
    }
}

?>