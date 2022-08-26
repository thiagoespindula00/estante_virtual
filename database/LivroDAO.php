<?php

include_once "classes/Livro.php";
include_once "EditoraDAO.php";
include_once "AutorDAO.php";

class LivroDAO {
    public static function buscaLivros(Livro $livroFiltro = null)
    {
        $conexao = ConexaoBD::conecta();
        $sql  = "select * from livro";
        if ($livroFiltro != null) {
            $sql .= "\n where";
            if ($livroFiltro->getEditora() != null)
                $sql .= "\n livro.cod_editora = " .$livroFiltro->getEditora()->getCodigo();
        }

        $dados = $conexao->query($sql);
        $livros = array();
        foreach ($dados as $value) {
            $livro = self::buscaLivro($value["codigo"]);
            array_push($livros, $livro);
        }

        return $livros;
    }

    public static function buscaLivro($codigo)
    {
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

    public static function cadastraLivro(Livro $livro)
    {
        $conexao = ConexaoBD::conecta();
        $sql  = "insert into livro(titulo, isbn, numpaginas, numEdicao, anopublicacao, cod_editora)";
        $sql .= "values (?,?,?,?,?,?)";

        $preparedStatement = $conexao->prepare($sql);

        $success = $preparedStatement->execute(
            [
                $livro->getTitulo(),
                $livro->getIsbn(),
                $livro->getNumeroPaginas(),
                $livro->getNumeroEdicao(),
                $livro->getAnoPublicacao(),
                $livro->getEditora()->getCodigo()
            ]
        );

        if (!$success)
            return $success;

        return self::cadastraLivroAutor(self::getCodigoUltimoLivro(), $livro->getListaAutores());

    }

    private static function cadastraLivroAutor($codigoLivro, $listaAutores)
    {
        $conexao = ConexaoBD::conecta();
        $sql  = "insert into livro_autor (codi_livro, cod_autor)";
        $sql .= "values (?,?)";

        $preparedStatement = $conexao->prepare($sql);


        foreach ($listaAutores as $autor) {
            $success = $preparedStatement->execute(
                [
                    $codigoLivro,
                    $autor->getCodigo()
                ]
            );
            if (!$success)
                return $success;
        }

        return true;
    }

    private static function excluiLivroAutor($codigoLivro)
    {
        $conexao = ConexaoBD::conecta();
        $sql  = "delete from livro_autor where livro_autor.codi_livro = " .$codigoLivro;

        return $conexao->exec($sql);
    }


    public static function editaLivro(Livro $livro)
    {
        $conexao = ConexaoBD::conecta();
        $success = false;

        $sql  = "update livro set livro.titulo = ?, livro.isbn = ?, livro.numpaginas = ?, livro.numEdicao = ?, livro.anopublicacao = ?, livro.cod_editora = ?";
        $sql .= "where livro.codigo = " .$livro->getCodigo();

        $preparedStatement = $conexao->prepare($sql);

        $success = $preparedStatement->execute(
            [
                $livro->getTitulo(),
                $livro->getIsbn(),
                $livro->getNumeroPaginas(),
                $livro->getNumeroEdicao(),
                $livro->getAnoPublicacao(),
                $livro->getEditora()->getCodigo()
            ]
        );

        if (!$success)
            return $success;

        self::excluiLivroAutor($livro->getCodigo());

        return self::cadastraLivroAutor($livro->getCodigo(), $livro->getListaAutores());
    }

    public static function excluiLivro($codigoLivro)
    {
        self::excluiLivroAutor($codigoLivro);

        $conexao = ConexaoBD::conecta();
        $sql  = "delete from livro where livro.codigo = " .$codigoLivro;

        return $conexao->exec($sql);
    }

    private static function getCodigoUltimoLivro()
    {
        $conexao = ConexaoBD::conecta();
        $dados = $conexao->query("select * from livro order by codigo desc limit 1");
        $codigo = 0;
        foreach ($dados as $value)
            $codigo = $value["codigo"];

        return $codigo;
    }
}
?>
