<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class PalestranteController extends BaseController
{

    public function listarPalestrante()
    {
        $palestrantes = app('db')->select("SELECT p.codpalestrante, p.nome, p.cpf, p.telefone, p.email, p.biografia FROM palestrante p;");
        $palestrantes = json_decode(json_encode($palestrantes), true);
        for ($i = 0; $i < count($palestrantes); $i++) {
            $cod = $palestrantes[$i]['codpalestrante'];
            $areasPalestrante = app('db')->select("SELECT p.codareapalestrante, a.codarea, a.nome FROM areapalestrante p
            JOIN area a ON a.codarea = p.codarea WHERE p.codpalestrante = '" . $cod . "';");
            $palestrantes[$i]['areasPalestante'] =  $areasPalestrante;
        }
        return $palestrantes;
    }

    public function gravarPalestrante($codPalestrante, $nome, $cpf, $telefone, $email, $biografia, $area)
    {
        if ($codPalestrante === null) {
            $query = 'INSERT INTO palestrante ("nome", "cpf", "telefone", "email", "biografia") VALUES (';
            $query .= "'" . $nome . "', '" . $cpf . "', '" . $telefone . "', '" . $email . "', '" . $biografia . "');";
            app('db')->select($query);
            $codPalestrante = app('db')->select('SELECT MAX(p.codpalestrante) as codpalestrante FROM palestrante p;');
            $codPalestrante = json_decode(json_encode($codPalestrante), true);
            $area = json_decode(json_encode($area), true);
            for($a = 0;  $a < count($area); $a++) {
                if ($a == 0) {
                    return $area[$a]['codArea'];
                }
                $codArea = $area[$a]['codArea'];
                $codPalestrante = $codPalestrante[0]['codpalestrante'];
                $queryArea = 'INSERT INTO areapalestrante("codarea", "codpalestrante") VALUES (';
                $queryArea .= "'" . $codArea . "', '" . $codPalestrante . "');";
                app('db')->select($queryArea);
            }
        } else {
            $query = "UPDATE participante SET nome = '" . $nome . "', cpf = '" . $cpf . "', telefone = '" . $telefone . "', email = '" . $email . "', biografia = '" . $biografia . "', email = ' WHERE codparticipante = " . $codPalestrante . ";";
            return app('db')->select($query);
        }
    }

    public function excluirPalestrante($codPalestrante)
    {
        $query = "DELETE FROM palestrante WHERE codpalestrante = '" . $codPalestrante . "'";
        return app('db')->select($query);
    }
}
