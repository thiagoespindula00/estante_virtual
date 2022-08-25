<?php

include "constantes.php";
include "funcoes.php";

validaSessao();

if (empty($_REQUEST)) {
    header("Location: logout.php");
    return;
}

$_SESSION["lembrarLogin"] = $_REQUEST["lembrarLogin"];
$_SESSION["usuario"]      = $_REQUEST["usuario"];
$_SESSION["senha"]        = base64_encode($_REQUEST["senha"]);
$_SESSION["status"]       = 0;



if (!ehUsuarioValido($_SESSION["usuario"], $_SESSION["senha"])) {
    $_SESSION["status"] = ERRO_LOGIN_USUARIO_SENHA_INVALIDO;
    header("Location: /estante_virtual");
    return;
}

setcookie("lembrarLogin", $_SESSION["lembrarLogin"]);
if ($_SESSION["lembrarLogin"]) {
    setcookie("usuario", $_SESSION["usuario"]);
    setcookie("senha", $_SESSION["senha"]);
}

header("Location: listagemLivros.php");

?>