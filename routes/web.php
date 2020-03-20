<?php

use \Illuminate\Http\Request;
use \App\Http\Controllers\ParticipanteController;
use \App\Http\Controllers\UsuarioController;
use \App\Http\Controllers\PalestranteController;
use \App\Http\Controllers\VoluntarioController;
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

$router->get('/eventos/listar/{filtro}/{valor}', function ($filro, $valor) {
    return 'status:true';
});

$router->get('/eventos/visulizar/{codigoEvento}', function ($codigoEvento) {
    $evento = (object) [
        'codigoEvento' => $codigoEvento,
        'titulo' => "Teste",
        'periodoInicial' => '2019-10-10',
        'periodoFinal' => '2019-10-15',
        'inscricaoInicio' => '2019-09-20',
        'inscricaoFim' => '2019-10-05',
        'qtoMinInscritos' => 5,
        'status' => "Aberto",
        'qtdMaxInscrito' => 20,
        'modelDoc' => 'Https://modeloSead.png'
    ];
    return json_encode($evento);
});

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
    return response($res['erro']['mensagem'], $res['erro']['status']);
});

//excluir
$router->delete('/palestrantes/excluir/{codPalestrante}', 'PalestranteController@excluirPalestrante');


/* PARTICIPANTE */
//Listar
$router->get('/participantes/listar/', 'ParticipanteController@listarParticipante');

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


$router->get('/eventos/listarEvento/{codEvento}/', function ($codEvento) {
    $evento = (object) [
        'codEvento' => $codEvento,
        'titulo' => 'Teste 2',
        'periodoInicial' => '2020-10-10',
        'periodoFinal' => '2020-10-15',
        'inscricaoInicio' => '2020-09-20',
        'inscricaoFim' => '2020-10-05',
        'qtdMinInscritos' => 5,
        'status' => 'Aberto',
        'qtdMaxInscritos' => 20,
        'modeloDoc' => 'https;//modeloSead.png',
        'area' => ['Engenharia', 'Direiro'],
        'equipe' => ['Mauricio', 'Delmison', 'Gabriel'],
        'atividades' => ['Abertura', 'Palestra', 'Fechamento']

    ];



    return json_encode($evento);
});

$router->get('/eventos/listarInscritos/{filtros}/', function ($filtros) {
    $inscritos = array(
        array(
            'codInscrito' => 1,
            'Nome' => 'Gabriel Soares',
            'email' => 'uniarp1@uniarp.com',
            'cpf' => '05335653025',
            'telefone' => '4998349562',
            'senha' => 'senha123',
            'ra' => '025960'
        ),
        array(
            'codInscrito' => 123,
            'nome' => 'Daniel Conte',
            'email' => 'uniarp1@uniarp.com',
            'cpf' => '053111122',
            'telefone' => '4998349562',
            'senha' => 'senha321',
            'ra' => null
        )
    );

    return json_encode($inscritos);
});

$router->get('/eventos/detalhesInscrito/{codInscrito}/', function ($codInscrito) {
    $inscrito = (object) [
        'codInscrito' => $codInscrito,
        'Nome' => 'Gabriel Soares',
        'email' => 'uniarp1@uniarp.com',
        'cpf' => '05335653025',
        'telefone' => '4998349562',
        'senha' => 'senha123',
        'ra' => '025960'
    ];

    return json_encode($inscrito);
});

$router->get('/eventos/cadastrar/{titulo}/{periodoInicial}/{periodoFinal}/{dtIncricaoInicio}/{dtIncricaoFim}/{qtdMinInscritos}/{qtdMaxInscritos}/{modeloDoc}/{area}/{equipe}/{atividades}', function ($titulo, $periodoInicial, $periodoFinal, $dtIncricaoInicio, $dtIncricaoFim, $qtdMinInscritos, $qtdMaxInscritos, $modeloDoc, $area, $equipe, $atividades) {
    $evento = (object) [
        'codEvento' => 1,
        'titulo' => 'Teste 1',
        'periodoInicial' => '2020-10-10',
        'periodoFinal' => '2020-10-15',
        'inscricaoInicio' => '2020-09-20',
        'inscricaoFim' => '2020-10-05',
        'qtdMinInscritos' => 5,
        'status' => 'Aberto',
        'qtdMaxInscritos' => 20,
        'modeloDoc' => 'https;//modeloTeste1.png',
        'area' => ['Engenharia', 'Direiro'],
        'equipe' => ['Mauricio', 'Delmison', 'Gabriel'],
        'atividades' => ['Abertura', 'Palestra', 'Fechamento']

    ];



    return json_encode($evento);
});

$router->get('/eventos/alterar/{codigoEvento}/{mudancas}/', function ($codigoEvento, $mudancas) {
    $evento = (object) [
        'codEvento' => $codigoEvento,
        'titulo' => 'Teste 2',
        'periodoInicial' => '2020-10-10',
        'periodoFinal' => '2020-10-15',
        'inscricaoInicio' => '2020-09-20',
        'inscricaoFim' => '2020-10-05',
        'qtdMinInscritos' => 5,
        'status' => 'Aberto',
        'qtdMaxInscritos' => 20,
        'modeloDoc' => 'https://modeloTeste2.png',
        'area' => ['Engenharia', 'Direiro'],
        'equipe' => ['Mauricio', 'Delmison', 'Gabriel'],
        'atividades' => ['Abertura', 'Palestra', 'Fechamento']
    ];

    return json_encode($evento);
});

$router->get('/eventos/excluir/{codigoEvento}', function ($codigoEvento) {
    $evento = (object) [
        'status' => true
    ];

    return json_encode($evento);
});

$router->get('/eventos/cancelar/{codigoEvento}', function ($codigoEvento) {
    $evento = (object) [
        'codigoEvento' => $codigoEvento,
        'status' => 'true'
    ];

    return json_encode($evento);
});

$router->get('/eventos/listar/{filtros}', function ($filtros) {
    $evento = array(
        array(
            'codEvento' => 1,
            'titulo' => 'Teste',
            'periodoInicial' => '2019-10-10',
            'periodoFinal' => '2019-10-15',
            'inscricaoInicio' => '2019-09-20',
            'inscricaoFim' => '2019-10-05',
            'qtdMinInscrito' => 5,
            'status' => 'Aberto',
            'qtdMaxInscrito' => 20,
            'modelDoc' => 'ambos'
        ),
        array(
            'codEvento' => 2,
            'titulo' => 'Teste 2',
            'periodoInicial' => '2019-10-10',
            'periodoFinal' => '2019-10-15',
            'inscricaoInicio' => '2019-09-20',
            'inscricaoFim' => '2019-10-05',
            'qtdMinInscrito' => 5,
            'status' => 'Aberto',
            'qtdMaxInscrito' => 20,
            'modelDoc' => 'ambos'
        )
    );
    return json_encode($evento);
});

function dadosSessao()
{
    $request = new Request();
    return $request->json()->all();
}
