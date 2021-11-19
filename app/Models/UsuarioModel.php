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
        'telefone' => 'required',
        'password' => 'required|min_length[6]',
        'password_confirmation' => 'required_with[password]|matches[password]',
    ];
    protected $validationMessages   = [
        'nome' => [
            'required' => 'O campo Nome é obrigatório',
            'min_length' => 'O campo Nome deve ter no mínimo 4 caracteres',
            'max_length' => 'O campo Nome deve ter no máximo 120 caracteres',
        ],
        'email' => [
            'required' => 'O campo E-mail é obrigatório',
            'valid_email' => 'O campo E-mail deve conter um e-mail válido',
            'is_unique' => 'O E-mail informado já está cadastrado',
        ],
        'cpf' => [
            'required' => 'O campo CPF é obrigatório',
            'exact_length' => 'O campo CPF deve conter 14 caracteres',
            'is_unique' => 'O CPF informado já está cadastrado',
        ],
        'telefone' => [
            'required' => 'O campo Telefone é obrigatório',
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

    public function desabilitaValidacaoSenha(){
        unset($this->validationRules['password']);
        unset($this->validationRules['password_confirmation']);
    }
}
