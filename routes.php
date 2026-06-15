<?php
require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/app/Controllers/UsuariosController.php';
require_once __DIR__ . '/app/Controllers/PessoasController.php';
require_once __DIR__ . '/app/Controllers/TiposAtendimentosController.php';
require_once __DIR__ . '/app/Middleware/auth.php';

$controller = $_GET['controller'] ?? 'auth';
$action = $_GET['action'] ?? 'login';

if ($controller === 'auth') {
    $authController = new AuthController();
    switch ($action) {
        case 'login': $authController->exibirLogin(); break;
        case 'entrar': $authController->entrar(); break;
        case 'dashboard': $authController->dashboard(); break;
        case 'logout': $authController->logout(); break;
        default: http_response_code(404); echo 'Ação de autenticação não encontrada.'; break;
    }
} 
elseif ($controller === 'usuarios') {
    exigirAutenticacao();
    $usuariosController = new UsuariosController();
    switch ($action) {
        case 'listar': $usuariosController->listar(); break;
        case 'buscar': $usuariosController->buscarPorId(); break;
        case 'criar': $usuariosController->criar(); break;
        case 'atualizar': $usuariosController->atualizar(); break;
        case 'excluir': $usuariosController->excluir(); break;
    }
}
elseif ($controller === 'pessoas') {
    $pessoasController = new PessoasController();
    switch ($action) {
        case 'listar': $pessoasController->listar(); break;
        case 'buscar': $pessoasController->buscarPorId(); break;
        case 'criar': $pessoasController->criar(); break;
        case 'atualizar': $pessoasController->atualizar(); break;
        case 'excluir': $pessoasController->excluir(); break;
        default: echo 'Ação de pessoas não encontrada.'; break;
    }
} 
elseif ($controller === 'tipos_atendimentos') {
    $tiposController = new TiposAtendimentosController();
    switch ($action) {
        case 'listar': $tiposController->listar(); break;
        case 'buscar': $tiposController->buscarPorId(); break;
        case 'criar': $tiposController->criar(); break;
        case 'atualizar': $tiposController->atualizar(); break;
        case 'excluir': $tiposController->excluir(); break;
        default: echo 'Ação de tipos de atendimento não encontrada.'; break;
    }
}
else {
    echo '<h1>AtendeLab</h1>';
    echo '<p>Projeto em execução. Use ?controller=pessoas&action=listar para testar.</p>';
}