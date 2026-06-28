<?php

class DashboardController
{
    public function resumo()
    {
        header('Content-Type: application/json');
        
        echo json_encode([
            'indicadores' => [
                'total_pessoas' => 0,
                'total_tipos' => 0,
                'total_atendimentos' => 0
            ],
            'atendimentos_recentes' => []
        ]);
    }
}