<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class PalestranteController extends BaseController {
    
    public function listarPalestrante() {
        $palestrantes = app('db')->select("SELECT p.codpalestrante, p.nome, p.cpf, p.telefone, p.email, p.biografia FROM palestrante p;");
        $i = 0;
        foreach ($palestrantes as $palestrante) {
            $areasPalestrante = app('db')->select("SELECT p.codareapalestrante, a.codarea, a.nome FROM areapalestrante p
            JOIN area a ON a.codarea = p.codarea WHERE p.codpalestrante = " . $palestrante['codpalestrante'] . ";");
            $palestrantes[$i]['areasPalestante'] =  $areasPalestrante;
            $i++;
        }
        return $palestrantes;
    }

    public function cadastrarPalestrante($codpalestrante, $nome, $cpf, $telefone, $email,  $area, $biografia) {
        if ($codpalestrante === null) {
            // $query = 'INSERT INTO participante ("nome", "cpf", "ra", "senha", "telefone", "email") VALUES (';
            // $query .= "'" . $nome . "', '" . $cpf . "', '" . $ra . "', '" . $senha . "', '" . $telefone . "', '" . $email . "');";
            // return app('db')->select($query);
        } else {
            // $query = "UPDATE participante SET nome = '" . $nome . "', cpf = '" . $cpf . "', ra = '" . $ra . "', senha = '" . $senha . "', telefone = '" . $telefone . "', email = '" . $email . "' WHERE codparticipante = " . $codparticipante . ";";
            // return app('db')->select($query);
        }
    }
}