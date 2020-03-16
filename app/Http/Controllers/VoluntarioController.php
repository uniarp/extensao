<?php

namespace App\Http\Controllers;

use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class VoluntarioController extends BaseController {

    public function listarVoluntarios() {
        return app('db')->select('SELECT v.codvoluntario "codVoluntario", v.nome, v.email, v.cpf, v.telefone, v.ra, v.curso FROM voluntario v;');
    }

    public function gravarVoluntario($codVoluntario, $nome, $email, $cpf, $telefone, $ra, $curso) {
        if ($codVoluntario === null) {
            $query = "INSERT INTO voluntario (nome, email, cpf, telefone, ra, curso) values(";
            $query .= "'" . $nome . "', '" . $email . "', '" . $cpf . "', '" . $telefone . "', '" . $ra . "', '" . $curso . "');";
        } else {
            $query = "UPDATE voluntario SET nome = '$nome', email = '$email', cpf = '$cpf', telefone = '$telefone', ra = '$ra', curso = '$curso' WHERE codvoluntario = $codVoluntario;";
        }
        return app('db')->select($query);
    }

    public function excluirVoluntario($codVoluntario) {
        $query = "DELETE FROM voluntario WHERE codvoluntario = $codVoluntario;";
        return app('db')->select($query);
    }
}