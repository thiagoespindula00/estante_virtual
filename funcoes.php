<?php
function ehUsuarioValido($usuario, $senha) {
    if ($usuario != "thiago" || $senha != base64_encode("teste"))
        return false;

    return true;
}

function validaSessao() {
    session_start();
    if (!ehUsuarioValido($_SESSION["usuario"], $_SESSION["senha"])) {
        header("Location: /estante_virtual/login.php");
        return;
    }
}
