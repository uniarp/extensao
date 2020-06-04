<?php

namespace App\Http\Controllers;

use Exception;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ParticipanteController extends BaseController
{

    public function listarParticipantes()
    {
        return app('db')->select('SELECT p.codparticipante "codParticipante", p.nome, p.cpf, p.ra, p.telefone, p.email FROM participante p;');
    }

    public function listarParticipante($codParticipante)
    {
        return app('db')->select('SELECT p.codparticipante "codParticipante", p.nome, p.cpf, p.ra, p.telefone, p.email FROM participante p WHERE p.codparticipante = ' . $codParticipante . ';');
    }

    public function gravarParticipante($codParticipante, $nome, $cpf, $ra, $senha, $telefone, $email)
    {
        if ($codParticipante === null) {
            $query = 'INSERT INTO participante ("nome", "cpf", "ra", "senha", "telefone", "email") VALUES (';
            $query .= "'" . $nome . "', '" . $cpf . "', '" . $ra . "', '" . $senha . "', '" . $telefone . "', '" . $email . "');";
            return app('db')->select($query);
        } else {
            $query = "UPDATE participante SET nome = '" . $nome . "', cpf = '" . $cpf . "', ra = '" . $ra . "', senha = '" . $senha . "', telefone = '" . $telefone . "', email = '" . $email . "' WHERE codparticipante = " . $codParticipante . ";";
            return app('db')->select($query);
        }
    }

    public function excluirParticipante($codParticipante)
    {
        $query = "DELETE FROM participante WHERE codparticipante = '" . $codParticipante . "'";
        return app('db')->select($query);
    }

    public function listarEventos($codParticipante)
    {
        $query = "SELECT pe.codevento, pe.codparticipante, e.titulo, p.nome, pe.presente FROM participanteevento pe
            LEFT JOIN evento e ON pe.codevento = e.codevento
            LEFT JOIN participante p ON pe.codparticipante = p.codparticipante
            WHERE pe.codparticipante IN(SELECT p.codparticipante FROM participante p WHERE pe.codparticipante = '$codParticipante');";
        return app('db')->select($query);
    }

    public function gerarQrCode($codEvento)
    {
        $url = "https://api.qrserver.com/v1/create-qr-code/?size=120x120&data=" . $codEvento;
        $ch = curl_init();  
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return ['qrCode' => base64_encode($output)];
    }
}
