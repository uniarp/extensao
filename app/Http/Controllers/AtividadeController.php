<?php

namespace App\Http\Controllers;

use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class AtividadeController extends BaseController
{
    public function listarAtividade($codAtividade)
    {
        $atividade = app('db')->select('SELECT atv.codatividade "codAtividade", atv.titulo, atv.codtipo "codTipo", tpAtv.nome "nomeTipo",
        atv.datainicio "dataInicio", atv.datafim "dataFim", atv.localizacao, atv.descricao
        FROM atividade atv
        JOIN tipoatividade tpAtv ON atv.codtipo = tpAtv.codtipoatividade WHERE atv.codatividade ='.$codAtividade.';');
        $atividade = json_decode(json_encode($atividade), true);
        for ($a = 0; $a < count($atividade); $a++) {
            $palestranteAtividade = app('db')->select('SELECT atvPal.codatividadepalestrante "codAtividadePalestrante", atvPal.codpalestrante "codPalestrante", 
            pales.nome FROM atividadepalestrante atvPal
            JOIN palestrante pales ON atvPal.codpalestrante = pales.codpalestrante WHERE atvPal.codatividade =' . $codAtividade . ";");
            $atividade[$a]['palestrante'] =  $palestranteAtividade;
        }
        return $atividade;
    }

    public function gravarAtividade($codAtividade, $titulo, $codTipo, $dataInicio, $dataFim, $localizacao, $descricao, $palestrante)
    {
        if ($codAtividade === null) {
            $query = 'INSERT INTO atividade ("titulo", "codtipo", "datainicio", "datafim", "localizacao", "descricao") VALUES (';
            $query .= "'" . $titulo . "', ". $codTipo .", '" . $dataInicio . "', '" . $dataFim . "', '" . $localizacao . "', '" . $descricao . "');";
            app('db')->select($query);
            $codAtividade = app('db')->select('SELECT MAX(atv.codatividade) "codAtividade" FROM atividade atv;');
            $codAtividade = json_decode(json_encode($codAtividade), true);
            $codAtividade = $codAtividade[0]['codAtividade'];
            for ($a = 0; $a < count($palestrante); $a++) {
                $codPalestrante = $palestrante[$a]['codPalestrante'];
                $queryPalestrante = 'INSERT INTO atividadepalestrante ("codpalestrante", "codatividade") VALUES (';
                $queryPalestrante .= "'" . $codPalestrante . "', '" . $codAtividade . "');";
                app('db')->select($queryPalestrante);
            }
            $retorno =  AtividadeController::listarAtividade($codAtividade);
            return $retorno;
        } else {
            $del = 'DELETE FROM atividadepalestrante  WHERE codatividade = ' . $codAtividade . ';';
            app('db')->select($del);
            for ($a = 0; $a < count($palestrante); $a++) {
                $codPalestrante = $palestrante[$a]['codPalestrante'];

                $queryPalestrante = 'INSERT INTO atividadepalestrante ("codpalestrante", "codatividade") VALUES (';
                $queryPalestrante .= "'" . $codPalestrante . "', '" . $codAtividade . "');";
                app('db')->select($queryPalestrante);
            }
            $query = "UPDATE atividade SET titulo = '" . $titulo . "', codtipo = '" . $codTipo . "', datainicio = '" . $dataInicio . "', datafim = '"
            . $dataFim . "', localizacao = '" . $localizacao . "', descricao = '" . $descricao ."' WHERE codatividade =" . $codAtividade . ";";
            app('db')->select($query);
            $retorno = AtividadeController::listarAtividade($codAtividade);
            return $retorno;
        }
    }
}
