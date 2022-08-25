<?php

include_once "constantes.php";

$files = glob(ROOT."\\".CONTROLLER_PATH."*.php");

foreach ($files as $file) {
    require($file);
}

class Rotas
{
    public static function rota()
    {
        $uri = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $routes = self::listaRotas();
        $requestMethod = $_SERVER["REQUEST_METHOD"];

        $matchedUri = self::uriExata($uri, $routes[$requestMethod]);


        if (empty($matchedUri))
            $matchedUri = self::uriDinamica($uri, $routes[$requestMethod]);

        if (!empty($matchedUri)) {
            $controller = self::carregaController($matchedUri);

            if ((!isset($_SESSION["logado"]) || !$_SESSION["logado"]) && !array_key_exists("/estante_virtual/login", $matchedUri))
                header("Location: http://localhost/estante_virtual/login");

            return $controller;
        }

        http_response_code(404);
        return [];
    }

    private static function listaRotas()
    {
        return [
            "POST" => [
                "/estante_virtual/login"            => "LoginControler@login",
                "/estante_virtual/livro/cadastro"   => "LivroController@cadastra",
                "/estante_virtual/editora/cadastro" => "EditoraController@cadastra",
                "/estante_virtual/autor/cadastro"   => "AutorController@cadastra"
            ],
            "GET" => [
                "/estante_virtual/"                 => "HomeController@index",
                "/estante_virtual/login"            => "LoginControler@index",
                "/estante_virtual/logout"           => "LoginControler@logout",
                "/estante_virtual/livro/cadastro"   => "LivroController@index",
                "/estante_virtual/livro/[0-9]+"     => "LivroController@detalha",
                "/estante_virtual/livros"           => "LivroController@listagem",
                "/estante_virtual/editora/cadastro" => "EditoraController@index",
                "/estante_virtual/editora/[0-9]+"   => "EditoraController@detalha",
                "/estante_virtual/editoras"        => "EditoraController@listagem",
                "/estante_virtual/autor/cadastro"   => "AutorController@index",
                "/estante_virtual/autor/[0-9]+"     => "AutorController@detalha",
                "/estante_virtual/autores"          => "AutorController@listagem"
            ]
        ];
    }

    private static function uriExata($uri, $routes)
    {
        if (array_key_exists($uri, $routes)) {
            return [$uri => $routes[$uri]];
        }

        return [];
    }

    private static function uriDinamica($uri, $routes)
    {
        return array_filter(
            $routes,
            function ($value) use ($uri) {
                $regex = str_replace("/", "\/", ltrim($value, "/"));
                return preg_match("/^$regex$/", ltrim($uri, "/"));
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    private static function carregaController($matchedUri)
    {
        list($controller, $method) = explode("@", array_values($matchedUri)[0]);
        $controllerWithNamespace = CONTROLLER_PATH.$controller;
        if (!class_exists($controllerWithNamespace))
            throw new \Exception("Controller {$controller} não encontrado");

        $controllerInstance = new $controllerWithNamespace;
        if (!method_exists($controllerInstance, $method))
            throw new \Exception("Método {$method} do controller {$controller} não encontrado");

        //if ($_SERVER["REQUEST_METHOD"] == "POST")
        //    die();

        return $controllerInstance->$method();
    }
}
