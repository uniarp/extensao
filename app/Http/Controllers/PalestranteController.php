<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class PalestranteController extends BaseController
{

    public function listarPalestrantes()
    {
        $palestrantes = app('db')->select('SELECT p.codpalestrante "codPalestrante", p.nome, p.cpf, p.telefone, p.email, p.biografia FROM palestrante p;');
        $palestrantes = json_decode(json_encode($palestrantes), true);
        for ($i = 0; $i < count($palestrantes); $i++) {
            $cod = $palestrantes[$i]['codPalestrante'];
            $areasPalestrante = app('db')->select('SELECT p.codareapalestrante "codAreaPalestrante", a.codarea "codArea", a.nome FROM areapalestrante p
            JOIN area a ON a.codarea = p.codarea WHERE p.codpalestrante = ' . $cod . ";");
            $palestrantes[$i]['areasPalestante'] =  $areasPalestrante;
        }
        return $palestrantes;
    }

    public function listarPalestrante($codPalestrante)
    {
        $palestrantes = app('db')->select('SELECT p.codpalestrante "codPalestrante", p.nome, p.cpf, p.telefone, p.email, p.biografia FROM palestrante p where p.codPalestrante =' . $codPalestrante . ';');
        for ($a = 0; $a < count($palestrantes); $a++) {
            $areasPalestrante = app('db')->select('SELECT  p.codareapalestrante "codAreaPalestrante", p.codarea "codArea" FROM areapalestrante p
                WHERE p.codpalestrante = ' . $codPalestrante . ";");
            $palestrantes['areaPalestrante'] =  $areasPalestrante;
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
            $codPalestrante = $codPalestrante[0]['codpalestrante'];
            for ($a = 0; $a < count($area); $a++) {
                $codArea = $area[$a];
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
