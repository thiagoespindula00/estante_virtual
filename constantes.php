<?php

const ERRO_LOGIN_USUARIO_SENHA_INVALIDO = 1;

$statusMsg = [
    ERRO_LOGIN_USUARIO_SENHA_INVALIDO => "Usuário e/ou senha inválido!"
];

define("ROOT", dirname(__FILE__, 1));
define("CONTROLLER_PATH", "controllers\\");
define("VIEWS_PATH", "views\\");