<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class UsuarioController extends BaseController {
    
    public function listarUsuario() {
        return app('db')->select("SELECT u.codUsuario, u.nome, u.email, u.cpf, u.senha FROM usuario u;");
    }

    public function cadastrarUsuario($codUsuario, $nome, $email, $cpf, $senha) {
        if ($codUsuario === null) {
            $query = 'INSERT INTO usuario ( "nome", "email", "cpf", "senha" ) VALUES (';
            $query .= "'" . $nome . "', '" . $email . "', '" . $cpf . "', '" . $senha . "');";
            return app('db')->select($query);
        } else {
            // $query = "UPDATE participante SET nome = '" . $nome . "', cpf = '" . $cpf . "', ra = '" . $ra . "', senha = '" . $senha . "', telefone = '" . $telefone . "', email = '" . $email . "' WHERE codparticipante = " . $codparticipante . ";";
            // return app('db')->select($query);
        }
    }
}