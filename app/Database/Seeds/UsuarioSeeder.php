<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioSeeder extends Seeder
{
    public function run()
    {
        $usuarioModel = new \App\Models\UsuarioModel;

        $usuario = [
            'nome' => 'Victor Winicius',
            'email' => 'admin@admin.com',
            'cpf' => '349.957.910-35',
            'telefone' => '87 - 99999-9999',
        ];

        $usuarioModel->protect(false)->insert($usuario);

        $usuario = [
            'nome' => 'João de Deus',
            'email' => 'joao@email.com',
            'cpf' => '123.456.789-10',
            'telefone' => '87 - 98888-9999', 
        ];

        $usuarioModel->protect(false)->insert($usuario);

        dd($usuarioModel->errors());

    }
}
