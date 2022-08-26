<?php

namespace controllers;

class HomeController
{
    public function index()
    {
        return [
            "data" => [
                "view" => "home.php",
                "title" => "Home",
                "header" => true,
                "footer" => true
            ]
        ];
    }
}