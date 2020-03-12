<?php

namespace App\Http\Controllers;

use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class AreaController extends BaseController {

    public function listarArea() {
        return app('db')->select('SELECT a.codarea "codArea", a.nome FROM area a;');
    }

}
