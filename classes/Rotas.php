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

        header("HTTP/1.0 404 Not Found");
        return [];
    }

    private static function listaRotas()
    {
        return [
            "POST" => [
                "/estante_virtual/login"                 => "LoginControler@login",
                "/estante_virtual/livro/cadastro"        => "LivroController@cadastraLivro",
                "/estante_virtual/livro/edicao/[0-9]+"   => "LivroController@editaLivro",
                "/estante_virtual/livro/exclui/[0-9]+"   => "LivroController@excluiLivro",
                "/estante_virtual/editora/cadastro"      => "EditoraController@cadastraEditora",
                "/estante_virtual/editora/edicao/[0-9]+" => "EditoraController@editaEditora",
                "/estante_virtual/editora/exclui/[0-9]+" => "EditoraController@excluiEditora",
                "/estante_virtual/autor/cadastro"        => "AutorController@cadastraAutor",
                "/estante_virtual/autor/edicao/[0-9]+"   => "AutorController@editaAutor",
                "/estante_virtual/autor/exclui/[0-9]+"   => "AutorController@excluiAutor"
            ],
            "GET" => [
                "/estante_virtual/"                      => "HomeController@index",
                "/estante_virtual/login"                 => "LoginControler@index",
                "/estante_virtual/logout"                => "LoginControler@logout",
                "/estante_virtual/livro/cadastro"        => "LivroController@formCadastro",
                "/estante_virtual/livro/edicao/[0-9]+"   => "LivroController@formEdicao",
                "/estante_virtual/livro/exclui/[0-9]+"   => "LivroController@formExclusao",
                "/estante_virtual/livro/[0-9]+"          => "LivroController@detalhaLivro",
                "/estante_virtual/livros"                => "LivroController@listaLivros",
                "/estante_virtual/editora/cadastro"      => "EditoraController@formCadastro",
                "/estante_virtual/editora/edicao/[0-9]+" => "EditoraController@formEdicao",
                "/estante_virtual/editora/exclui/[0-9]+" => "EditoraController@formExclusao",
                "/estante_virtual/editora/[0-9]+"        => "EditoraController@detalhaEditora",
                "/estante_virtual/editoras"              => "EditoraController@listaEditoras",
                "/estante_virtual/autor/cadastro"        => "AutorController@formCadastro",
                "/estante_virtual/autor/edicao/[0-9]+"   => "AutorController@formEdicao",
                "/estante_virtual/autor/exclui/[0-9]+"   => "AutorController@formExclusao",
                "/estante_virtual/autor/[0-9]+"          => "AutorController@detalhaAutor",
                "/estante_virtual/autores"               => "AutorController@listaAutores"
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

        return $controllerInstance->$method();
    }
}
