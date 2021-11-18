<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table                = 'usuarios';
    protected $returnType           = 'App\Entities\Usuario';
    protected $allowedFields        = ['nome', 'email', 'telefone'];
    protected $useSoftDeletes       = true;
    protected $useTimestamps        = true;
    protected $createdField         = 'created_at';
    protected $updatedField         = 'updated_at';
    protected $deletedField         = 'deleted_at';
    protected $validationRules      = [
        'nome' => 'required|min_length[4]|max_length[120]',
        'email' => 'required|valid_email|is_unique[usuarios.email]',
        'cpf' => 'required|exact_length[14]|is_unique[usuarios.cpf]',
        'password' => 'required|min_length[6]',
        'password_confirmation' => 'required_with[password]|matches[password]',
    ];
    protected $validationMessages   = [
        'nome' => [
            'required' => 'O campo nome é obrigatório',
            'min_length' => 'O campo nome deve ter no mínimo 4 caracteres',
            'max_length' => 'O campo nome deve ter no máximo 120 caracteres',
        ],
        'email' => [
            'required' => 'O campo e-mail é obrigatório',
            'valid_email' => 'O campo e-mail deve conter um e-mail válido',
            'is_unique' => 'O email informado já está cadastrado',
        ],
        'cpf' => [
            'required' => 'O campo CPF é obrigatório',
            'exact_length' => 'O campo CPF deve conter 14 caracteres',
            'is_unique' => 'O CPF informado já está cadastrado',
        ],
    ];

    public function procurar($term)
    {

        if ($term === null) {
            return [];
        }

        return $this->select('id, nome')
            ->like('nome', $term)
            ->get()
            ->getResult();
    }
}
