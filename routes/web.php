<?php

use \Illuminate\Http\Request;
use \App\Http\Controllers\ParticipanteController;
use \App\Http\Controllers\UsuarioController;
use \App\Http\Controllers\PalestranteController;
use \App\Http\Controllers\VoluntarioController;
use \App\Http\Controllers\AtividadeController;
use \App\Http\Controllers\EventoController;
use \Illuminate\Http\ResponseResponseResponseSymfony\Component\HttpFoundation\Response;

$router->get('testeconte', function () use ($router) {
    return app('db')->select("select * from palestrante");
});

$router->get('/validador/validarDocumento/{token}', function ($token) {
    $tokenDados = (object) [
        'participante' => 'Maurício da Silva',
        'data' => '2019/05/21',
        'evento' => 'Sedepex',
        'numeroHoras' => '6'
    ];
    return json_encode($tokenDados);
});

$router->get('/documentos/listar/{filtros}', function ($filtros) {
    $documentos = array(
        array(
            'codDocumento' => 1, 'codParticipante' => 1, 'nome' => 'Teste', 'cpf' => '08302158999', 'tipo' => 'Certificado', 'numeroHoras' => '12'
        ),
        array(
            'codDocumento' => 2, 'codParticipante' => 1, 'nome' => 'Teste 2', 'cpf' => '03241158999', 'tipo' => 'Declaracao', 'numeroHoras' => '15'
        )
    );
    return json_encode($documentos);
});

$router->get('/documentos/gerar/{codigoInscricao}', function ($codigoInscricao) {
    $documento = (object) [
        'codDocumento' => 1
    ];
    return json_encode($documento);
});

/* OPA OPA MEU CONSAGRADO */

$router->get('/participante/inscricao/{codigoParticipante}/{codigoAtividade}', function ($codigoParticipante, $codigoAtividade) {
    $participante = (object) [
        'codInscricao' => 1
    ];
    return json_encode($participante);
});

$router->get('/validar/{chave}', function ($chave) {
    if ($chave === "mestre") {
        return '{status:true}';
    }
    return '{status:false}';
});

/*AREA*/
$router->get('/areas/listar', 'AreaController@listarArea');

/* VOLUNTARIO */
$router->get('/voluntarios/listar', 'VoluntarioController@listarVoluntarios');

$router->get('/voluntarios/listar/{codVoluntario}', 'VoluntarioController@listarVoluntario');

$router->post('/voluntarios/cadastrar', function () {
    $body = dadosSessao();
    $voluntario = new VoluntarioController();
    try {
        $voluntario->gravarVoluntario(
            $body['codVoluntario'],
            $body['nome'],
            $body['email'],
            $body['cpf'],
            $body['telefone'],
            $body['ra'],
            $body['curso']
        );
    } catch (Exception $e) {
        $response['erro'] = $e;
        return response($response, 400);
    }
    return response('true', 200);
});

$router->delete('/voluntarios/excluir/{codVoluntario}', 'VoluntarioController@excluirVoluntario');


/* PALESTRANTE */
//Listar
$router->get('/palestrantes/listar', 'PalestranteController@listarPalestrantes');

//listar por codigo
$router->get('/palestrantes/listar/{codPalestrante}', 'PalestranteController@listarPalestrante');

// Alterar ou Cadastar novo Palestrante
$router->post('/palestrantes/cadastrar', function () {
    $body = dadosSessao();
    $palestrante = new PalestranteController();
    try {
        $res = $palestrante->gravarPalestrante(
            $body['codPalestrante'],
            $body['nome'],
            $body['cpf'],
            $body['telefone'],
            $body['email'],
            $body['biografia'],
            $body['area']
        );
    } catch (Exception $e) {
        $response['erro'] = $e;
        return response($response, 400);
    }
    return response($res, 200);
});

//excluir
$router->delete('/palestrantes/excluir/{codPalestrante}', 'PalestranteController@excluirPalestrante');


/* PARTICIPANTE */
//Listar
$router->get('/participantes/listar/', 'ParticipanteController@listarParticipantes');

$router->get('/participantes/listar/{codParticipante}', 'ParticipanteController@listarParticipante');

//Cadastrar
$router->post('/participantes/cadastrar', function () {
    $body = dadosSessao();
    $participante = new ParticipanteController();

    try {
        $response = $participante->gravarParticipante(
            $body['codParticipante'],
            $body['nome'],
            $body['cpf'],
            $body['ra'],
            $body['senha'],
            $body['telefone'],
            $body['email']
        );
    } catch (Exception $e) {
        $response['erro'] = $e;
        return response($response, 400);
    }
    return response($response, 200);
});

//Excluir
$router->delete('/participantes/excluir/{codParticipante}', 'ParticipanteController@excluirParticipante');

/* USUÁRIO */
//Listar
$router->get('/usuarios/listar', 'UsuarioController@listarUsuarios');
//listar por codigo
$router->get('/usuarios/listar/{codUsuario}', 'UsuarioController@listarUsuario');

//cadastar
$router->post('/usuarios/cadastrar', function () {
    $body = dadosSessao();
    $usuario = new UsuarioController();

    try {
        $usuario->cadastrarUsuario(
            $body['codUsuario'],
            $body['nome'],
            $body['email'],
            $body['cpf'],
            $body['senha']
        );
    } catch (Exception $e) {
        $response['erro'] = $e;
        return response($response, 400);
    }
    return response('true', 200);
});

//Excluir
$router->delete('/usuarios/excluir/{codUsuario}', 'UsuarioController@excluirUsuario');

//TipoAtividade
$router->get('/tipoAtividades/listar', 'TipoAtividadeController@listarTipoAtividade');

//Atividade
$router->get('/atividades/listar/{codAtividade}', 'AtividadeController@listarAtividade');

//cadastar
$router->post('/atividades/cadastrar', function () {
    $body = dadosSessao();
    $atividade = new AtividadeController();

    try {
        $res = $atividade->gravarAtividade(
            $body['codAtividade'],
            $body['titulo'],
            $body['codTipo'],
            $body['dataInicio'],
            $body['dataFim'],
            $body['localizacao'],
            $body['descricao'],
            $body['palestrante']
        );
    } catch (Exception $e) {
        $response['erro'] = $e;
        return response($response, 400);
    }
    return response($res, 200);
});

//Excluir
$router->delete('/atividades/excluir/{codAtividade}', 'AtividadeController@excluirAtividade');


//Evento

//Cadastrar
$router->post('/eventos/cadastrar', function () {
    $body = dadosSessao();
    $res = $evento = new EventoController();

    try {
        $evento->gravarEvento(
            $body['codEvento'],
            $body['titulo'],
            $body['codEvento'],
            $body['periodoInicial'],
            $body['periodoFinal'],
            $body['inscricaoInicio'],
            $body['inscricaoFim'],
            $body['qtdMinInscrito'],
            $body['qtdMaxInscrito'],
            $body['modeloDoc'],
            $body['voluntario'],
            $body['atividades']
        );
    } catch (Exception $e) {
        $response['erro'] = $e;
        return response($response, 400);
    }
    return response($res, 200);
});

//Listar Eventos
$router->get('/eventos/listar', 'EventoController@listarEventos');

//Listar Evento por Cod
$router->get('/eventos/listar/{codEvento}', 'EventoController@listarEvento');

//Excluir
$router->delete('/eventos/excluir/{codEvento}', 'EventoController@excluirEvento');

function dadosSessao()
{
    $request = new Request();
    return $request->json()->all();
}
