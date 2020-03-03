<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ParticipanteController extends BaseController {
    
    public function listarParticipante() {
        return app('db')->select("SELECT p.codparticipante cod, p.nome, p.cpf, p.ra, p.telefone, p.email FROM participante p;");
    }

    public function cadastrarParticipante($codparticipante, $nome, $cpf, $ra, $senha, $telefone, $email) {
        if (isEmpty($codparticipante)) {
            $query = "INSERT INTO participante ('nome', 'cpf', 'ra', 'senha', 'telefone', 'email') VALUES (";
            $query .= "'" . $nome . "', '" . $cpf . "', '" . $ra . "', '" . $senha . "', '" . $telefone . "', '" . $email . "');";
            return app('db')->select($query);
        } else {
            $query = "UPDATE participante SET nome = '" . $nome . "', cpf = '" . $cpf . "', ra = '" . $ra . "', senha = '" . $senha . "', telefone = '" . $telefone . "', email = '" . $email . "' WHERE codparticipante = " . $codparticipante . ";";
            return app('db')->select($query);
        }
    }
}