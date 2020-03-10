<?php

namespace App\Http\Controllers;

use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class UsuarioController extends BaseController {

    public function listarUsuario() {
        return app('db')->select('SELECT u.codusuario "codUsuario", u.nome, u.email, u.cpf, u.senha FROM usuario u;');
    }

    public function cadastrarUsuario($codUsuario, $nome, $email, $cpf, $senha) {
        if ($codUsuario === null) {
            $query = 'INSERT INTO usuario ( "nome", "email", "cpf", "senha" ) VALUES (';
            $query .= "'" . $nome . "', '" . $email . "', '" . $cpf . "', '" . $senha . "');";
            return app('db')->select($query);
        } else {
            $query = "UPDATE usuario SET
                    nome = '" . $nome . "',
                    email = '" . $email . "',
                    cpf = '" . $cpf . "',
                    senha = '" . $senha . "'
                    WHERE codusuario = " . $codUsuario . ";";
            return app('db')->select($query);
        }
    }

    public function excluirUsuario($codUsuario) {
        $query = "DELETE FROM usuario WHERE codusuario = '" . $codUsuario . "'";
        return app('db')->select($query);
    }
}
