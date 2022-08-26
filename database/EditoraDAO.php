<?php

include_once "classes/Editora.php";
include_once "ConexaoBD.php";

class EditoraDAO {

    public static function buscaEditoras(){
        $conexao = ConexaoBD::conecta();
        $dados = $conexao->query("select * from editora");
        $editoras = array();
        foreach ($dados as $value) {
            $editora = self::buscaEditora($value["codigo"]);
            array_push($editoras, $editora);
        }

        return $editoras;
    }

    public static function buscaEditora($id) {
        $conexao = ConexaoBD::conecta();
        $prepareStatement = $conexao->prepare("select * from editora where editora.codigo = :codigo");
        $prepareStatement->execute(array("codigo" => $id));

        $editora = new Editora();
        while ($linha = $prepareStatement->fetch()) {
            $editora->setCodigo($linha["codigo"]);
            $editora->setNome($linha["nome"]);
            $editora->setCidade($linha["cidade"]);
            $editora->setTelefone($linha["telefone"]);
            $editora->setEmail($linha["email"]);
            $editora->setWebSite($linha["WEBSITE"]);
        }

        return $editora;
    }

    public static function cadastraEditora(Editora $editora) {
        $conexao = ConexaoBD::conecta();
        $sql  = "insert into editora(nome, cidade, telefone, email, WEBSITE)";
        $sql .= "values(?,?,?,?,?)";
        $preparedStatement = $conexao->prepare($sql);
        return $preparedStatement->execute(
            [
                $editora->getNome(),
                $editora->getCidade(),
                $editora->getTelefone(),
                $editora->getEmail(),
                $editora->getWebSite()
            ]
        );
    }

    public static function editaEditora(Editora $editora)
    {
        $conexao = ConexaoBD::conecta();

        $sql  = "update editora set editora.nome = ?, editora.cidade = ?, editora.telefone = ?, editora.email = ?, editora.WEBSITE = ?";
        $sql .= "where editora.codigo = " .$editora->getCodigo();

        $preparedStatement = $conexao->prepare($sql);

        return $preparedStatement->execute(
            [
                $editora->getNome(),
                $editora->getCidade(),
                $editora->getTelefone(),
                $editora->getEmail(),
                $editora->getWebSite()
            ]
        );
    }

    public static function excluiEditora($codigoEditora)
    {
        $conexao = ConexaoBD::conecta();
        $sql  = "delete from editora where editora.codigo = " .$codigoEditora;

        return $conexao->exec($sql);
    }
}
?>