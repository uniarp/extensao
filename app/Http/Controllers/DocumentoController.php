<?php

namespace App\Http\Controllers;

use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class DocumentoController extends BaseController
{
    public function emitirCertificado($codInscricao)
    {
        $token = app('db')->select("SELECT p.token FROM participanteevento p WHERE p.codparticipanteevento = '$codInscricao';");
        if ($token[0]['token'] == '') {
            $dtAtual = date("Y-m-d");
            $token = sha1(time() . $codInscricao);
            app('db')->select("UPDATE participanteevento SET token = '$token', dataemissao = '$dtAtual'  WHERE codparticipanteevento = '$codInscricao';");
        } else {
            return 'Certificado Já foi Emitido';
        }
    }

    public function validarDocumento($token)
    {
        $ret = app('db')->select("SELECT * FROM participanteevento pe
                                JOIN participante p ON pe.codparticipante = p.codparticipante
                                JOIN evento e ON pe.codevento = e.codeventoWHERE pe.token = '$token';");
        if (count($ret) > 0) {
            return $ret;
        } else {
            return 'Certificado não é Válido';
        }
    }
}
