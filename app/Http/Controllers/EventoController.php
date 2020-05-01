<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class EventoController extends BaseController
{

    public function listarEventos()
    {
        $eventos = app('db')->select('SELECT
                                    e.codevento "codEvento", e.titulo,
                                    e.periodoinicial "periodoInicial", e.periodofinal "periodoFinal",
                                    e.inscricaoinicio "inscricaoInicio", e.inscricaofim "inscricaoFim",
                                    e.qtdmininscrito "qtdMinInscrito", e.qtdmaxinscrito "qtdMaxInscrito",
                                    e.modeldol "modeloDoc",
                                    (SELECT COUNT(*) FROM participanteevento p WHERE p.codevento = e.codevento) "qtdInscritos",
                                    (SELECT COUNT(*) FROM areaevento a WHERE a.codevento = e.codevento) "qtdArea",
                                    (SELECT COUNT(*) FROM equipeevento ee WHERE ee.codevento = e.codevento) "qtdEquipe"
                                FROM evento e;');

        $eventos = json_decode(json_encode($eventos), true);
        $i = 0;
        foreach ($eventos as $evento) {
            if ($evento['qtdInscritos'] == 0) {
                if ($evento['qtdArea'] == 0) {
                    if ($evento['qtdEquipe'] == 0) {
                        $eventos[$i]['podeExcluir'] = true;
                    } else {
                        $eventos[$i]['podeExcluir'] = false;
                    }
                } else {
                    $eventos[$i]['podeExcluir'] = false;
                }
            } else {
                $eventos[$i]['podeExcluir'] = false;
            }
            $i++;
        }

        return $eventos;
    }

    public function listarEvento($codEvento)
    {
        $evento = app('db')->select('SELECT
                                    e.codevento "codEvento", e.titulo,
                                    e.periodoinicial "periodoInicial", e.periodofinal "periodoFinal",
                                    e.inscricaoinicio "inscricaoInicio", e.inscricaofim "inscricaoFim",
                                    e.qtdmininscrito "qtdMinInscrito", e.qtdmaxinscrito "qtdMaxInscrito",
                                    e.modeldol "modeloDoc"
                                FROM evento e WHERE e.codevento = ' . $codEvento . ';');
        $evento = json_decode(json_encode($evento), true);
        for ($e = 0; $e < count($evento); $e++) {
            $evento[$e]['codArea'] = app('db')->select('SELECT ae.codarea "codArea", a.nome FROM areaevento ae JOIN area a ON ae.codarea = a.codarea
                WHERE ae.codevento =' . $codEvento . ';');
            $evento[$e]['voluntario'] = app('db')->select('SELECT ep.codvoluntario "codVoluntario", v.nome, v.email, v.cpf, v.telefone, v.ra, v.curso FROM equipeevento ep
            JOIN voluntario v ON ep.codvoluntario = v.codvoluntario
            WHERE ep.codevento =' . $codEvento . ';');
            $atividade = app('db')->select('SELECT atv.codatividade "codAtividade", atv.titulo, atv.codtipo "codTipo", ta.nome "nomeTipo", atv.datainicio "dataInicio",
                atv.datafim "dataFim", atv.localizacao, atv.descricao FROM atividade atv
                JOIN tipoatividade ta ON atv.codtipo = ta.codtipoatividade WHERE atv.codevento =' . $codEvento . ';');
            $atividade = json_decode(json_encode($atividade), true);
            for ($a = 0; $a < count($atividade); $a++) {
                $codAtv = $atividade[$a]['codAtividade'];
                $palestranteAtv = app('db')->select('SELECT ap.codatividadepalestrante "codAtividadePalestrante",ap.codpalestrante "codPalestrante", p.nome 
                FROM atividadepalestrante ap JOIN palestrante p ON ap.codpalestrante = p.codpalestrante WHERE ap.codatividade =' . $codAtv . ';');
                $atividade[$a]['palestrante'] =  $palestranteAtv;
            }
            $evento[$e]['atividades'] = $atividade;
        }
        return $evento;
    }

    public function gravarEvento($codEvento, $titulo, $codArea, $periodoInicial, $periodoFinal, $inscricaoInicio, $inscricaoFim, $qtdMinInscrito, $qtdMaxInscrito, $modeloDoc, $voluntario, $atividades)
    {
        if ($codEvento === null) {
            $query = 'INSERT INTO evento ("titulo", "periodoinicial", "periodofinal", "inscricaoinicio", "inscricaofim", "qtdmininscrito", "qtdmaxinscrito", "modeldol") VALUES (';
            $query .= "'" . $titulo . "', '" . $periodoInicial . "', '" . $periodoFinal . "', '" . $inscricaoInicio . "', '" . $inscricaoFim . "', '" . $qtdMinInscrito . "', '" . $qtdMaxInscrito . "', '" . $modeloDoc . "');";
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
                    $updateAtividade = 'UPDATE atividade SET "codevento"= ' . $codEvento . ' WHERE  "codatividade"=' . $codAtividade . ';';
                    app('db')->select($updateAtividade);
                }
            }
            return EventoController::listarEvento($codEvento);
        } else {
            $updateAreaEvento = 'UPDATE areaevento set codArea =' . $codArea['codArea'] . ' WHERE codEvento = ' . $codEvento . ';';
            app('db')->select($updateAreaEvento);
            $delEquipe = 'DELETE FROM equipeevento  WHERE codevento = ' . $codEvento . ';';
            app('db')->select($delEquipe);
            for ($v = 0; $v < count($voluntario); $v++) {
                $codVoluntario = $voluntario[$v]['codVoluntario'];
                $insetVolun = 'INSERT INTO equipeevento ("codvoluntario", "codevento") VALUES (' . $codVoluntario . ', ' . $codEvento . ');';
                app('db')->select($insetVolun);
            }
            $query = "UPDATE evento SET titulo = '" . $titulo . "', periodoinicial = '" . $periodoInicial . "', periodofinal = '" . $periodoFinal . "', inscricaoinicio = '"
                . $inscricaoInicio . "', inscricaofim = '" . $inscricaoFim . "', qtdmininscrito = '" . $qtdMinInscrito . "', qtdmaxinscrito = '" . $qtdMaxInscrito
                . "', modeldol = '" . $modeloDoc . "' WHERE codevento = '" . $codEvento . "';";

            app('db')->select($query);
            return EventoController::listarEvento($codEvento);
        }
    }

    public function excluirEvento($codEvento)
    {
        $query = "DELETE FROM evento WHERE codevento = '$codEvento'";
        return app('db')->select($query);
    }

    public function listarIncritos($codEvento)
    {
        $query = 'SELECT p.codparticipante "codParticipante", pe.codevento "codEvento", p.nome, p.cpf, p.ra, p.telefone, p.email, COALESCE(pe.presente, false) presente FROM participanteevento pe
        JOIN participante p ON pe.codparticipante = p.codparticipante
        WHERE pe.codevento = ' . $codEvento . ';';
        return app('db')->select($query);
    }

    public function salvarPresenca($arrDados)
    {
        $arrDados = json_decode(json_encode($arrDados), true);
        if (is_array($arrDados)) {
            foreach ($arrDados as $dado) {
                $presenca = $dado['presente'];
                $query = "UPDATE participanteevento PE SET PE.presente = $presenca WHERE PE.codparticipante = {$dado['codParticipante']} AND PE.codevento = {$dado['codEvento']};";
                app('db')->select($query);
            }
        }
    }

    public function inscreverParticipanteEvento($arrDados)
    {
        $arrDados = json_decode(json_encode($arrDados), true);
        if (is_array($arrDados)) {
            app('db')->select("DELETE FROM participanteevento WHERE codevento = {$arrDados[0]['codEvento']}");
            foreach ($arrDados as $dado) {
                $query = "INSERT INTO participanteevento (codparticipante, codevento) VALUES ('{$dado['codParticipante']}', '{$dado['codEvento']}');";
                app('db')->select($query);
            }
        }
    }

    public function participantesInscreverEvento($codEvento)
    {
        $query = 'SELECT COALESCE(t2.codparticipanteevento, NULL) relacionado, t1.codparticipante "codParticipante", t1.nome                            
        FROM participante t1
        LEFT JOIN participanteevento t2 ON t1.codparticipante = t2.codparticipante AND t2.codevento = ' . $codEvento . ';';

        $participantes = app('db')->select($query);
        $participantes = json_decode(json_encode($participantes), true);

        foreach ($participantes as &$participante) {
            $participante['relacionado'] = $participante['relacionado'] ? true : false;
        }

        return $participantes;
    }
}
