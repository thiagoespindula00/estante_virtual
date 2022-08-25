<?php

class ConexaoBD {
    public static function conecta() {
        return new PDO("mysql:host=127.0.0.1;dbname=estante", "root", "");;
    }
}

?>
