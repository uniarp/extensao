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
        $palestrantes = json_decode(json_encode($palestrantes), true);
        for ($a = 0; $a < count($palestrantes); $a++) {
            $areasPalestrante = app('db')->select('SELECT p.codareapalestrante "codAreaPalestrante", a.codarea "codArea", a.nome FROM areapalestrante p
            JOIN area a ON a.codarea = p.codarea WHERE p.codpalestrante = ' . $codPalestrante . ";");
            $palestrantes[$a]['area'] =  $areasPalestrante;
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
                $codArea = $area[$a]['codArea'];
                $queryArea = 'INSERT INTO areapalestrante("codarea", "codpalestrante") VALUES (';
                $queryArea .= "'" . $codArea . "', '" . $codPalestrante . "');";
                app('db')->select($queryArea);
            }
        } else {
            $del = 'DELETE FROM areapalestrante  WHERE codpalestrante = '. $codPalestrante.';';
            app('db')->select($del);
            for ($a = 0; $a < count($area); $a++) {
                $codAreaPalestrante = $area[$a]['codAreaPalestrante'];
                $codArea = $area[$a]['codArea'];
                if ($codAreaPalestrante  === null) {
                    $queryArea = 'INSERT INTO areapalestrante("codarea", "codpalestrante") VALUES (';
                    $queryArea .= "'" . $codArea . "', '" . $codPalestrante . "');";
                    app('db')->select($queryArea);
                }

            }

            $query = "UPDATE palestrante SET nome = '" . $nome . "', cpf = '" . $cpf . "', telefone = '" . $telefone . "', email = '"
             . $email . "', biografia = '" . $biografia . "' WHERE codpalestrante =" . $codPalestrante . ";";
            return app('db')->select($query);
        }
    }

    public function excluirPalestrante($codPalestrante)
    {
        $del = 'SELECT a.codatividadepalestrante FROM atividadepalestrante a WHERE a.codpalestrante ='. $codPalestrante.';';
        $palesAtividade = app('db')->select($del);

        if ($palesAtividade) {
            $queryArea = 'DELETE FROM areapalestrante  WHERE codpalestrante = '. $codPalestrante.';';
            app('db')->select($queryArea);
            $query = 'DELETE FROM palestrante WHERE codpalestrante = ' . $codPalestrante . ';';
            app('db')->select($query);
            return true;
        }
        return 'Não foi possível excluir: Moivo já possui vinculo no sistema';
}
