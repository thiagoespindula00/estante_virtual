<?php

namespace controllers;

class LoginControler
{
    public function index() {
        return [
            "data" => [
                "view" => "login.php",
                "title" => "Login",
                "header" => false,
                "footer" => false
            ]
        ];
    }

    public function login() {
        $_SESSION["lembrarLogin"] = $_REQUEST["lembrarLogin"];
        $_SESSION["usuario"]      = $_REQUEST["usuario"];
        $_SESSION["senha"]        = base64_encode($_REQUEST["senha"]);
        $_SESSION["logado"]       = false;

        if ((empty($_SESSION["usuario"]) || empty($_SESSION["senha"])) || (!isset($_SESSION["usuario"]) || !isset($_SESSION["senha"])))
            return header("Location: /estante_virtual/login");

        if ($_SESSION["usuario"] != "thiago" || $_SESSION["senha"] != base64_encode("teste"))
            return header("Location: /estante_virtual/login");

        $_SESSION["logado"] = true;
        setcookie("lembrarLogin", $_SESSION["lembrarLogin"]);
        if ($_SESSION["lembrarLogin"]) {
            setcookie("usuario", $_SESSION["usuario"]);
            setcookie("senha", $_SESSION["senha"]);
        }

        return header("Location: /estante_virtual");
    }

    public function logout()
    {
        session_destroy();
        return header("Location: /estante_virtual/login");
    }
}
