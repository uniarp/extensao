<?php

namespace App\Http\Controllers;

use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class DocumentoController extends BaseController
{
    public function emitirCertificado($codInscricao)
    {
        $token = sha1(time() . $codInscricao);
        app('db')->select("UPDATE participanteevento pe SET pe.token = $token WHERE pe.codparticipanteevento = '$codInscricao';");
    }

    public function validarDocumento($token)
    {
        $ret = app('db')->select("SELECT * FROM participanteevento pe WHERE pe.token = '$token';");
        if (is_array($ret)) {
            return 'Certificado Válido';
        } else {
            return 'Certificado não é Válido';
        }
    }
}
