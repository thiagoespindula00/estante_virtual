<?php

include_once "classes/Rotas.php";

try {
    session_start();

    $dataRoute = Rotas::rota();

    if (empty($dataRoute))
        die();

    if (!isset($dataRoute["data"]))
        throw new Exception("O indice data não foi definido");

    if (!isset($dataRoute["data"]["view"]))
        throw new Exception("O índice views não foi definido");

    if (!file_exists(VIEWS_PATH.$dataRoute["data"]["view"]))
        throw new Exception("A view {$dataRoute["data"]["view"]} não existe");

    extract($dataRoute["data"]);

    require_once "views/master.php";

} catch (Exception $exception) {
    echo $exception->getMessage();
}

?>
