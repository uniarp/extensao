<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class EventoController extends BaseController {

    public function listarEventos() {
        return app('db')->select('SELECT
                                    e.codevento "codEvento", e.titulo,
                                    e.periodoinicial "periodoInicial", e.periodofinal "periodoFinal",
                                    e.inscricaoinicio "inscricaoInicio", e.inscricaofim "inscricaoFim",
                                    e.qtdmininscrito "qtdMinInscrito", e.qtdmaxinscrito "qtdMaxInscrito",
                                    e.modeldol "modeloDoc"
                                FROM evento e;');
    }

    public function listarEvento($codEvento) {
        return app('db')->select('SELECT
                                    e.codevento "codEvento", e.titulo,
                                    e.periodoinicial "periodoInicial", e.periodofinal "periodoFinal",
                                    e.inscricaoinicio "inscricaoInicio", e.inscricaofim "inscricaoFim",
                                    e.qtdmininscrito "qtdMinInscrito", e.qtdmaxinscrito "qtdMaxInscrito",
                                    e.modeldol "modeloDoc"
                                FROM evento e WHERE e.codevento = ' . $codEvento . ';');
    }

    public function gravarEvento($codEvento, $titulo, $periodoInicial, $periodoFinal, $inscricaoInicio, $inscricaoFim, $qtdMinInscrito, $qtdMaxInscrito, $modeloDoc) {
        if ($codEvento === null) {
            $query = 'INSERT INTO evento ("titulo", "periodoinicial", "periodofinal", "inscricaoinicio", "inscricaofim", "qtdmininscrito", "qtdmaxinscrito", "modeldol") VALUES (';
            $query .= "'$titulo', '$periodoInicial', '$periodoFinal', '$inscricaoInicio', '$inscricaoFim', '$qtdMinInscrito', '$qtdMaxInscrito', '$modeloDoc');";
            return app('db')->select($query);
        } else {
            $query = "UPDATE evento SET titulo = '$titulo', periodoinicial = '$periodoInicial', periodofinal = '$periodoFinal', inscricaoinicio = '$inscricaoInicio', inscricaofim = '$inscricaoFim', qtdmininscrito = '$qtdMinInscrito', qtdmaxinscrito = '$qtdMaxInscrito', modeldol = '$modeloDoc' WHERE codevento = '$codEvento';";
            return app('db')->select($query);
        }
    }

    public function excluirEvento($codEvento) {
        $query = "DELETE FROM evento WHERE codevento = '$codEvento'";
        return app('db')->select($query);
    }
}
