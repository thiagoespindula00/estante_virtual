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
}
?>