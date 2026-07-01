<?php
require_once __DIR__ . '/app/Controllers/AuthController.php';
require_once __DIR__ . '/app/Controllers/UsuariosController.php';
require_once __DIR__ . '/app/Controllers/PessoasController.php';
require_once __DIR__ . '/app/Controllers/TiposAtendimentosController.php';
require_once __DIR__ . '/app/Controllers/AtendimentosController.php';
require_once __DIR__ . '/app/Controllers/FrontendController.php'; 
require_once __DIR__ . '/app/Controllers/DashboardController.php';
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
elseif ($controller === 'frontend') {
    exigirAutenticacao();
    $frontendController = new FrontendController();
    switch ($action) {
        case 'pessoas': $frontendController->pessoas(); break;
        case 'tipos': $frontendController->tiposAtendimentos(); break;
        case 'atendimentos': $frontendController->atendimentos(); break;
        default: http_response_code(404); echo 'Página não encontrada.'; break;
    }
}
elseif ($controller === 'dashboard') {
    exigirAutenticacao();
    $dashboardController = new DashboardController();
    if ($action === 'resumo') {
        $dashboardController->resumo();
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
        case 'inativar': $usuariosController->inativar(); break;
    }
}
elseif ($controller === 'pessoas') {
    exigirAutenticacao(); 
    $pessoasController = new PessoasController();
    switch ($action) {
        case 'listar': $pessoasController->listar(); break;
        case 'buscar':
        case 'buscarPorId': $pessoasController->buscarPorId(); break; 
        case 'criar': $pessoasController->criar(); break;
        case 'atualizar': $pessoasController->atualizar(); break;
        case 'inativar': $pessoasController->inativar(); break; 
        default: echo 'Ação de pessoas não encontrada.'; break;
    }
} 
elseif ($controller === 'tipos') {
    exigirAutenticacao(); 
    $tiposController = new TiposAtendimentosController();
    switch ($action) {
        case 'listar': $tiposController->listar(); break;
        case 'buscar':
        case 'buscarPorId': $tiposController->buscarPorId(); break;
        case 'criar': $tiposController->criar(); break;
        case 'atualizar': $tiposController->atualizar(); break;
        case 'inativar': $tiposController->inativar(); break;
        default: echo 'Ação de tipos de atendimento não encontrada.'; break;
    }
}
elseif ($controller === 'atendimentos') {
    exigirAutenticacao();
    $atendimentosController = new AtendimentosController();
    switch ($action) {
        case 'listar': $atendimentosController->listar(); break;
        case 'visualizar': $atendimentosController->visualizar(); break;
        case 'criar': $atendimentosController->criar(); break;
        case 'alterarStatus': 
        case 'atualizarStatus': $atendimentosController->alterarStatus(); break; 
        case 'opcoesFormulario': $atendimentosController->opcoesFormulario(); break;
        default: http_response_code(404); echo 'Ação de atendimentos não encontrada.'; break;
    }
}
else {
    echo '<h1>AtendeLab</h1>';
    echo '<p>Projeto em execução. Use ?controller=pessoas&action=listar para testar.</p>';
}