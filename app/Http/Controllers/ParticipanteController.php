<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController {
    
    public function listarParticipante() {
        return app('db')->select("SELECT p.codparticipante cod, p.nome, p.cpf, p.ra, p.telefone, p.email FROM participante p;");
    }
}