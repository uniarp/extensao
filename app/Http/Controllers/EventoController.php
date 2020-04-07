<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class EventoController extends BaseController
{

    public function listarEventos()
    {
        return app('db')->select('SELECT
                                    e.codevento "codEvento", e.titulo,
                                    e.periodoinicial "periodoInicial", e.periodofinal "periodoFinal",
                                    e.inscricaoinicio "inscricaoInicio", e.inscricaofim "inscricaoFim",
                                    e.qtdmininscrito "qtdMinInscrito", e.qtdmaxinscrito "qtdMaxInscrito",
                                    e.modeldol "modeloDoc"
                                FROM evento e;');
    }

    public function listarEvento($codEvento)
    {
        return app('db')->select('SELECT
                                    e.codevento "codEvento", e.titulo,
                                    e.periodoinicial "periodoInicial", e.periodofinal "periodoFinal",
                                    e.inscricaoinicio "inscricaoInicio", e.inscricaofim "inscricaoFim",
                                    e.qtdmininscrito "qtdMinInscrito", e.qtdmaxinscrito "qtdMaxInscrito",
                                    e.modeldol "modeloDoc"
                                FROM evento e WHERE e.codevento = ' . $codEvento . ';');
    }

    public function gravarEvento($codEvento, $titulo, $codArea, $periodoInicial, $periodoFinal, $inscricaoInicio, $inscricaoFim, $qtdMinInscrito, $qtdMaxInscrito, $modeloDoc, $voluntario, $atividades)
    {
        if ($codEvento === null) {
            $query = 'INSERT INTO evento ("titulo", "periodoinicial", "periodofinal", "inscricaoinicio", "inscricaofim", "qtdmininscrito", "qtdmaxinscrito", "modeldol") VALUES (';
            $query .= "'".$titulo."', '".$periodoInicial."', '".$periodoFinal."', '".$inscricaoInicio."', '".$inscricaoFim."', '".$qtdMinInscrito."', '".$qtdMaxInscrito."', '".$modeloDoc."');";
            app('db')->select($query);
            $codEvento = app('db')->select('SELECT MAX(e.codevento) as "codEvento" FROM evento e;');
            $codEvento = json_decode(json_encode($codEvento), true);
            $codEvento = $codEvento[0]['codEvento'];
            $insertAreaEvento = 'INSERT INTO areaevento ("codarea", "codevento") VALUES (' . $codArea['codArea'] . ', ' . $codEvento . ');';
            app('db')->select($insertAreaEvento);
            if (!empty($voluntario)) {
                for ($v = 0; $v < count($voluntario); $v++) {
                    $codVoluntario = $voluntario[$v]['codVoluntario'];
                    $insetVolun = 'INSERT INTO equipeevento ("codvoluntario", "codevento") VALUES (' . $codVoluntario . ', ' . $codEvento . ');';
                    app('db')->select($insetVolun);
                }
            }
            if (!empty($atividades)) {
                for ($a = 0; $a < count($atividades); $a++) {
                    $codAtividade = $atividades[$a]['codAtividade'];
                    $updateAtividade = 'UPDATE atividade SET "codevento"= '.$codEvento.' WHERE  "codatividade"='.$codAtividade.';';
                    app('db')->select($updateAtividade);
                }
            }
            return EventoController::listarEvento($codEvento);
        } else {
            $updateAreaEvento = 'UPDATE areaevento set codArea ='. $codArea['codArea'] .' WHERE codEvento = ' . $codEvento . ';';
            app('db')->select($updateAreaEvento);
            $delEquipe = 'DELETE FROM equipeevento  WHERE codevento = ' . $codEvento . ';';
            app('db')->select($delEquipe);
            for ($v = 0; $v < count($voluntario); $v++) {
                $codVoluntario = $voluntario[$v]['codVoluntario'];
                $insetVolun = 'INSERT INTO equipeevento ("codvoluntario", "codevento") VALUES (' . $codVoluntario . ', ' . $codEvento . ');';
                app('db')->select($insetVolun);
            }
            $query = "UPDATE evento SET titulo = '".$titulo."', periodoinicial = '".$periodoInicial."', periodofinal = '".$periodoFinal."', inscricaoinicio = '"
            .$inscricaoInicio."', inscricaofim = '".$inscricaoFim."', qtdmininscrito = '".$qtdMinInscrito."', qtdmaxinscrito = '".$qtdMaxInscrito
            ."', modeldol = '".$modeloDoc."' WHERE codevento = '".$codEvento."';";
            return EventoController::listarEvento($codEvento);
        }
    }

    public function excluirEvento($codEvento)
    {
        $query = "DELETE FROM evento WHERE codevento = '$codEvento'";
        return app('db')->select($query);
    }
}
