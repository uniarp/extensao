<?php

namespace App\Http\Controllers;

use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class TipoAtividadeController extends BaseController {

    public function listarTipoAtividade() {
        return app('db')->select('SELECT t.codtipoatividade "codTipoAtividade", t.nome FROM tipoatividade t;');
    }

}