<?php

class FrontendController
{
    public function pessoas()
    {
        require_once __DIR__ . '/../Views/pessoas/index.php';
    }

    public function tiposAtendimentos()
    {
        require_once __DIR__ . '/../Views/tipos-atendimentos/index.php';
    }

    public function atendimentos()
    {
        require_once __DIR__ . '/../Views/atendimentos/index.php';
    }
}